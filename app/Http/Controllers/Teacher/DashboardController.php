<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $teacher = Auth::user()->teacher;
        $assignedSections = $teacher->assignments()->with(['subject', 'section.schoolClass'])->get();
        $assignmentsCount = \App\Models\Assignment::where('teacher_id', $teacher->id)->count();

        return view('teacher.dashboard', compact('teacher', 'assignedSections', 'assignmentsCount'));
    }

    public function timetable()
    {
        $teacher = Auth::user()->teacher;
        $days = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
        $periods = \App\Models\Period::where('is_break', false)->orderBy('period_number')->get();

        $grid = [];
        $rows = \App\Models\Timetable::with(['subject', 'section.schoolClass'])
            ->where('teacher_id', $teacher->id)->get();
        foreach ($rows as $row) {
            $grid[$row->day][$row->period_id] = $row;
        }

        return view('teacher.timetable', compact('days', 'periods', 'grid'));
    }
}
