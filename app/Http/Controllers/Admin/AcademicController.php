<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SchoolClass;
use App\Models\Section;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\TeacherSubjectSection;
use Illuminate\Http\Request;

class AcademicController extends Controller
{
    // ---- Classes ----
    public function classes()
    {
        $classes = SchoolClass::withCount(['sections', 'students'])->orderBy('order')->get();
        return view('admin.academics.classes', compact('classes'));
    }

    public function storeClass(Request $request)
    {
        $data = $request->validate(['name' => 'required|string|max:255', 'order' => 'nullable|integer']);
        SchoolClass::create($data);
        return back()->with('status', 'Class created.');
    }

    public function destroyClass(SchoolClass $class)
    {
        $class->delete();
        return back()->with('status', 'Class deleted.');
    }

    // ---- Sections ----
    public function storeSection(Request $request)
    {
        $data = $request->validate([
            'school_class_id' => 'required|exists:school_classes,id',
            'name' => 'required|string|max:50',
        ]);
        Section::create($data);
        return back()->with('status', 'Section created.');
    }

    public function destroySection(Section $section)
    {
        $section->delete();
        return back()->with('status', 'Section deleted.');
    }

    // ---- Subjects ----
    public function subjects()
    {
        $subjects = Subject::with('schoolClass')->latest()->get();
        $classes = SchoolClass::all();
        return view('admin.academics.subjects', compact('subjects', 'classes'));
    }

    public function storeSubject(Request $request)
    {
        $data = $request->validate([
            'school_class_id' => 'required|exists:school_classes,id',
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:50',
            'periods_per_week' => 'required|integer|min:1|max:15',
        ]);
        Subject::create($data);
        return back()->with('status', 'Subject created.');
    }

    public function destroySubject(Subject $subject)
    {
        $subject->delete();
        return back()->with('status', 'Subject deleted.');
    }

    // ---- Teacher <-> Subject <-> Section assignment ----
    public function assignments()
    {
        $assignments = TeacherSubjectSection::with(['teacher.user', 'subject', 'section.schoolClass'])->get();
        $teachers = Teacher::with('user')->get();
        $sections = Section::with('schoolClass')->get();
        $subjects = Subject::all();
        return view('admin.academics.assignments', compact('assignments', 'teachers', 'sections', 'subjects'));
    }

    public function storeAssignment(Request $request)
    {
        $data = $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
            'subject_id' => 'required|exists:subjects,id',
            'section_id' => 'required|exists:sections,id',
        ]);

        TeacherSubjectSection::updateOrCreate(
            ['subject_id' => $data['subject_id'], 'section_id' => $data['section_id']],
            ['teacher_id' => $data['teacher_id']]
        );

        return back()->with('status', 'Teacher assigned to subject/section.');
    }

    public function destroyAssignment(TeacherSubjectSection $assignment)
    {
        $assignment->delete();
        return back()->with('status', 'Assignment removed.');
    }
}
