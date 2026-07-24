@extends('layouts.app')
@section('page-title', 'My Assignments')
@section('content')
<div class="card">
    <table class="table mb-0">
        <thead class="table-light"><tr><th>Title</th><th>Subject</th><th>Due Date</th><th>Status</th><th></th></tr></thead>
        <tbody>
        @foreach($assignments as $a)
            <tr>
                <td>{{ $a->title }}</td>
                <td>{{ $a->subject->name }}</td>
                <td>{{ $a->due_date->format('d M Y, H:i') }}</td>
                <td>
                    @if(isset($submissions[$a->id]))
                        <span class="badge bg-success">Submitted</span>
                    @elseif($a->isOverdue())
                        <span class="badge bg-danger">Overdue</span>
                    @else
                        <span class="badge bg-warning">Pending</span>
                    @endif
                </td>
                <td><a href="{{ route('student.assignments.show', $a) }}" class="btn btn-sm btn-outline-primary">Open</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
