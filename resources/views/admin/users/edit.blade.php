@extends('layouts.app')
@section('page-title', 'Edit ' . $user->name)
@section('content')
<div class="card p-4" style="max-width:640px;">
<form method="POST" action="{{ route('admin.users.update', $user) }}">
    @csrf @method('PUT')

    <div class="mb-3">
        <label class="form-label">Full Name</label>
        <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Phone</label>
        <input type="text" name="phone" class="form-control" value="{{ $user->phone }}">
    </div>
    <div class="mb-3">
        <label class="form-label">Status</label>
        <select name="status" class="form-select">
            <option value="active" @selected($user->status === 'active')>Active</option>
            <option value="inactive" @selected($user->status === 'inactive')>Inactive</option>
        </select>
    </div>

    @if($user->role === 'teacher' && $user->teacher)
        <div class="mb-3">
            <label class="form-label">Employee ID</label>
            <input type="text" name="employee_id" class="form-control" value="{{ $user->teacher->employee_id }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Qualification</label>
            <input type="text" name="qualification" class="form-control" value="{{ $user->teacher->qualification }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Address</label>
            <textarea name="address" class="form-control">{{ $user->teacher->address }}</textarea>
        </div>
    @endif

    @if($user->role === 'student' && $user->student)
        <div class="mb-3">
            <label class="form-label">Roll No.</label>
            <input type="text" name="roll_no" class="form-control" value="{{ $user->student->roll_no }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Class</label>
            <select name="school_class_id" id="classSelect" class="form-select" required>
                @foreach($classes as $c)
                    <option value="{{ $c->id }}" @selected($user->student->school_class_id == $c->id)>{{ $c->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Section</label>
            <select name="section_id" id="sectionSelect" class="form-select" required>
                @foreach($classes->firstWhere('id', $user->student->school_class_id)?->sections ?? [] as $s)
                    <option value="{{ $s->id }}" @selected($user->student->section_id == $s->id)>{{ $s->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Guardian Name</label>
            <input type="text" name="guardian_name" class="form-control" value="{{ $user->student->guardian_name }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Guardian Phone</label>
            <input type="text" name="guardian_phone" class="form-control" value="{{ $user->student->guardian_phone }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Address</label>
            <textarea name="address" class="form-control">{{ $user->student->address }}</textarea>
        </div>

        <script>
            const classData = @json($classes->keyBy('id'));
            document.getElementById('classSelect').addEventListener('change', function () {
                const sectionSelect = document.getElementById('sectionSelect');
                sectionSelect.innerHTML = '';
                const cls = classData[this.value];
                if (!cls) return;
                cls.sections.forEach(s => {
                    const opt = document.createElement('option');
                    opt.value = s.id; opt.textContent = s.name;
                    sectionSelect.appendChild(opt);
                });
            });
        </script>
    @endif

    <button class="btn btn-primary">Save Changes</button>
</form>
</div>
@endsection
