<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\ClassModel;

class ClassSubjectTeacher extends Model
{
    protected $fillable = [
        'class_id',
        'subject_id',
        'teacher_id',
        'is_deleted',
    ];

    public function class()
    {
        return $this->belongsTo(ClassModel::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
