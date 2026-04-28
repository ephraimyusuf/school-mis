<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\SchoolClass;

class DashboardController extends Controller
{
    public function index()
    {
        $students = Student::count();
        $teachers = Teacher::count();
        $classes = SchoolClass::count();

        $recentStudents = Student::latest()->take(5)->get();
        $students = Student::with('payments')->get();
        $paid = $student->payments->sum('amount_paid');
$balance = $student->fees_total - $paid;
        return view('admin.dashboard', compact(
            'students',
            'teachers',
            'classes',
            'recentStudents'
        ));
    }
}