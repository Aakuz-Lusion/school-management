<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'School Management System')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500;9..144,600;9..144,700&family=Inter:wght@400;500;600;700&family=IBM+Plex+Mono:wght@500;600&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <style>
        /* ----- CSS Variables (matching landing) ----- */
        :root {
            --ink: #0F1A2F;
            --ink-2: #1E2F4A;
            --parchment: #F9F6F0;
            --paper: #FFFFFF;
            --brass: #D4A24C;
            --brass-light: #F2D99A;
            --slate: #4A6A85;
            --sage: #7C9885;
            --line: rgba(15, 26, 47, 0.08);
            --text: #1C1C1C;
            --radius: 16px;
            --shadow-card: 0 8px 30px rgba(15, 26, 47, 0.08);
            --transition: all 0.25s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        /* ----- Reset & base ----- */
        * {
            box-sizing: border-box;
        }

        body {
            background: var(--parchment);
            color: var(--text);
            font-family: 'Inter', sans-serif;
            -webkit-font-smoothing: antialiased;
            line-height: 1.6;
            margin: 0;
        }

        h1,
        h2,
        h3,
        h4,
        .brand,
        .card-title {
            font-family: 'Fraunces', serif;
            font-weight: 600;
            letter-spacing: -0.01em;
        }

        a {
            text-decoration: none;
        }

        /* ===== SIDEBAR (modern, premium) ===== */
        .sidebar {
            min-height: 100vh;
            background: var(--paper);
            border-right: 1px solid var(--line);
            width: 280px;
            padding: 1.5rem 1rem 1rem;
            position: sticky;
            top: 0;
            height: 100vh;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            box-shadow: 2px 0 24px rgba(15, 26, 47, 0.06);
            transition: var(--transition);
        }

        /* Brand */
        .sidebar .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--ink);
            padding: 0.25rem 0.75rem 1.5rem;
            border-bottom: 1px solid var(--line);
            margin-bottom: 1.5rem;
        }

        .sidebar .brand .mark {
            width: 38px;
            height: 38px;
            background: var(--ink);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--brass);
            font-family: 'IBM Plex Mono', monospace;
            font-size: 0.9rem;
            font-weight: 700;
        }

        /* Search */
        .sidebar-search {
            position: relative;
            margin: 0 0.25rem 1.5rem 0.25rem;
        }

        .sidebar-search i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #9aa9b9;
            font-size: 0.9rem;
        }

        .sidebar-search input {
            width: 100%;
            padding: 0.7rem 0.7rem 0.7rem 2.6rem;
            border-radius: 12px;
            border: 1px solid var(--line);
            background: var(--parchment);
            font-size: 0.85rem;
            transition: var(--transition);
            outline: none;
            font-family: 'Inter', sans-serif;
        }

        .sidebar-search input:focus {
            border-color: var(--brass);
            background: var(--paper);
            box-shadow: 0 0 0 3px rgba(212, 162, 76, 0.12);
        }

        /* Navigation groups */
        .nav-group {
            margin-bottom: 0.5rem;
        }

        .nav-section {
            font-size: 0.6rem;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: #9aa9b9;
            padding: 0.5rem 0.9rem 0.2rem;
            font-weight: 700;
        }

        /* Nav links with icons */
        .sidebar .nav-link {
            color: var(--ink-2);
            padding: 0.65rem 0.9rem;
            border-radius: 10px;
            font-weight: 500;
            font-size: 0.9rem;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 14px;
            margin: 1px 0;
            background: transparent;
            border: none;
            position: relative;
            width: 100%;
            text-align: left;
        }

        .sidebar .nav-link i {
            font-size: 1.25rem;
            width: 1.8rem;
            text-align: center;
            color: #8a9aa8;
            transition: var(--transition);
            flex-shrink: 0;
        }

        .sidebar .nav-link .badge {
            margin-left: auto;
            font-size: 0.6rem;
            padding: 0.2rem 0.6rem;
            background: var(--brass);
            color: var(--ink);
            border-radius: 30px;
        }

        .sidebar .nav-link:hover {
            background: rgba(15, 26, 47, 0.04);
            color: var(--ink);
        }

        .sidebar .nav-link:hover i {
            color: var(--brass);
        }

        /* Active state with left accent bar */
        .sidebar .nav-link.active {
            background: var(--brass-light);
            color: var(--ink);
            font-weight: 600;
        }

        .sidebar .nav-link.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 15%;
            height: 70%;
            width: 3px;
            background: var(--brass);
            border-radius: 0 4px 4px 0;
        }

        .sidebar .nav-link.active i {
            color: var(--brass);
        }

        /* User card at bottom */
        .user-card {
            margin-top: auto;
            padding: 1rem 0.75rem 0.25rem;
            border-top: 1px solid var(--line);
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .user-card .user-avatar {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: var(--brass-light);
            color: var(--ink);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Fraunces', serif;
            font-weight: 700;
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        .user-card .user-details {
            flex: 1;
            min-width: 0;
        }

        .user-card .user-name {
            font-weight: 600;
            font-size: 0.95rem;
            color: var(--ink);
            line-height: 1.3;
        }

        .user-card .user-role {
            font-size: 0.7rem;
            color: #8a8a8a;
            font-weight: 500;
        }

        .user-card .logout-btn {
            color: #9aa9b9;
            padding: 6px 8px;
            border-radius: 8px;
            transition: var(--transition);
            font-size: 1.2rem;
        }

        .user-card .logout-btn:hover {
            color: #d9534f;
            background: rgba(217, 83, 79, 0.08);
        }

        /* Sidebar responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                min-height: auto;
                position: relative;
                border-right: none;
                border-bottom: 1px solid var(--line);
                padding: 1rem;
            }

            .d-flex.flex-wrap {
                flex-direction: column;
            }

            .user-card {
                margin-top: 1rem;
                padding-top: 1rem;
            }
        }

        /* ===== Main content area ===== */
        .main-content {
            flex: 1;
            padding: 2rem 2rem 3rem;
            background: var(--parchment);
            min-height: 100vh;
        }

        /* ===== Topbar (clean, subtle) ===== */
        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 0 1.5rem 0;
            border-bottom: 1px solid var(--line);
            margin-bottom: 2rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .topbar h1 {
            font-size: 1.6rem;
            font-weight: 600;
            color: var(--ink);
            margin: 0;
        }

        .topbar .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .topbar .user-info .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--brass-light);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: var(--ink);
            font-size: 1rem;
        }

        .topbar .user-info .name {
            font-weight: 500;
            color: var(--ink);
        }

        .topbar .user-info .role {
            font-size: 0.8rem;
            color: #6b6b6b;
        }

        /* ===== Cards & stats ===== */
        .card {
            border: 1px solid rgba(255, 255, 255, 0.5);
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(4px);
            border-radius: var(--radius);
            box-shadow: var(--shadow-card);
            transition: var(--transition);
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 40px rgba(15, 26, 47, 0.1);
        }

        .card-stat {
            border: none;
            background: var(--paper);
            border-radius: var(--radius);
            padding: 1.5rem 1.25rem;
            box-shadow: var(--shadow-card);
        }

        .card-stat .stat-number {
            font-family: 'Fraunces', serif;
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--ink);
            line-height: 1.2;
        }

        .card-stat .stat-label {
            font-size: 0.85rem;
            color: #6b6b6b;
            font-weight: 500;
        }

        .card-stat .stat-icon {
            font-size: 2.2rem;
            color: var(--brass);
            opacity: 0.5;
        }

        /* ===== Tables & forms ===== */
        .table {
            background: var(--paper);
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: var(--shadow-card);
            border-collapse: separate;
            border-spacing: 0;
        }

        .table thead th {
            background: var(--parchment);
            border-bottom: 1px solid var(--line);
            font-weight: 600;
            color: var(--ink-2);
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.03em;
            padding: 0.8rem 1rem;
        }

        .table tbody td {
            padding: 0.8rem 1rem;
            vertical-align: middle;
            border-bottom: 1px solid var(--line);
        }

        .table tbody tr:hover {
            background: rgba(15, 26, 47, 0.02);
        }

        .btn {
            border-radius: 50px;
            font-weight: 600;
            padding: 0.4rem 1.2rem;
            transition: var(--transition);
        }

        .btn-primary {
            background: var(--ink);
            border-color: var(--ink);
            color: white;
        }

        .btn-primary:hover {
            background: #1a2d4a;
            border-color: #1a2d4a;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(15, 26, 47, 0.2);
        }

        .btn-outline-primary {
            border-color: var(--ink);
            color: var(--ink);
        }

        .btn-outline-primary:hover {
            background: var(--ink);
            color: white;
            transform: translateY(-2px);
        }

        .btn-success {
            background: var(--sage);
            border-color: var(--sage);
        }

        .btn-success:hover {
            background: #6b8a76;
            border-color: #6b8a76;
        }

        .btn-warning {
            background: var(--brass);
            border-color: var(--brass);
            color: var(--ink);
        }

        .btn-warning:hover {
            background: #c4943a;
            border-color: #c4943a;
        }

        .form-control,
        .form-select {
            border-radius: 10px;
            border: 1px solid var(--line);
            background: var(--paper);
            font-family: 'Inter', sans-serif;
            transition: var(--transition);
            padding: 0.6rem 1rem;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--brass);
            box-shadow: 0 0 0 3px rgba(212, 162, 76, 0.15);
        }

        .alert {
            border-radius: var(--radius);
            border: none;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(4px);
            box-shadow: var(--shadow-card);
            padding: 1rem 1.5rem;
        }

        .alert-success {
            border-left: 4px solid var(--sage);
        }

        .alert-danger {
            border-left: 4px solid #d9534f;
        }

        .alert-info {
            border-left: 4px solid var(--slate);
        }

        /* ---- badges & misc ---- */
        .badge {
            font-family: 'IBM Plex Mono', monospace;
            font-weight: 500;
            letter-spacing: 0.03em;
            padding: 0.3rem 0.7rem;
            border-radius: 30px;
        }

        /* ---- scrollbar ---- */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-track {
            background: var(--parchment);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--brass);
            border-radius: 10px;
        }

        /* ----- Responsive adjustments ----- */
        @media (max-width: 768px) {
            .main-content {
                padding: 1.5rem 1rem;
            }

            .topbar h1 {
                font-size: 1.3rem;
            }

            .topbar .user-info .name,
            .topbar .user-info .role {
                display: none;
            }
        }
    </style>
