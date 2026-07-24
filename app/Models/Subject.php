<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['school_class_id', 'name', 'code', 'periods_per_week'];

    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class);
    }

    public function teacherAssignments()
    {
        return $this->hasMany(TeacherSubjectSection::class);
    }
}
