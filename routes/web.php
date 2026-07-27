<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Admin\AcademicController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\PeriodController;
use App\Http\Controllers\Admin\TimetableController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Teacher\AssignmentController as TeacherAssignmentController;
use App\Http\Controllers\Teacher\DashboardController as TeacherDashboard;
use App\Http\Controllers\Student\AssignmentController as StudentAssignmentController;
use App\Http\Controllers\Student\DashboardController as StudentDashboard;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('login'));

// ---- Auth ----
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/password', [PasswordController::class, 'edit'])->name('password.edit');
    Route::put('/password', [PasswordController::class, 'update'])->name('password.update');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::put('/users/{user}/reset-password', [UserController::class, 'resetPassword'])->name('users.reset-password');
    Route::put('/users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggle-status');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::get('/classes', [AcademicController::class, 'classes'])->name('classes.index');
    Route::post('/classes', [AcademicController::class, 'storeClass'])->name('classes.store');
    Route::delete('/classes/{class}', [AcademicController::class, 'destroyClass'])->name('classes.destroy');

    Route::post('/sections', [AcademicController::class, 'storeSection'])->name('sections.store');
    Route::delete('/sections/{section}', [AcademicController::class, 'destroySection'])->name('sections.destroy');

    Route::get('/subjects', [AcademicController::class, 'subjects'])->name('subjects.index');
    Route::post('/subjects', [AcademicController::class, 'storeSubject'])->name('subjects.store');
    Route::delete('/subjects/{subject}', [AcademicController::class, 'destroySubject'])->name('subjects.destroy');

    Route::get('/assignments-map', [AcademicController::class, 'assignments'])->name('assignments.index');
    Route::post('/assignments-map', [AcademicController::class, 'storeAssignment'])->name('assignments.store');
    Route::delete('/assignments-map/{assignment}', [AcademicController::class, 'destroyAssignment'])->name('assignments.destroy');

    Route::get('/periods', [PeriodController::class, 'index'])->name('periods.index');
    Route::post('/periods', [PeriodController::class, 'store'])->name('periods.store');
    Route::delete('/periods/{period}', [PeriodController::class, 'destroy'])->name('periods.destroy');

    Route::get('/timetable', [TimetableController::class, 'index'])->name('timetable.index');
    Route::post('/timetable/generate', [TimetableController::class, 'generate'])->name('timetable.generate');
    Route::post('/timetable/cell', [TimetableController::class, 'updateCell'])->name('timetable.update-cell');
    Route::delete('/timetable/cell/{timetable}', [TimetableController::class, 'destroyCell'])->name('timetable.destroy-cell');
});

Route::middleware(['auth', 'role:teacher'])->prefix('teacher')->name('teacher.')->group(function () {
    Route::get('/dashboard', [TeacherDashboard::class, 'index'])->name('dashboard');
    Route::get('/timetable', [TeacherDashboard::class, 'timetable'])->name('timetable');

    Route::get('/assignments', [TeacherAssignmentController::class, 'index'])->name('assignments.index');
    Route::get('/assignments/create', [TeacherAssignmentController::class, 'create'])->name('assignments.create');
    Route::post('/assignments', [TeacherAssignmentController::class, 'store'])->name('assignments.store');
    Route::get('/assignments/{assignment}/submissions', [TeacherAssignmentController::class, 'submissions'])->name('assignments.submissions');
    Route::put('/submissions/{submission}/grade', [TeacherAssignmentController::class, 'grade'])->name('submissions.grade');
    Route::delete('/assignments/{assignment}', [TeacherAssignmentController::class, 'destroy'])->name('assignments.destroy');
});

Route::middleware(['auth', 'role:student'])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', [StudentDashboard::class, 'index'])->name('dashboard');
    Route::get('/timetable', [StudentDashboard::class, 'timetable'])->name('timetable');

    Route::get('/assignments', [StudentAssignmentController::class, 'index'])->name('assignments.index');
    Route::get('/assignments/{assignment}', [StudentAssignmentController::class, 'show'])->name('assignments.show');
    Route::post('/assignments/{assignment}/submit', [StudentAssignmentController::class, 'submit'])->name('assignments.submit');
});
