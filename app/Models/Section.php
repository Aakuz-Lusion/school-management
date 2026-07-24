<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = ['school_class_id', 'name'];

    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function teacherAssignments()
    {
        return $this->hasMany(TeacherSubjectSection::class);
    }

    public function timetables()
    {
        return $this->hasMany(Timetable::class);
    }
}
