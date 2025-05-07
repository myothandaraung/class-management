<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Course;
use App\Models\Teacher;

class Subject extends Model
{
    protected $fillable = [
        'name',
        'description',
        'code',
        'type',
    ];

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_subject');
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'course_subject');
    }
}
