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
        'is_deleted',
    ];

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'class_subject_teacher');
    }
}
