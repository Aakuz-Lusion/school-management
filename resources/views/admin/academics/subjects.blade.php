@extends('layouts.app')
@section('page-title', 'Subjects')
@section('content')
<div class="card p-3 mb-3">
    <h6>Add Subject</h6>
    <form method="POST" action="{{ route('admin.subjects.store') }}" class="row g-2">
        @csrf
        <div class="col-md-3">
            <select name="school_class_id" class="form-select" required>
                <option value="">Select class</option>
                @foreach($classes as $c)<option value="{{ $c->id }}">{{ $c->name }}</option>@endforeach
            </select>
        </div>
        <div class="col-md-3"><input type="text" name="name" class="form-control" placeholder="Subject name" required></div>
        <div class="col-md-2"><input type="text" name="code" class="form-control" placeholder="Code"></div>
        <div class="col-md-2"><input type="number" name="periods_per_week" class="form-control" placeholder="Periods/week" value="5" required></div>
        <div class="col-md-2"><button class="btn btn-primary w-100">Add</button></div>
    </form>
</div>

<div class="card">
    <table class="table mb-0">
        <thead class="table-light"><tr><th>Class</th><th>Subject</th><th>Code</th><th>Periods/week</th><th></th></tr></thead>
        <tbody>
        @foreach($subjects as $s)
            <tr>
                <td>{{ $s->schoolClass->name }}</td>
                <td>{{ $s->name }}</td>
                <td>{{ $s->code }}</td>
                <td>{{ $s->periods_per_week }}</td>
                <td>
                    <form method="POST" action="{{ route('admin.subjects.destroy', $s) }}" onsubmit="return confirm('Delete?')">
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
