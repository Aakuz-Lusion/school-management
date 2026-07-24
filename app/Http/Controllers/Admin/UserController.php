<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SchoolClass;
use App\Models\Section;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $role = $request->get('role', 'teacher');
        $users = User::where('role', $role)
            ->when($request->search, fn ($q) => $q->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%'))
            ->latest()->paginate(15)->withQueryString();

        return view('admin.users.index', compact('users', 'role'));
    }

    public function create(Request $request)
    {
        $role = $request->get('role', 'teacher');
        $classes = SchoolClass::with('sections')->get();
        return view('admin.users.create', compact('role', 'classes'));
    }

    public function store(Request $request)
    {
        $role = $request->role;

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'phone' => ['nullable', 'string'],
            'password' => ['required', 'min:6'],
            'role' => ['required', 'in:admin,teacher,student'],
        ];

        if ($role === 'teacher') {
            $rules['employee_id'] = ['required', 'string', 'unique:teachers,employee_id'];
        }

        if ($role === 'student') {
            $rules['roll_no'] = ['required', 'string'];
            $rules['school_class_id'] = ['required', 'exists:school_classes,id'];
            $rules['section_id'] = ['required', 'exists:sections,id'];
        }

        $data = $request->validate($rules);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
        ]);

        if ($role === 'teacher') {
            Teacher::create([
                'user_id' => $user->id,
                'employee_id' => $data['employee_id'],
                'qualification' => $request->qualification,
                'address' => $request->address,
            ]);
        }

        if ($role === 'student') {
            Student::create([
                'user_id' => $user->id,
                'roll_no' => $data['roll_no'],
                'school_class_id' => $data['school_class_id'],
                'section_id' => $data['section_id'],
                'guardian_name' => $request->guardian_name,
                'guardian_phone' => $request->guardian_phone,
                'address' => $request->address,
            ]);
        }

        return redirect()->route('admin.users.index', ['role' => $role])
            ->with('status', ucfirst($role) . ' created successfully.');
    }

    public function edit(User $user)
    {
        $classes = SchoolClass::with('sections')->get();
        return view('admin.users.edit', compact('user', 'classes'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email,' . $user->id],
            'phone' => ['nullable', 'string'],
            'status' => ['required', 'in:active,inactive'],
        ]);

        $user->update($data);

        if ($user->role === 'student' && $user->student) {
            $request->validate([
                'roll_no' => ['required'],
                'school_class_id' => ['required', 'exists:school_classes,id'],
                'section_id' => ['required', 'exists:sections,id'],
            ]);
            $user->student->update([
                'roll_no' => $request->roll_no,
                'school_class_id' => $request->school_class_id,
                'section_id' => $request->section_id,
                'guardian_name' => $request->guardian_name,
                'guardian_phone' => $request->guardian_phone,
                'address' => $request->address,
            ]);
        }

        if ($user->role === 'teacher' && $user->teacher) {
            $request->validate(['employee_id' => ['required']]);
            $user->teacher->update([
                'employee_id' => $request->employee_id,
                'qualification' => $request->qualification,
                'address' => $request->address,
            ]);
        }

        return redirect()->back()->with('status', 'User updated successfully.');
    }

    // Admin resets/changes ANY user's password
    public function resetPassword(Request $request, User $user)
    {
        $request->validate(['password' => ['required', 'min:6']]);
        $user->update(['password' => Hash::make($request->password)]);
        return back()->with('status', "Password for {$user->name} updated.");
    }

    public function toggleStatus(User $user)
    {
        $user->update(['status' => $user->status === 'active' ? 'inactive' : 'active']);
        return back()->with('status', 'Status updated.');
    }

    public function destroy(User $user)
    {
        $role = $user->role;
        $user->delete(); // cascades to teacher/student rows
        return redirect()->route('admin.users.index', ['role' => $role])
            ->with('status', 'User deleted.');
    }
}
