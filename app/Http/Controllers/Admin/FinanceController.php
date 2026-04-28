<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Student;
use App\Models\Payment;


class FinanceController extends Controller
{
    public function index()
    {
        return view('admin.finance.index', [
            'totalFees' => \App\Models\Fee::count(),
            'totalPayments' => \App\Models\Payment::sum('amount_paid'),
            'recentPayments' => \App\Models\Payment::latest()->take(5)->get(),
        ]);
    }
    public function invoice(Student $student)
{
    $fees = $student->fees()->with('fee')->get();
    $total = $fees->sum('amount');

    return view('admin.finance.invoice', compact('student', 'fees', 'total'));
}

public function invoicePdf($id)
{
    $student = Student::with(['fees.fee', 'payments'])->findOrFail($id);
    $fees = $student->fees;
    $total = $fees->sum('amount');

    $pdf = Pdf::loadView('admin.finance.invoice_pdf', compact('student', 'fees', 'total'));

    return $pdf->download('invoice.pdf');
}
}