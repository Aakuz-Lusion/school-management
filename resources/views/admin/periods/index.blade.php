@extends('layouts.app')
@section('page-title', 'Periods Configuration')
@section('content')
<div class="card p-3 mb-3">
    <h6>Add Period</h6>
    <form method="POST" action="{{ route('admin.periods.store') }}" class="row g-2">
        @csrf
        <div class="col-md-2"><input type="number" name="period_number" class="form-control" placeholder="Period #" required></div>
        <div class="col-md-3"><input type="time" name="start_time" class="form-control" required></div>
        <div class="col-md-3"><input type="time" name="end_time" class="form-control" required></div>
        <div class="col-md-2 form-check mt-2">
            <input type="checkbox" name="is_break" class="form-check-input" id="isBreak">
            <label class="form-check-label" for="isBreak">Is Break?</label>
        </div>
        <div class="col-md-2"><button class="btn btn-primary w-100">Add</button></div>
    </form>
</div>

<div class="card">
    <table class="table mb-0">
        <thead class="table-light"><tr><th>#</th><th>Start</th><th>End</th><th>Break?</th><th></th></tr></thead>
        <tbody>
        @foreach($periods as $p)
            <tr>
                <td>{{ $p->period_number }}</td>
                <td>{{ $p->start_time }}</td>
                <td>{{ $p->end_time }}</td>
                <td>{{ $p->is_break ? 'Yes' : 'No' }}</td>
                <td>
                    <form method="POST" action="{{ route('admin.periods.destroy', $p) }}" onsubmit="return confirm('Delete?')">
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
