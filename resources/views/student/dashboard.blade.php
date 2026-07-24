@extends('layouts.app')
@section('page-title', 'Student Dashboard')
@section('content')
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card card-stat text-white bg-primary p-3">
            <h6>Class</h6><div>{{ $student->schoolClass->name }} - {{ $student->section->name }}</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-stat text-white bg-success p-3"><h2>{{ $assignments->count() }}</h2><div>Total Assignments</div></div>
    </div>
    <div class="col-md-4">
        <div class="card card-stat text-white bg-warning p-3"><h2>{{ max($pendingCount, 0) }}</h2><div>Pending</div></div>
    </div>
</div>

<div class="card p-3">
    <h6>Recent Assignments</h6>
    <table class="table">
        <thead><tr><th>Title</th><th>Due Date</th><th></th></tr></thead>
        <tbody>
        @foreach($assignments->take(5) as $a)
            <tr>
                <td>{{ $a->title }}</td>
                <td>{{ $a->due_date->format('d M Y, H:i') }}</td>
                <td><a href="{{ route('student.assignments.show', $a) }}" class="btn btn-sm btn-outline-primary">View</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
