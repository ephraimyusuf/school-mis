<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Fee;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    /*
    |---------------------------------------
    | CREATE VIEW
    |---------------------------------------
    */
    public function create()
    {
        return view('admin.students.create');
    }

    /*
    |---------------------------------------
    | STORE STUDENT
    |---------------------------------------
    */
    public function store(Request $request)
    {
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

        $number = str_pad($request->student_number, 3, '0', STR_PAD_LEFT);
        $email = $request->form . '-' . $number . '@gog.com';

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

        return redirect()->route('admin.students.index')
            ->with('success', 'Student created successfully');
    }

    /*
    |---------------------------------------
    | LIST + SEARCH
    |---------------------------------------
    */
    public function index(Request $request)
    {
        $query = Student::query();

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        $students = $query->latest()->get();

        return view('admin.students.index', compact('students'));
    }

    /*
    |---------------------------------------
    | SHOW STUDENT PROFILE + FINANCE
    |---------------------------------------
    */
    public function show(Student $student)
{
    $totalFees = Fee::where('form', $student->form)->sum('amount');

    $totalPaid = Payment::where('student_id', $student->id)->sum('amount');

    $balance = max($totalFees - $totalPaid, 0);

    return view('admin.students.show', compact(
        'student',
        'totalFees',
        'totalPaid',
        'balance'
    ));
}
   
    

    /*
    |---------------------------------------
    | EDIT
    |---------------------------------------
    */
    public function edit(Student $student)
    {
        return view('admin.students.edit', compact('student'));
    }

    /*
    |---------------------------------------
    | UPDATE (SAFE VERSION)
    |---------------------------------------
    */
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'dob' => 'required',
            'gender' => 'required',
            'form' => 'required',
        ]);

        $student->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'address' => $request->address,
            'form' => $request->form,
        ]);

        return redirect()->route('admin.students.index')
            ->with('success', 'Student updated successfully');
    }

    /*
    |---------------------------------------
    | DELETE
    |---------------------------------------
    */
    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('admin.students.index')
            ->with('success', 'Student deleted successfully');
    }
}