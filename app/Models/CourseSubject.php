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
}
