@extends('layouts.app')
@section('page-title', 'Admin Dashboard')
@section('content')
<div class="row g-3">
    <div class="col-md-3">
        <div class="card card-stat text-white bg-primary p-3"><h2>{{ $stats['students'] }}</h2><div>Students</div></div>
    </div>
    <div class="col-md-3">
        <div class="card card-stat text-white bg-success p-3"><h2>{{ $stats['teachers'] }}</h2><div>Teachers</div></div>
    </div>
    <div class="col-md-2">
        <div class="card card-stat text-white bg-info p-3"><h2>{{ $stats['classes'] }}</h2><div>Classes</div></div>
    </div>
    <div class="col-md-2">
        <div class="card card-stat text-white bg-warning p-3"><h2>{{ $stats['sections'] }}</h2><div>Sections</div></div>
    </div>
    <div class="col-md-2">
        <div class="card card-stat text-white bg-dark p-3"><h2>{{ $stats['assignments'] }}</h2><div>Assignments</div></div>
    </div>
</div>

<div class="mt-4 card p-3">
    <h6>Quick Actions</h6>
    <a href="{{ route('admin.users.create', ['role' => 'teacher']) }}" class="btn btn-sm btn-outline-primary me-2">+ Add Teacher</a>
    <a href="{{ route('admin.users.create', ['role' => 'student']) }}" class="btn btn-sm btn-outline-success me-2">+ Add Student</a>
    <a href="{{ route('admin.timetable.index') }}" class="btn btn-sm btn-outline-dark">Generate Timetable</a>
</div>
@endsection
