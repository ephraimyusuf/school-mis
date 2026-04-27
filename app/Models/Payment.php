<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Student;
use App\Models\Fee;

class Payment extends Model
{
    protected $fillable = [
        'student_id',
        'fee_id',
        'amount_paid',
        'payment_date',
        'term',
        'method'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function fee()
    {
        return $this->belongsTo(Fee::class);
    }
}