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
        'position',
        'department_id',
        'thumbnail',
        'user_id'
    ];

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
