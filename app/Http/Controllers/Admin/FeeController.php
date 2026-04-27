<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Fee;

class FeeController extends Controller
{
  
    public function index()
    {
        $fees = Fee::latest()->get();
    
        return view('admin.fees.index', compact('fees'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'amount' => 'required|numeric',
            'term' => 'required',
        ]);

        Fee::create([
            'name' => $request->name,
            'amount' => $request->amount,
            'term' => $request->term,
        ]);

        return redirect()->back()->with('success', 'Fee added successfully');
    }
}