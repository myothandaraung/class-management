<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\CourseSubject;

class Course extends Model
{
    protected $fillable = [
        'name',
        'description',
        'year',
        'department_id',
        'price',
        'is_deleted',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    // public function students()
    // {
    //     return $this->belongsToMany(Student::class);
    // }
    public function courseSubjects()
    {
        return $this->hasMany(CourseSubject::class);
    }
    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }
}
