<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseSubject extends Model
{
    protected $fillable = [
        'course_id',
        'subject_id',
        'is_deleted',
    ];
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
