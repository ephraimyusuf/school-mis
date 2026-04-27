<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Student;
use App\Models\Fee;

class PaymentController extends Controller
{public function index()
    {
        return view('admin.payments.index', [
            'payments' => \App\Models\Payment::with(['student', 'fee'])->latest()->get()
        ]);
    }
 
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required',
            'fee_id' => 'required',
            'amount_paid' => 'required|numeric',
            'payment_date' => 'required',
        ]);

        Payment::create($request->all());

        return redirect()->back()->with('success', 'Payment recorded successfully');
    }
}