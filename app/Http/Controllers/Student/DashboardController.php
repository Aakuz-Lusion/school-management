<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $student = Auth::user()->student;

        $assignments = Assignment::where('section_id', $student->section_id)->latest()->get();
        $pendingCount = $assignments->count() - $student->submissions()->count();

        return view('student.dashboard', compact('student', 'assignments', 'pendingCount'));
    }

    public function timetable()
    {
        $student = Auth::user()->student;
        $days = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
        $periods = \App\Models\Period::where('is_break', false)->orderBy('period_number')->get();

        $grid = [];
        $rows = \App\Models\Timetable::with(['subject', 'teacher.user'])
            ->where('section_id', $student->section_id)->get();
        foreach ($rows as $row) {
            $grid[$row->day][$row->period_id] = $row;
        }

        return view('student.timetable', compact('days', 'periods', 'grid'));
    }
}
