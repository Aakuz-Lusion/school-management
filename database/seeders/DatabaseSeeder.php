<?php

namespace Database\Seeders;

use App\Models\Period;
use App\Models\SchoolClass;
use App\Models\Section;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\TeacherSubjectSection;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Admin account
        User::create([
            'name' => 'System Admin',
            'email' => 'admin@school.test',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'status' => 'active',
        ]);

        // 2. Default periods (6 teaching periods + 1 lunch break)
        $times = [
            [1, '08:00', '08:45'],
            [2, '08:45', '09:30'],
            [3, '09:30', '10:15'],
            [4, '10:15', '11:00'],
            [5, '11:30', '12:15'],
            [6, '12:15', '13:00'],
        ];
        foreach ($times as [$num, $start, $end]) {
            Period::create(['period_number' => $num, 'start_time' => $start, 'end_time' => $end]);
        }
        Period::create(['period_number' => 99, 'start_time' => '11:00', 'end_time' => '11:30', 'is_break' => true]);

        // 3. Classes + sections
        $class10 = SchoolClass::create(['name' => 'Class 10', 'order' => 1]);
        $sectionA = Section::create(['school_class_id' => $class10->id, 'name' => 'A']);
        $sectionB = Section::create(['school_class_id' => $class10->id, 'name' => 'B']);

        // 4. Subjects for Class 10
        $math = Subject::create(['school_class_id' => $class10->id, 'name' => 'Mathematics', 'code' => 'MTH10', 'periods_per_week' => 5]);
        $science = Subject::create(['school_class_id' => $class10->id, 'name' => 'Science', 'code' => 'SCI10', 'periods_per_week' => 4]);
        $english = Subject::create(['school_class_id' => $class10->id, 'name' => 'English', 'code' => 'ENG10', 'periods_per_week' => 4]);

        // 5. Sample teacher
        $teacherUser = User::create([
            'name' => 'John Teacher',
            'email' => 'teacher@school.test',
            'password' => Hash::make('password'),
            'role' => 'teacher',
            'status' => 'active',
        ]);
        $teacher = Teacher::create(['user_id' => $teacherUser->id, 'employee_id' => 'EMP001', 'qualification' => 'M.Sc']);

        TeacherSubjectSection::create(['teacher_id' => $teacher->id, 'subject_id' => $math->id, 'section_id' => $sectionA->id]);
        TeacherSubjectSection::create(['teacher_id' => $teacher->id, 'subject_id' => $science->id, 'section_id' => $sectionA->id]);
        TeacherSubjectSection::create(['teacher_id' => $teacher->id, 'subject_id' => $english->id, 'section_id' => $sectionA->id]);

        // 6. Sample student
        $studentUser = User::create([
            'name' => 'Jane Student',
            'email' => 'student@school.test',
            'password' => Hash::make('password'),
            'role' => 'student',
            'status' => 'active',
        ]);
        Student::create([
            'user_id' => $studentUser->id,
            'roll_no' => '1001',
            'school_class_id' => $class10->id,
            'section_id' => $sectionA->id,
        ]);
    }
}
