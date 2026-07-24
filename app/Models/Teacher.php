<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = ['user_id', 'employee_id', 'qualification', 'address'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function assignments()
    {
        return $this->hasMany(TeacherSubjectSection::class);
    }

    public function timetables()
    {
        return $this->hasMany(Timetable::class);
    }
}
