@extends('layouts.app')
@section('page-title', 'Teacher Dashboard')
@section('content')
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card card-stat text-white bg-primary p-3"><h2>{{ $assignedSections->count() }}</h2><div>Class Assignments</div></div>
    </div>
    <div class="col-md-4">
        <div class="card card-stat text-white bg-success p-3"><h2>{{ $assignmentsCount }}</h2><div>Assignments Posted</div></div>
    </div>
    <div class="col-md-4">
        <a href="{{ route('teacher.assignments.create') }}" class="btn btn-dark w-100 h-100 d-flex align-items-center justify-content-center">+ Post New Assignment</a>
    </div>
</div>

<div class="card p-3">
    <h6>My Subjects & Sections</h6>
    <table class="table">
        <thead><tr><th>Subject</th><th>Class/Section</th></tr></thead>
        <tbody>
        @foreach($assignedSections as $a)
            <tr><td>{{ $a->subject->name }}</td><td>{{ $a->section->schoolClass->name }} - {{ $a->section->name }}</td></tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
