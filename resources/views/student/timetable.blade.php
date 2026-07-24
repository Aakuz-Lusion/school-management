@extends('layouts.app')
@section('page-title', 'My Timetable')
@section('content')
<div class="card p-3">
    <div class="table-responsive">
    <table class="table table-bordered timetable-table">
        <thead class="table-light">
            <tr><th>Day / Period</th>
                @foreach($periods as $p)<th>P{{ $p->period_number }}</th>@endforeach
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
