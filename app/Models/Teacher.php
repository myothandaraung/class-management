<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Course;
use App\Models\Subject;

class Teacher extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'date_of_birth',
        'address',
        'gender',
        'qualification',
        'specialization',
        'user_id',
        'designation',
        'department',
        'role',
        'user_id'
    ];

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_subject');
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'course_subject');
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
