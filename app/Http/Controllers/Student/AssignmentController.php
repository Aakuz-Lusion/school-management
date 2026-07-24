<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssignmentController extends Controller
{
    public function index()
    {
        $student = Auth::user()->student;
        $assignments = Assignment::with(['subject', 'teacher.user'])
            ->where('section_id', $student->section_id)->latest()->get();

        $submissions = AssignmentSubmission::where('student_id', $student->id)
            ->pluck('id', 'assignment_id');

        return view('student.assignments.index', compact('assignments', 'submissions'));
    }

    public function show(Assignment $assignment)
    {
        $student = Auth::user()->student;
        abort_unless($assignment->section_id === $student->section_id, 403);

        $submission = AssignmentSubmission::where('assignment_id', $assignment->id)
            ->where('student_id', $student->id)->first();

        return view('student.assignments.show', compact('assignment', 'submission'));
    }

    public function submit(Request $request, Assignment $assignment)
    {
        $student = Auth::user()->student;
        abort_unless($assignment->section_id === $student->section_id, 403);

        $data = $request->validate([
            'answer_text' => 'nullable|string',
            'attachment' => 'nullable|file|max:10240',
        ]);

        if ($request->hasFile('attachment')) {
            $data['attachment'] = $request->file('attachment')->store('submissions', 'public');
        }

        $data['submitted_at'] = now();
        $data['status'] = now()->greaterThan($assignment->due_date) ? 'late' : 'submitted';

        AssignmentSubmission::updateOrCreate(
            ['assignment_id' => $assignment->id, 'student_id' => $student->id],
            $data
        );

        return redirect()->route('student.assignments.show', $assignment)
            ->with('status', 'Assignment submitted successfully.');
    }
}
