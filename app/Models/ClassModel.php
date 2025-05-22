<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    protected $table = 'classes';
    
    protected $fillable = [
        'name',
        'description',
        'course_id',
        'start_date',
        'end_date',
        'is_deleted',
        'thumbnail'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_deleted' => 'boolean'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