</head>

<body>

    @auth
    <div class="d-flex flex-wrap">
        <nav class="sidebar">
            <!-- Brand -->
            <div class="brand">
                <span class="mark">SM</span>
                {{ config('app.name', 'School-Management') }}
            </div>

            <div class="sidebar-search">
                <i class="bi bi-search"></i>
                <input type="text" placeholder="Search..." aria-label="Search">
            </div>

            @include('partials.nav')

            <div class="user-card">
                <div class="user-avatar">
                    {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
                </div>
                <div class="user-details">
                    <div class="user-name">{{ Auth::user()->name ?? 'User' }}</div>
                    <div class="user-role">{{ ucfirst(Auth::user()->role ?? '') }}</div>
                </div>
                <a href="{{ route('logout') }}" class="logout-btn"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bi bi-box-arrow-right"></i>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </nav>

        <!-- MAIN CONTENT -->
        <div class="main-content">
            <div class="topbar">
                <h1>@yield('page_title', 'Dashboard')</h1>
                <div class="user-info d-none d-sm-flex">
                    <div>
                        <div class="name">{{ Auth::user()->name ?? 'User' }}</div>
                        <div class="role">{{ ucfirst(Auth::user()->role ?? '') }}</div>
                    </div>
                    <div class="avatar">
                        {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
                    </div>
                </div>
            </div>

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
        </div>
    </div>
    @else
    <div class="container py-5">
        @yield('content')
    </div>
    @endauth

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>