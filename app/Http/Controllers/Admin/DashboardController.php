<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\SchoolClass;
use App\Models\Section;
use App\Models\Student;
use App\Models\Teacher;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'students' => Student::count(),
            'teachers' => Teacher::count(),
            'classes' => SchoolClass::count(),
            'sections' => Section::count(),
            'assignments' => Assignment::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
