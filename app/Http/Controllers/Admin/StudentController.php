<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        // ✅ VALIDATION (FIXED)
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'dob' => 'required',
            'gender' => 'required',
            'form' => 'required',
            'student_number' => [
                'required',
                'integer',
                Rule::unique('students')->where(function ($query) use ($request) {
                    return $query->where('form', $request->form);
                }),
            ],
        ]);

        // ✅ GENERATE EMAIL
        $number = str_pad($request->student_number, 3, '0', STR_PAD_LEFT);
        $email = $request->form . '-' . $number . '@gog.com';

        // ✅ SAVE STUDENT (FIXED FIELDS)
        Student::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'address' => $request->address,
            'form' => $request->form,
            'student_number' => $request->student_number,
            'email' => $email,
        ]);

        return redirect()->back()->with('success', 'Student created successfully');
    }
}