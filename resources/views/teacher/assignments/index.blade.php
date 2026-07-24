@extends('layouts.app')
@section('page-title', 'My Assignments')
@section('content')
<div class="d-flex justify-content-end mb-3">
    <a href="{{ route('teacher.assignments.create') }}" class="btn btn-primary">+ New Assignment</a>
</div>
<div class="card">
    <table class="table mb-0">
        <thead class="table-light"><tr><th>Title</th><th>Subject</th><th>Section</th><th>Due</th><th>Submissions</th><th></th></tr></thead>
        <tbody>
        @foreach($assignments as $a)
            <tr>
                <td>{{ $a->title }}</td>
                <td>{{ $a->subject->name }}</td>
                <td>{{ $a->section->schoolClass->name }}-{{ $a->section->name }}</td>
                <td>{{ $a->due_date->format('d M Y, H:i') }}</td>
                <td><a href="{{ route('teacher.assignments.submissions', $a) }}">{{ $a->submissions->count() }} submitted</a></td>
                <td>
                    <form method="POST" action="{{ route('teacher.assignments.destroy', $a) }}" onsubmit="return confirm('Delete?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
