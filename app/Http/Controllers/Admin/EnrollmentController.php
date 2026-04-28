<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    //use App\Models\Enrollment;

public function store(Request $request)
{
    $request->validate([
        'student_id' => 'required',
        'school_class_id' => 'required',
        'year' => 'required',
    ]);

    Enrollment::create($request->all());

    return back()->with('success', 'Student assigned to class');
}
}
