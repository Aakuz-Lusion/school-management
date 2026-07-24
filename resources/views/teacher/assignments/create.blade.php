@extends('layouts.app')
@section('page-title', 'Post Assignment')
@section('content')
<div class="card p-4" style="max-width:640px;">
<form method="POST" action="{{ route('teacher.assignments.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label class="form-label">Class/Section & Subject</label>
        <select id="combo" class="form-select" required>
            <option value="">Select</option>
            @foreach($options as $o)
                <option value="{{ $o->subject_id }}|{{ $o->section_id }}">
                    {{ $o->subject->name }} — {{ $o->section->schoolClass->name }} {{ $o->section->name }}
                </option>
            @endforeach
        </select>
        <input type="hidden" name="subject_id" id="subject_id">
        <input type="hidden" name="section_id" id="section_id">
    </div>
    <div class="mb-3">
        <label class="form-label">Title</label>
        <input type="text" name="title" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control" rows="4"></textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Due Date</label>
        <input type="datetime-local" name="due_date" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Attachment (optional)</label>
        <input type="file" name="attachment" class="form-control">
    </div>
    <button class="btn btn-primary">Post Assignment</button>
</form>
</div>
<script>
document.getElementById('combo').addEventListener('change', function () {
    const [subjectId, sectionId] = this.value.split('|');
    document.getElementById('subject_id').value = subjectId || '';
    document.getElementById('section_id').value = sectionId || '';
});
</script>
@endsection
