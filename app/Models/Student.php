<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'user_id', 'roll_no', 'school_class_id', 'section_id',
        'guardian_name', 'guardian_phone', 'address',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function submissions()
    {
        return $this->hasMany(AssignmentSubmission::class);
    }
}
