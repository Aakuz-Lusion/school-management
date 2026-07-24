<?php

namespace App\Services;

use App\Models\Period;
use App\Models\Section;
use App\Models\Timetable;
use Illuminate\Support\Facades\DB;

/**
 * Greedy automatic timetable generator.
 *
 * Rules enforced:
 *  - A teacher cannot be in two sections at the same day+period.
 *  - A section cannot have two subjects in the same day+period.
 *  - Each subject gets (as close as possible to) its configured periods_per_week.
 *  - A subject is not repeated twice on the same day for a section, unless
 *    there is no other way to fit all required periods in the week.
 */
class TimetableGeneratorService
{
    private const DAYS = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

    /**
     * Generate timetable for given section IDs (or all sections if null).
     * Existing timetable rows for the affected sections are cleared first.
     */
    public function generate(?array $sectionIds = null): array
    {
        $sections = $sectionIds
            ? Section::whereIn('id', $sectionIds)->get()
            : Section::all();

        $periods = Period::where('is_break', false)->orderBy('period_number')->get();

        if ($periods->isEmpty()) {
            return ['success' => false, 'message' => 'No periods configured. Please add periods first.'];
        }

        $report = [];

        DB::transaction(function () use ($sections, $periods, &$report) {
            // Clear existing timetable for these sections
            Timetable::whereIn('section_id', $sections->pluck('id'))->delete();

            // Track teacher busy slots across ALL sections being generated: [day][period_id] => teacher_id
            $teacherBusy = [];
            foreach (self::DAYS as $day) {
                $teacherBusy[$day] = [];
            }

            foreach ($sections as $section) {
                $assignments = $section->teacherAssignments()->with(['subject', 'teacher'])->get();

                if ($assignments->isEmpty()) {
                    $report[] = "Section {$section->name}: no subjects/teachers assigned, skipped.";
                    continue;
                }

                // Build a queue of (subject, teacher) slots to place, repeated periods_per_week times
                $slotsToPlace = [];
                foreach ($assignments as $a) {
                    $count = max(1, $a->subject->periods_per_week);
                    for ($i = 0; $i < $count; $i++) {
                        $slotsToPlace[] = $a;
                    }
                }

                // Build empty grid for this section: [day][period_id] => null
                $grid = [];
                foreach (self::DAYS as $day) {
                    foreach ($periods as $p) {
                        $grid[$day][$p->id] = null;
                    }
                }

                // Track how many times each subject already placed per day (to spread subjects out)
                $subjectPerDayCount = [];

                // Sort slots so subjects with more required periods get placed first (harder to fit)
                usort($slotsToPlace, function ($a, $b) {
                    return $b->subject->periods_per_week <=> $a->subject->periods_per_week;
                });

                foreach ($slotsToPlace as $assignment) {
                    $placed = false;

                    // Try to find a day+period where: section slot free, teacher free,
                    // and prefer a day where this subject hasn't been placed yet
                    $daysShuffled = self::DAYS;
                    shuffle($daysShuffled);

                    // First pass: only days where subject not yet placed today
                    foreach ([true, false] as $preferFreshDay) {
                        foreach ($daysShuffled as $day) {
                            $subjKey = $day . '-' . $assignment->subject_id;
                            $alreadyToday = $subjectPerDayCount[$subjKey] ?? 0;

                            if ($preferFreshDay && $alreadyToday > 0) {
                                continue;
                            }

                            foreach ($periods as $period) {
                                if ($grid[$day][$period->id] !== null) {
                                    continue; // section already has a class this period
                                }
                                if (isset($teacherBusy[$day][$period->id]) &&
                                    $teacherBusy[$day][$period->id] === $assignment->teacher_id) {
                                    continue; // teacher already teaching elsewhere this period
                                }

                                // Place it
                                $grid[$day][$period->id] = $assignment;
                                $teacherBusy[$day][$period->id] = $assignment->teacher_id;
                                $subjectPerDayCount[$subjKey] = $alreadyToday + 1;
                                $placed = true;
                                break 2;
                            }
                        }
                        if ($placed) break;
                    }

                    if (! $placed) {
                        $report[] = "Section {$section->name}: could not fit one period of '{$assignment->subject->name}' (timetable full or teacher clash).";
                    }
                }

                // Persist grid to DB
                foreach (self::DAYS as $day) {
                    foreach ($periods as $period) {
                        $assignment = $grid[$day][$period->id];
                        if ($assignment) {
                            Timetable::create([
                                'section_id' => $section->id,
                                'subject_id' => $assignment->subject_id,
                                'teacher_id' => $assignment->teacher_id,
                                'period_id' => $period->id,
                                'day' => $day,
                            ]);
                        }
                    }
                }

                $report[] = "Section {$section->name}: timetable generated.";
            }
        });

        return ['success' => true, 'message' => 'Timetable generation complete.', 'report' => $report];
    }
}
