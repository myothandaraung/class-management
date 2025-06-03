<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';
    protected $fillable = [
        'enrollment_id',
        'amount',
        'payment_date',
        'payment_method',
        'payment_status',
    ];
    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class);
    }
}
