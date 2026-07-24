<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'School Management System')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <style>
        body { background: #f4f6f9; }
        .sidebar { min-height: 100vh; background: #1e2a3a; }
        .sidebar a { color: #c9d3df; text-decoration: none; display: block; padding: .6rem 1rem; border-radius: .375rem; }
        .sidebar a:hover, .sidebar a.active { background: #2f3f52; color: #fff; }
        .brand { color: #fff; font-weight: 700; padding: 1rem; font-size: 1.1rem; }
        .timetable-table td, .timetable-table th { vertical-align: middle; text-align: center; }
        .card-stat { border: none; border-radius: .75rem; }
    </style>
</head>
<body>
@auth
<div class="d-flex">
    <nav class="sidebar p-2" style="width: 240px;">
        <div class="brand"><i class="bi bi-mortarboard-fill"></i> SMS</div>
        @include('partials.nav')
    </nav>
    <main class="flex-grow-1 p-4">
        @include('partials.topbar')
        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif
        @if (session('report'))
            <div class="alert alert-info">
                <ul class="mb-0">
                    @foreach (session('report') as $line)
                        <li>{{ $line }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @yield('content')
    </main>
</div>
@else
    @yield('content')
@endauth
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
