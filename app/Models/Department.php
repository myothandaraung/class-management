<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'name',
        'description',
        'thumbnail',
        'is_deleted',
    ];

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
