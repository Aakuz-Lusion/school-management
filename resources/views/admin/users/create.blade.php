@extends('layouts.app')
@section('page-title', 'Add ' . ucfirst($role))
@section('content')
<div class="card p-4" style="max-width:640px;">
<form method="POST" action="{{ route('admin.users.store') }}">
    @csrf
    <input type="hidden" name="role" value="{{ $role }}">

    <div class="mb-3">
        <label class="form-label">Full Name</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Phone</label>
        <input type="text" name="phone" class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control" required minlength="6">
    </div>

    @if($role === 'teacher')
        <div class="mb-3">
            <label class="form-label">Employee ID</label>
            <input type="text" name="employee_id" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Qualification</label>
            <input type="text" name="qualification" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Address</label>
            <textarea name="address" class="form-control"></textarea>
        </div>
    @endif

    @if($role === 'student')
        <div class="mb-3">
            <label class="form-label">Roll No.</label>
            <input type="text" name="roll_no" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Class</label>
            <select name="school_class_id" id="classSelect" class="form-select" required>
                <option value="">Select class</option>
                @foreach($classes as $c)
                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Section</label>
            <select name="section_id" id="sectionSelect" class="form-select" required>
                <option value="">Select class first</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Guardian Name</label>
            <input type="text" name="guardian_name" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Guardian Phone</label>
            <input type="text" name="guardian_phone" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Address</label>
            <textarea name="address" class="form-control"></textarea>
        </div>

        <script>
            const classData = @json($classes->keyBy('id'));
            document.getElementById('classSelect').addEventListener('change', function () {
                const sectionSelect = document.getElementById('sectionSelect');
                sectionSelect.innerHTML = '';
                const cls = classData[this.value];
                if (!cls) { sectionSelect.innerHTML = '<option value="">Select class first</option>'; return; }
                cls.sections.forEach(s => {
                    const opt = document.createElement('option');
                    opt.value = s.id; opt.textContent = s.name;
                    sectionSelect.appendChild(opt);
                });
            });
        </script>
    @endif

    <button class="btn btn-primary">Create {{ ucfirst($role) }}</button>
</form>
</div>
@endsection
