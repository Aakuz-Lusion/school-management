<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $fillable = [
        'teacher_id', 'subject_id', 'section_id', 'title', 'description', 'attachment', 'due_date',
    ];

    protected $casts = [
        'due_date' => 'datetime',
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function submissions()
    {
        return $this->hasMany(AssignmentSubmission::class);
    }

    public function isOverdue(): bool
    {
        return now()->greaterThan($this->due_date);
    }
}
