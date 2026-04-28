<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-10">

<div class="max-w-3xl mx-auto bg-white shadow-lg rounded-xl p-8">

    <!-- Header -->
    <div class="flex justify-between items-center border-b pb-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-blue-700">School Invoice</h1>
            <p class="text-sm text-gray-500">Finance Department</p>
        </div>
        <div class="text-right">
            <p class="text-sm">Date: {{ now()->format('d M Y') }}</p>
        </div>
    </div>

    <!-- Student Info -->
    <div class="mb-6">
        <h2 class="text-lg font-semibold">Student Details</h2>
        <p><strong>Name:</strong> {{ $student->first_name }} {{ $student->last_name }}</p>
        <p><strong>Class:</strong> {{ $student->class ?? 'N/A' }}</p>
    </div>

    <!-- Fees Table -->
    <table class="w-full border border-gray-200 rounded-lg overflow-hidden">
        <thead class="bg-blue-600 text-white">
            <tr>
                <th class="p-3 text-left">Fee</th>
                <th class="p-3 text-right">Amount (MWK)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($fees as $fee)
                <tr class="border-b">
                    <td class="p-3">{{ $fee->fee->name }}</td>
                    <td class="p-3 text-right">{{ number_format($fee->amount, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Totals -->
    <div class="mt-6 text-right">
        <p class="text-lg"><strong>Total Fees:</strong> MWK {{ number_format($total, 2) }}</p>
        <p class="text-green-600"><strong>Paid:</strong> MWK {{ number_format($student->total_paid, 2) }}</p>
        <p class="text-red-600 text-xl font-bold">
            Balance: MWK {{ number_format($student->balance, 2) }}
        </p>
    </div>

    <!-- Actions -->
    <div class="mt-8 flex justify-between">
        <a href="{{ url()->previous() }}" 
           class="bg-gray-500 text-white px-4 py-2 rounded">
           Back
        </a>

        <a href="{{ url('/finance/invoice/pdf/'.$student->id) }}" 
           class="bg-blue-600 text-white px-4 py-2 rounded">
           Download PDF
        </a>
    </div>

</div>

</body>
</html>