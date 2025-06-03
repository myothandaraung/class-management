<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    protected $table = 'enrollments';
    protected $fillable = [
        'student_id',
        'class_id',
        'enrollment_date',
        'status',
    ];
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function class()
    {
        return $this->belongsTo(ClassModel::class);
    }
    public function payment()
    {
        return $this->hasMany(Payment::class);
    }
}
