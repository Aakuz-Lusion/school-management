@extends('layouts.app')
@section('page-title', 'Change Password')
@section('content')
<div class="card p-4" style="max-width:480px;">
    <form method="POST" action="{{ route('password.update') }}">
        @csrf @method('PUT')
        <div class="mb-3">
            <label class="form-label">Current Password</label>
            <input type="password" name="current_password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">New Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Confirm New Password</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>
        <button class="btn btn-primary">Update Password</button>
    </form>
</div>
@endsection
