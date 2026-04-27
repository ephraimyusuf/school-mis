@extends('layouts.admin')

@section('title', 'Payments')

@section('content')

<div class="mb-4 flex justify-between">
    <h1 class="text-xl font-bold">Payments</h1>
</div>

<table class="w-full bg-white shadow rounded-lg overflow-hidden text-sm">
    <thead class="bg-gray-100 text-left">
        <tr>
            <th class="p-3">Student</th>
            <th class="p-3">Fee</th>
            <th class="p-3">Amount</th>
            <th class="p-3">Date</th>
        </tr>
    </thead>

    <tbody>
        @forelse($payments as $payment)
            <tr class="border-b">
                <td class="p-3">
                    {{ $payment->student->first_name ?? 'N/A' }}
                </td>
                <td class="p-3">
                    {{ $payment->fee->name ?? 'N/A' }}
                </td>
                <td class="p-3">
                    MK {{ $payment->amount_paid }}
                </td>
                <td class="p-3">
                    {{ $payment->payment_date }}
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="text-center p-5 text-gray-500">
                    No payments found
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

@endsection