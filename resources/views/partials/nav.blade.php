@php $u = auth()->user(); @endphp

@if($u->role === 'admin')
    <a href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2"></i> Dashboard</a>
    <a href="{{ route('admin.users.index', ['role' => 'teacher']) }}"><i class="bi bi-person-workspace"></i> Teachers</a>
    <a href="{{ route('admin.users.index', ['role' => 'student']) }}"><i class="bi bi-people"></i> Students</a>
    <a href="{{ route('admin.classes.index') }}"><i class="bi bi-building"></i> Classes & Sections</a>
    <a href="{{ route('admin.subjects.index') }}"><i class="bi bi-journal-bookmark"></i> Subjects</a>
    <a href="{{ route('admin.assignments.index') }}"><i class="bi bi-diagram-3"></i> Teacher Mapping</a>
    <a href="{{ route('admin.periods.index') }}"><i class="bi bi-clock"></i> Periods</a>
    <a href="{{ route('admin.timetable.index') }}"><i class="bi bi-calendar3"></i> Timetable</a>
@elseif($u->role === 'teacher')
    <a href="{{ route('teacher.dashboard') }}"><i class="bi bi-speedometer2"></i> Dashboard</a>
    <a href="{{ route('teacher.timetable') }}"><i class="bi bi-calendar3"></i> My Timetable</a>
    <a href="{{ route('teacher.assignments.index') }}"><i class="bi bi-journal-text"></i> Assignments</a>
@elseif($u->role === 'student')
    <a href="{{ route('student.dashboard') }}"><i class="bi bi-speedometer2"></i> Dashboard</a>
    <a href="{{ route('student.timetable') }}"><i class="bi bi-calendar3"></i> My Timetable</a>
    <a href="{{ route('student.assignments.index') }}"><i class="bi bi-journal-text"></i> Assignments</a>
@endif
