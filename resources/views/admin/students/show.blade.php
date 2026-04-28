<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="max-w-6xl mx-auto py-10">

    <!-- BACK -->
    <a href="{{ route('admin.students.index') }}"
       class="text-blue-600 hover:underline mb-4 inline-block">
        ← Back to Students
    </a>

    <!-- HEADER CARD -->
    <div class="bg-white shadow-lg rounded-xl p-6 mb-6 flex items-center justify-between">

        <div class="flex items-center gap-4">

            <div class="w-16 h-16 bg-blue-600 text-white flex items-center justify-center text-2xl rounded-full">
                {{ strtoupper(substr($student->first_name, 0, 1)) }}
            </div>

            <div>
                <h1 class="text-2xl font-bold text-gray-800">
                    {{ $student->first_name }} {{ $student->last_name }}
                </h1>
                <p class="text-gray-500">
                    Form {{ $student->form }} • Student No: {{ $student->student_number }}
                </p>
            </div>

        </div>

        <span class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm font-semibold">
            Active Student
        </span>

    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <!-- LEFT: PERSONAL INFO -->
        <div class="bg-white shadow-lg rounded-xl p-6 space-y-3">

            <h3 class="text-lg font-bold text-gray-800 mb-2">Personal Information</h3>

            <p><span class="font-semibold">Phone:</span> {{ $student->phone }}</p>
            <p><span class="font-semibold">Email:</span> {{ $student->email }}</p>
            <p><span class="font-semibold">Gender:</span> {{ $student->gender }}</p>
            <p><span class="font-semibold">DOB:</span> {{ $student->dob }}</p>

            <div class="pt-2">
                <p class="font-semibold">Address:</p>
                <p class="text-gray-600">{{ $student->address }}</p>
            </div>

        </div>

        <!-- MIDDLE: ACADEMIC -->
        <div class="bg-white shadow-lg rounded-xl p-6">

            <h3 class="text-lg font-bold text-gray-800 mb-4">Academic Information</h3>

            <div class="space-y-2">
                <p><span class="font-semibold">Student Number:</span> {{ $student->student_number }}</p>
                <p><span class="font-semibold">Form:</span> {{ $student->form }}</p>
                <p><span class="font-semibold">Enrollment:</span> 2026</p>
            </div>

            <div class="mt-6 p-4 bg-blue-50 rounded-lg">
                <p class="text-blue-700 font-semibold">Performance Status</p>
                <p class="text-sm text-gray-600">No academic records yet</p>
            </div>

        </div>

        <!-- RIGHT: FINANCE -->
        <div class="bg-white shadow-lg rounded-xl p-6">

            <h3 class="text-lg font-bold mb-4">Finance Summary</h3>

            <!-- Total Fees -->
            <div class="bg-gray-100 p-3 rounded-lg mb-3">
                <p class="text-sm text-gray-500">Total Fees</p>
                <p class="text-xl font-bold text-gray-800">
                    MWK {{ number_format($totalFees, 2) }}
                </p>
            </div>

            <!-- Total Paid -->
            <div class="bg-gray-100 p-3 rounded-lg mb-3">
                <p class="text-sm text-gray-500">Total Paid</p>
                <p class="text-xl font-bold text-green-600">
                    MWK {{ number_format($totalPaid, 2) }}
                </p>
            </div>

            <!-- Balance -->
            <div class="bg-gray-100 p-3 rounded-lg">
                <p class="text-sm text-gray-500">Balance</p>
                <p class="text-xl font-bold {{ $balance > 0 ? 'text-red-600' : 'text-green-600' }}">
                    MWK {{ number_format($balance, 2) }}
                </p>
            </div>

            <!-- BUTTON -->
            <a href="{{ route('admin.finance.invoice', $student->id) }}"
               class="mt-5 block text-center bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg">
                View Invoice
            </a>

        </div>

    </div>

</div>

</body>
</html>