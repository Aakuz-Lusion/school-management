<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AssignmentController extends Controller
{
    public function index()
    {
        $teacher = Auth::user()->teacher;
        $assignments = Assignment::with(['subject', 'section.schoolClass', 'submissions'])
            ->where('teacher_id', $teacher->id)->latest()->get();

        return view('teacher.assignments.index', compact('assignments'));
    }

    public function create()
    {
        $teacher = Auth::user()->teacher;
        $options = $teacher->assignments()->with(['subject', 'section.schoolClass'])->get();
        return view('teacher.assignments.create', compact('options'));
    }

    public function store(Request $request)
    {
        $teacher = Auth::user()->teacher;

        $data = $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'section_id' => 'required|exists:sections,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'required|date|after:now',
            'attachment' => 'nullable|file|max:10240',
        ]);

        // Verify this teacher actually teaches this subject+section
        $owns = $teacher->assignments()
            ->where('subject_id', $data['subject_id'])
            ->where('section_id', $data['section_id'])->exists();
        abort_unless($owns, 403);

        if ($request->hasFile('attachment')) {
            $data['attachment'] = $request->file('attachment')->store('assignments', 'public');
        }

        $data['teacher_id'] = $teacher->id;
        Assignment::create($data);

        return redirect()->route('teacher.assignments.index')->with('status', 'Assignment posted.');
    }

    public function submissions(Assignment $assignment)
    {
        abort_unless($assignment->teacher_id === Auth::user()->teacher->id, 403);
        $submissions = $assignment->submissions()->with('student.user')->get();
        $students = \App\Models\Student::where('section_id', $assignment->section_id)->with('user')->get();

        return view('teacher.assignments.submissions', compact('assignment', 'submissions', 'students'));
    }

    public function grade(Request $request, \App\Models\AssignmentSubmission $submission)
    {
        abort_unless($submission->assignment->teacher_id === Auth::user()->teacher->id, 403);

        $data = $request->validate([
            'marks' => 'required|numeric|min:0|max:100',
            'feedback' => 'nullable|string',
        ]);
        $data['status'] = 'graded';
        $submission->update($data);

        return back()->with('status', 'Submission graded.');
    }

    public function destroy(Assignment $assignment)
    {
        abort_unless($assignment->teacher_id === Auth::user()->teacher->id, 403);
        if ($assignment->attachment) {
            Storage::disk('public')->delete($assignment->attachment);
        }
        $assignment->delete();
        return back()->with('status', 'Assignment deleted.');
    }
}
