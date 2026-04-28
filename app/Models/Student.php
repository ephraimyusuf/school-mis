<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Payment;
use App\Models\StudentFee;

class Student extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'dob',
        'gender',
        'phone',
        'address',
        'form',
        'student_number',
        'email'
    ];

    // 💰 Payments relationship
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    // 📚 Student Fees relationship (THIS FIXES YOUR ERROR)
    public function fees()
    {
        return $this->hasMany(StudentFee::class);
    }

    // 💵 Total fees
    public function getTotalFeesAttribute()
    {
        return $this->fees->sum('amount');
    }

    // 💰 Total paid
    public function getTotalPaidAttribute()
    {
        return $this->payments->sum('amount_paid');
    }

    // 📊 Balance
    public function getBalanceAttribute()
    {
        return $this->total_fees - $this->total_paid;
    }
    public function show(Student $student)
{
    return view('admin.students.show', compact('student'));
}
}