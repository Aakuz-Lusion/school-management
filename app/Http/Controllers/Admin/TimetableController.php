<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Period;
use App\Models\Section;
use App\Models\Timetable;
use App\Services\TimetableGeneratorService;
use Illuminate\Http\Request;

class TimetableController extends Controller
{
    public function index(Request $request)
    {
        $sections = Section::with('schoolClass')->get();
        $sectionId = $request->get('section_id', $sections->first()->id ?? null);

        $periods = Period::where('is_break', false)->orderBy('period_number')->get();
        $days = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

        $grid = [];
        if ($sectionId) {
            $rows = Timetable::with(['subject', 'teacher.user'])
                ->where('section_id', $sectionId)->get();
            foreach ($rows as $row) {
                $grid[$row->day][$row->period_id] = $row;
            }
        }

        return view('admin.timetable.index', compact('sections', 'sectionId', 'periods', 'days', 'grid'));
    }

    public function generate(Request $request, TimetableGeneratorService $generator)
    {
        $sectionIds = $request->section_ids; // null = all sections
        $result = $generator->generate($sectionIds ?: null);

        return back()->with('status', $result['message'])
            ->with('report', $result['report'] ?? []);
    }

    // Manual single-cell edit/override
    public function updateCell(Request $request)
    {
        $data = $request->validate([
            'section_id' => 'required|exists:sections,id',
            'period_id' => 'required|exists:periods,id',
            'day' => 'required|in:Mon,Tue,Wed,Thu,Fri,Sat',
            'subject_id' => 'required|exists:subjects,id',
            'teacher_id' => 'required|exists:teachers,id',
        ]);

        Timetable::updateOrCreate(
            ['section_id' => $data['section_id'], 'period_id' => $data['period_id'], 'day' => $data['day']],
            ['subject_id' => $data['subject_id'], 'teacher_id' => $data['teacher_id']]
        );

        return back()->with('status', 'Timetable cell updated.');
    }

    public function destroyCell(Timetable $timetable)
    {
        $timetable->delete();
        return back()->with('status', 'Timetable cell cleared.');
    }
}
