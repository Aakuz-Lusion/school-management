<div class="d-flex justify-content-between align-items-center bg-white p-3 rounded shadow-sm mb-4">
    <h5 class="mb-0">@yield('page-title', 'Dashboard')</h5>
    <div class="d-flex align-items-center gap-3">
        <a href="{{ route('password.edit') }}" class="text-decoration-none"><i class="bi bi-key"></i> Change Password</a>
        <span>{{ auth()->user()->name }} <span class="badge bg-secondary">{{ ucfirst(auth()->user()->role) }}</span></span>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-sm btn-outline-danger">Logout</button>
        </form>
    </div>
</div>
