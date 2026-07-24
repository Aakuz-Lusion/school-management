@extends('layouts.app')
@section('page-title', 'Classes & Sections')
@section('content')
<div class="row g-3">
    <div class="col-md-5">
        <div class="card p-3">
            <h6>Add Class</h6>
            <form method="POST" action="{{ route('admin.classes.store') }}" class="d-flex gap-2">
                @csrf
                <input type="text" name="name" class="form-control" placeholder="e.g. Class 10" required>
                <input type="number" name="order" class="form-control" placeholder="Order" style="width:100px">
                <button class="btn btn-primary">Add</button>
            </form>
        </div>

        <div class="card p-3 mt-3">
            <h6>Add Section</h6>
            <form method="POST" action="{{ route('admin.sections.store') }}" class="d-flex gap-2">
                @csrf
                <select name="school_class_id" class="form-select" required>
                    <option value="">Select class</option>
                    @foreach($classes as $c)<option value="{{ $c->id }}">{{ $c->name }}</option>@endforeach
                </select>
                <input type="text" name="name" class="form-control" placeholder="e.g. A" required>
                <button class="btn btn-primary">Add</button>
            </form>
        </div>
    </div>

    <div class="col-md-7">
        <div class="card">
            <table class="table mb-0">
                <thead class="table-light"><tr><th>Class</th><th>Sections</th><th>Students</th><th></th></tr></thead>
                <tbody>
                @foreach($classes as $c)
                    <tr>
                        <td>{{ $c->name }}</td>
                        <td>
                            @foreach($c->sections as $s)
                                <span class="badge bg-light text-dark border">{{ $s->name }}
                                    <form method="POST" action="{{ route('admin.sections.destroy', $s) }}" class="d-inline" onsubmit="return confirm('Delete section?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-link btn-sm text-danger p-0">×</button>
                                    </form>
                                </span>
                            @endforeach
                        </td>
                        <td>{{ $c->students_count }}</td>
                        <td>
                            <form method="POST" action="{{ route('admin.classes.destroy', $c) }}" onsubmit="return confirm('Delete class?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
