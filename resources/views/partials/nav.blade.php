@php $u = auth()->user(); @endphp

@if($u->role === 'admin')
    {{-- MAIN GROUP --}}
    <div class="nav-group">
        <div class="nav-section">Main</div>
        <a href="{{ route('admin.dashboard') }}"
           class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>
    </div>

    {{-- MANAGEMENT GROUP --}}
    <div class="nav-group">
        <div class="nav-section">Management</div>
        <a href="{{ route('admin.users.index', ['role' => 'teacher']) }}"
           class="nav-link {{ request()->routeIs('admin.users.index') && request('role') === 'teacher' ? 'active' : '' }}">
            <i class="bi bi-person-workspace"></i> Teachers
        </a>
        <a href="{{ route('admin.users.index', ['role' => 'student']) }}"
           class="nav-link {{ request()->routeIs('admin.users.index') && request('role') === 'student' ? 'active' : '' }}">
            <i class="bi bi-people"></i> Students
        </a>
        <a href="{{ route('admin.classes.index') }}"
           class="nav-link {{ request()->routeIs('admin.classes*') ? 'active' : '' }}">
            <i class="bi bi-building"></i> Classes &amp; Sections
        </a>
        <a href="{{ route('admin.subjects.index') }}"
           class="nav-link {{ request()->routeIs('admin.subjects*') ? 'active' : '' }}">
            <i class="bi bi-journal-bookmark"></i> Subjects
        </a>
        <a href="{{ route('admin.assignments.index') }}"
           class="nav-link {{ request()->routeIs('admin.assignments*') ? 'active' : '' }}">
            <i class="bi bi-diagram-3"></i> Teacher Mapping
        </a>
    </div>

    {{-- ACADEMIC GROUP --}}
    <div class="nav-group">
        <div class="nav-section">Academic</div>
        <a href="{{ route('admin.periods.index') }}"
           class="nav-link {{ request()->routeIs('admin.periods*') ? 'active' : '' }}">
            <i class="bi bi-clock"></i> Periods
        </a>
        <a href="{{ route('admin.timetable.index') }}"
           class="nav-link {{ request()->routeIs('admin.timetable*') ? 'active' : '' }}">
            <i class="bi bi-calendar3"></i> Timetable
        </a>
    </div>

@elseif($u->role === 'teacher')
    <div class="nav-group">
        <div class="nav-section">Main</div>
        <a href="{{ route('teacher.dashboard') }}"
           class="nav-link {{ request()->routeIs('teacher.dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>
    </div>
    <div class="nav-group">
        <div class="nav-section">Academic</div>
        <a href="{{ route('teacher.timetable') }}"
           class="nav-link {{ request()->routeIs('teacher.timetable*') ? 'active' : '' }}">
            <i class="bi bi-calendar3"></i> My Timetable
        </a>
        <a href="{{ route('teacher.assignments.index') }}"
           class="nav-link {{ request()->routeIs('teacher.assignments*') ? 'active' : '' }}">
            <i class="bi bi-journal-text"></i> Assignments
        </a>
    </div>

@elseif($u->role === 'student')
    <div class="nav-group">
        <div class="nav-section">Main</div>
        <a href="{{ route('student.dashboard') }}"
           class="nav-link {{ request()->routeIs('student.dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>
    </div>
    <div class="nav-group">
        <div class="nav-section">Academic</div>
        <a href="{{ route('student.timetable') }}"
           class="nav-link {{ request()->routeIs('student.timetable*') ? 'active' : '' }}">
            <i class="bi bi-calendar3"></i> My Timetable
        </a>
        <a href="{{ route('student.assignments.index') }}"
           class="nav-link {{ request()->routeIs('student.assignments*') ? 'active' : '' }}">
            <i class="bi bi-journal-text"></i> Assignments
        </a>
    </div>
@endif