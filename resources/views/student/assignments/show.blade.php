@extends('layouts.app')
@section('page-title', $assignment->title)
@section('content')
<div class="card p-4 mb-3">
    <h5>{{ $assignment->title }}</h5>
    <p class="text-muted">Subject: {{ $assignment->subject->name }} | Due: {{ $assignment->due_date->format('d M Y, H:i') }}</p>
    <p>{{ $assignment->description }}</p>
    @if($assignment->attachment)
        <a href="{{ asset('storage/' . $assignment->attachment) }}" target="_blank">Download Attachment</a>
    @endif
</div>

<div class="card p-4">
    <h6>{{ $submission ? 'Your Submission' : 'Submit your work' }}</h6>

    @if($submission)
        <p><strong>Status:</strong> {{ ucfirst($submission->status) }}</p>
        <p><strong>Submitted at:</strong> {{ $submission->submitted_at->format('d M Y, H:i') }}</p>
        @if($submission->marks !== null)
            <p><strong>Marks:</strong> {{ $submission->marks }} / 100</p>
            <p><strong>Feedback:</strong> {{ $submission->feedback }}</p>
        @endif
    @endif

    @if(!$assignment->isOverdue() || $submission)
    <form method="POST" action="{{ route('student.assignments.submit', $assignment) }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">Answer (text)</label>
            <textarea name="answer_text" class="form-control" rows="4">{{ $submission->answer_text ?? '' }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Attach File (optional)</label>
            <input type="file" name="attachment" class="form-control">
        </div>
        <button class="btn btn-primary">{{ $submission ? 'Re-submit' : 'Submit Assignment' }}</button>
    </form>
    @else
        <div class="alert alert-danger">The due date has passed and no submission was made.</div>
    @endif
</div>
@endsection
