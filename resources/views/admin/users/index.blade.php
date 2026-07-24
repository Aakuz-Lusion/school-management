@extends('layouts.app')
@section('page-title', ucfirst($role) . ' Management')
@section('content')
<div class="d-flex justify-content-between mb-3">
    <form class="d-flex gap-2" method="GET">
        <input type="hidden" name="role" value="{{ $role }}">
        <input type="text" name="search" class="form-control" placeholder="Search name/email" value="{{ request('search') }}">
        <button class="btn btn-outline-secondary">Search</button>
    </form>
    <a href="{{ route('admin.users.create', ['role' => $role]) }}" class="btn btn-primary">+ Add {{ ucfirst($role) }}</a>
</div>

<div class="card">
<table class="table mb-0 align-middle">
    <thead class="table-light">
        <tr>
            <th>Name</th><th>Email</th><th>Phone</th>
            @if($role === 'student')<th>Class/Section</th>@endif
            @if($role === 'teacher')<th>Employee ID</th>@endif
            <th>Status</th><th>Actions</th>
        </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->phone }}</td>
            @if($role === 'student')
                <td>{{ $user->student?->schoolClass?->name }} - {{ $user->student?->section?->name }}</td>
            @endif
            @if($role === 'teacher')
                <td>{{ $user->teacher?->employee_id }}</td>
            @endif
            <td>
                <span class="badge {{ $user->status === 'active' ? 'bg-success' : 'bg-secondary' }}">{{ $user->status }}</span>
            </td>
            <td class="d-flex gap-1">
                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-outline-primary">Edit</a>

                <form method="POST" action="{{ route('admin.users.toggle-status', $user) }}">
                    @csrf @method('PUT')
                    <button class="btn btn-sm btn-outline-warning">{{ $user->status === 'active' ? 'Deactivate' : 'Activate' }}</button>
                </form>

                <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#pwd{{ $user->id }}">Reset Pwd</button>

                <form method="POST" action="{{ route('admin.users.destroy', $user) }}" onsubmit="return confirm('Delete this user?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger">Delete</button>
                </form>
            </td>
        </tr>

        <div class="modal fade" id="pwd{{ $user->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST" action="{{ route('admin.users.reset-password', $user) }}">
                        @csrf @method('PUT')
                        <div class="modal-header"><h6 class="modal-title">Reset password for {{ $user->name }}</h6></div>
                        <div class="modal-body">
                            <input type="password" name="password" class="form-control" placeholder="New password" required minlength="6">
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary">Update Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
    </tbody>
</table>
</div>
<div class="mt-3">{{ $users->links() }}</div>
@endsection
