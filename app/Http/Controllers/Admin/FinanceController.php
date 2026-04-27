<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
}