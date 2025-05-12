<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Course;
use App\Models\Teacher;

class Student extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'date_of_birth',
        'address',
        'gender',
        'nationality',
        'thumbnail',
        'user_id',
    ];

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class);
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
