<?php


namespace App\Services;

use App\Models\Student;
use Carbon\Carbon;

class StudentService
{
    public function generateAdmissionNumber()
    {
        $year = Carbon::now()->year;
        $last = Student::latest('id')->first();

        $nextId = $last ? $last->id + 1 : 1;

        return 'MS-' . $year . '-' . str_pad($nextId, 4, '0', STR_PAD_LEFT);
    }
}