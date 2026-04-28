<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\StudentFee;

class Fee extends Model
{
    protected $fillable = [
        'name',
        'amount',
        'term'
    ];

    // A fee can be assigned to many students
    public function studentFees()
    {
        return $this->hasMany(StudentFee::class);
    }
}