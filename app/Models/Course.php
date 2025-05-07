<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;

class Course extends Model
{
    protected $fillable = [
        'name',
        'description',
        'year',
    ];

    public function students()
    {
        return $this->belongsToMany(Student::class);
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'course_subject');
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'course_subject');
    }
}
