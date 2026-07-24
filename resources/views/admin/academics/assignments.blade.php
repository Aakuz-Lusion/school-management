@extends('layouts.app')
@section('page-title', 'Teacher → Subject → Section Mapping')
@section('content')
<div class="card p-3 mb-3">
    <h6>Assign Teacher to Subject/Section</h6>
    <form method="POST" action="{{ route('admin.assignments.store') }}" class="row g-2">
        @csrf
        <div class="col-md-4">
            <select name="teacher_id" class="form-select" required>
                <option value="">Select teacher</option>
                @foreach($teachers as $t)<option value="{{ $t->id }}">{{ $t->user->name }} ({{ $t->employee_id }})</option>@endforeach
            </select>
        </div>
        <div class="col-md-4">
            <select name="subject_id" class="form-select" required>
                <option value="">Select subject</option>
                @foreach($subjects as $s)<option value="{{ $s->id }}">{{ $s->name }}</option>@endforeach
            </select>
        </div>
        <div class="col-md-3">
            <select name="section_id" class="form-select" required>
                <option value="">Select section</option>
                @foreach($sections as $sec)<option value="{{ $sec->id }}">{{ $sec->schoolClass->name }} - {{ $sec->name }}</option>@endforeach
            </select>
        </div>
        <div class="col-md-1"><button class="btn btn-primary w-100">Add</button></div>
    </form>
</div>

<div class="card">
    <table class="table mb-0">
        <thead class="table-light"><tr><th>Teacher</th><th>Subject</th><th>Class/Section</th><th></th></tr></thead>
        <tbody>
        @foreach($assignments as $a)
            <tr>
                <td>{{ $a->teacher->user->name }}</td>
                <td>{{ $a->subject->name }}</td>
                <td>{{ $a->section->schoolClass->name }} - {{ $a->section->name }}</td>
                <td>
                    <form method="POST" action="{{ route('admin.assignments.destroy', $a) }}" onsubmit="return confirm('Remove?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger">Remove</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
