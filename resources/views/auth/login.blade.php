@extends('layouts.app')
@section('title', 'Login')
@section('content')
<div class="d-flex align-items-center justify-content-center" style="min-height:100vh;">
    <div class="card shadow-sm p-4" style="width: 380px;">
        <h4 class="mb-3 text-center"><i class="bi bi-mortarboard-fill"></i> School Management System</h4>
        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error) <div>{{ $error }}</div> @endforeach
            </div>
        @endif
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="form-check mb-3">
                <input type="checkbox" name="remember" class="form-check-input" id="remember">
                <label class="form-check-label" for="remember">Remember me</label>
            </div>
            <button class="btn btn-primary w-100">Login</button>
        </form>
        <hr>
    </div>
</div>
@endsection
