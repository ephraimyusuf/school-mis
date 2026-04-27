@extends('layouts.admin')

@section('title', 'Finance Dashboard')

@section('content')

<!-- HEADER -->
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Finance Dashboard</h1>
    <p class="text-sm text-gray-500">Overview of school income and payments</p>
</div>

<!-- KPI CARDS -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-6">

    <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white p-5 rounded-xl shadow">
        <h2 class="text-sm opacity-80">Total Fee Types</h2>
        <p class="text-3xl font-bold mt-2">{{ $totalFees }}</p>
    </div>

    <div class="bg-gradient-to-r from-green-500 to-green-600 text-white p-5 rounded-xl shadow">
        <h2 class="text-sm opacity-80">Total Payments</h2>
        <p class="text-3xl font-bold mt-2">MK {{ number_format($totalPayments, 2) }}</p>
    </div>

    <div class="bg-gradient-to-r from-purple-500 to-purple-600 text-white p-5 rounded-xl shadow">
        <h2 class="text-sm opacity-80">System Status</h2>
        <p class="text-2xl font-bold mt-2">Active</p>
    </div>

</div>
<!-- FINANCE ACTIONS -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">

    <!-- CREATE FEE -->
    <div class="bg-white p-5 rounded-xl shadow">
        <h2 class="font-semibold mb-4 text-gray-700">Add Fee (Per Term)</h2>

        <form action="{{ route('admin.fees.store') }}" method="POST" class="space-y-3">
            @csrf

            <input type="text" name="name" placeholder="Fee Name (e.g Tuition)"
                class="w-full border p-2 rounded" required>

            <input type="number" name="amount" placeholder="Amount (MK)"
                class="w-full border p-2 rounded" required>

            <input type="text" name="term" placeholder="Term (e.g Term 1 2026)"
                class="w-full border p-2 rounded" required>

            <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Save Fee
            </button>
        </form>
    </div>

    <!-- RECORD PAYMENT -->
    <div class="bg-white p-5 rounded-xl shadow">
        <h2 class="font-semibold mb-4 text-gray-700">Record Payment</h2>

        <form action="{{ route('admin.payments.store') }}" method="POST" class="space-y-3">
            @csrf

            <!-- Student -->
            <select name="student_id" class="w-full border p-2 rounded" required>
                <option value="">Select Student</option>
                @foreach(\App\Models\Student::all() as $student)
                    <option value="{{ $student->id }}">
                        {{ $student->first_name }} {{ $student->last_name }}
                    </option>
                @endforeach
            </select>

            <!-- Fee -->
            <select name="fee_id" class="w-full border p-2 rounded" required>
                <option value="">Select Fee</option>
                @foreach(\App\Models\Fee::all() as $fee)
                    <option value="{{ $fee->id }}">
                        {{ $fee->name }} - MK {{ $fee->amount }}
                    </option>
                @endforeach
            </select>

            <!-- Amount -->
            <input type="number" name="amount_paid" placeholder="Amount Paid"
                class="w-full border p-2 rounded" required>

            <!-- Date -->
            <input type="date" name="payment_date"
                class="w-full border p-2 rounded" required>

            <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Save Payment
            </button>
        </form>
    </div>

</div>

<!-- RECENT PAYMENTS -->
<div class="bg-white rounded-xl shadow overflow-hidden">

    <!-- Header -->
    <div class="p-5 border-b flex justify-between items-center">
        <h2 class="font-semibold text-gray-700">Recent Payments</h2>
        <span class="text-xs text-gray-400">Latest transactions</span>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="w-full text-sm">

            <thead class="bg-gray-50 text-gray-600 text-left">
                <tr>
                    <th class="p-3">Student</th>
                    <th class="p-3">Fee</th>
                    <th class="p-3">Amount</th>
                    <th class="p-3">Date</th>
                    <th class="p-3 text-center">Status</th>
                </tr>
            </thead>

            <tbody>

                @forelse($recentPayments as $payment)

                <tr class="border-b hover:bg-gray-50 transition">

                    <td class="p-3 font-medium text-gray-800">
                        {{ $payment->student->first_name }} {{ $payment->student->last_name }}
                    </td>

                    <td class="p-3 text-gray-600">
                        {{ $payment->fee->name }}
                    </td>

                    <td class="p-3 font-semibold text-gray-800">
                        MK {{ number_format($payment->amount_paid, 2) }}
                    </td>

                    <td class="p-3 text-gray-500">
                        {{ $payment->payment_date }}
                    </td>

                    <td class="p-3 text-center">
                        <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-600">
                            Paid
                        </span>
                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="5" class="text-center p-6 text-gray-400">
                        No payments recorded yet
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>
    </div>

</div>

@endsection