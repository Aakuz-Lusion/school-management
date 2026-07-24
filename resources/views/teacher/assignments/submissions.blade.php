@extends('layouts.app')
@section('page-title', 'Submissions: ' . $assignment->title)
@section('content')
<div class="card">
    <table class="table mb-0">
        <thead class="table-light"><tr><th>Student</th><th>Roll No</th><th>Status</th><th>Submitted At</th><th>Answer</th><th>Marks</th><th>Action</th></tr></thead>
        <tbody>
        @foreach($students as $student)
            @php $sub = $submissions->firstWhere('student_id', $student->id); @endphp
            <tr>
                <td>{{ $student->user->name }}</td>
                <td>{{ $student->roll_no }}</td>
                <td>
                    @if($sub)
                        <span class="badge {{ $sub->status === 'late' ? 'bg-warning' : ($sub->status === 'graded' ? 'bg-success' : 'bg-info') }}">{{ $sub->status }}</span>
                    @else
                        <span class="badge bg-secondary">not submitted</span>
                    @endif
                </td>
                <td>{{ $sub?->submitted_at?->format('d M Y, H:i') }}</td>
                <td>
                    @if($sub)
                        {{ \Illuminate\Support\Str::limit($sub->answer_text, 60) }}
                        @if($sub->attachment)<br><a href="{{ asset('storage/' . $sub->attachment) }}" target="_blank">View File</a>@endif
                    @endif
                </td>
                <td>{{ $sub?->marks ?? '-' }}</td>
                <td>
                    @if($sub)
                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#grade{{ $sub->id }}">Grade</button>
                        <div class="modal fade" id="grade{{ $sub->id }}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form method="POST" action="{{ route('teacher.submissions.grade', $sub) }}">
                                        @csrf @method('PUT')
                                        <div class="modal-header"><h6 class="modal-title">Grade {{ $student->user->name }}</h6></div>
                                        <div class="modal-body">
                                            <label class="form-label">Marks (0-100)</label>
                                            <input type="number" name="marks" class="form-control mb-2" value="{{ $sub->marks }}" min="0" max="100" step="0.5" required>
                                            <label class="form-label">Feedback</label>
                                            <textarea name="feedback" class="form-control">{{ $sub->feedback }}</textarea>
                                        </div>
                                        <div class="modal-footer"><button class="btn btn-primary">Save Grade</button></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
