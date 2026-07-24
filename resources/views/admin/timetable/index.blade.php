@extends('layouts.app')
@section('page-title', 'Timetable')
@section('content')

<div class="card p-3 mb-3">
    <form method="POST" action="{{ route('admin.timetable.generate') }}">
        @csrf
        <div class="d-flex gap-2 align-items-end flex-wrap">
            <div>
                <label class="form-label mb-0">Generate for:</label>
                <select name="section_ids[]" multiple class="form-select" style="min-width:250px;">
                    @foreach($sections as $s)
                        <option value="{{ $s->id }}">{{ $s->schoolClass->name }} - {{ $s->name }}</option>
                    @endforeach
                </select>
                <small class="text-muted">Leave empty to regenerate ALL sections.</small>
            </div>
            <button class="btn btn-success" onclick="return confirm('This will overwrite the existing timetable for selected sections. Continue?')">
                <i class="bi bi-magic"></i> Auto-Generate Timetable
            </button>
        </div>
    </form>
</div>

<div class="card p-3 mb-3">
    <form method="GET">
        <label class="form-label">View timetable for section:</label>
        <select name="section_id" class="form-select" style="max-width:300px" onchange="this.form.submit()">
            @foreach($sections as $s)
                <option value="{{ $s->id }}" @selected($sectionId == $s->id)>{{ $s->schoolClass->name }} - {{ $s->name }}</option>
            @endforeach
        </select>
    </form>
</div>

<div class="card p-3">
    <div class="table-responsive">
    <table class="table table-bordered timetable-table">
        <thead class="table-light">
            <tr>
                <th>Day / Period</th>
                @foreach($periods as $p)
                    <th>P{{ $p->period_number }}<br><small>{{ \Illuminate\Support\Carbon::parse($p->start_time)->format('H:i') }}</small></th>
                @endforeach
            </tr>
        </thead>
        <tbody>
        @foreach($days as $day)
            <tr>
                <td class="fw-bold">{{ $day }}</td>
                @foreach($periods as $p)
                    <td>
                        @if(isset($grid[$day][$p->id]))
                            <div class="fw-bold">{{ $grid[$day][$p->id]->subject->name }}</div>
                            <div class="small text-muted">{{ $grid[$day][$p->id]->teacher->user->name }}</div>
                            <form method="POST" action="{{ route('admin.timetable.destroy-cell', $grid[$day][$p->id]->id) }}" onsubmit="return confirm('Clear this slot?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-link btn-sm text-danger p-0">Clear</button>
                            </form>
                        @else
                            <span class="text-muted">—</span>
                        @endif
                    </td>
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>
    </div>
</div>
@endsection
