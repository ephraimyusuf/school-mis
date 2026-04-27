@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')

<div class="space-y-6">

    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">School Dashboard</h1>
            <p class="text-sm text-gray-500">Welcome back, {{ Auth::user()->name }}</p>
        </div>

        <div class="flex gap-2">
        <a href="{{ route('admin.students.create') }}" 
   class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700">
    + Add Student
</a>
            <a href="#" class="bg-green-600 text-white px-4 py-2 rounded shadow hover:bg-green-700">
                + Add Teacher
            </a>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

        <div class="bg-white p-5 rounded-xl shadow hover:shadow-md transition">
            <h2 class="text-sm text-gray-500">Total Students</h2>
            <p class="text-3xl font-bold text-blue-600">{{ $students }}</p>
        </div>

        <div class="bg-white p-5 rounded-xl shadow hover:shadow-md transition">
            <h2 class="text-sm text-gray-500">Total Teachers</h2>
            <p class="text-3xl font-bold text-green-600">{{ $teachers }}</p>
        </div>

        <div class="bg-white p-5 rounded-xl shadow hover:shadow-md transition">
            <h2 class="text-sm text-gray-500">Classes</h2>
            <p class="text-3xl font-bold text-purple-600">{{ $classes }}</p>
        </div>

        <div class="bg-white p-5 rounded-xl shadow hover:shadow-md transition">
            <h2 class="text-sm text-gray-500">Attendance Today</h2>
            <p class="text-3xl font-bold text-orange-500">85%</p>
        </div>

    </div>

    <!-- Main Content -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Recent Students -->
        <div class="lg:col-span-2 bg-white p-5 rounded-xl shadow">
            <h2 class="text-lg font-semibold mb-4 text-gray-700">Recent Students</h2>

            <table class="w-full text-sm text-left">
                <thead class="border-b text-gray-500">
                    <tr>
                        <th class="py-2">Name</th>
                        <th>Class</th>
                        <th>Gender</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentStudents ?? [] as $student)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-2">{{ $student->first_name }} {{ $student->last_name }}</td>
                        <td>{{ $student->form }}</td>
                        <td>{{ $student->gender }}</td>
                        <td>
                            <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-600">
                                Active
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-3 text-gray-400">
                            No students found
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Quick Info / Notices -->
        <div class="bg-white p-5 rounded-xl shadow">
            <h2 class="text-lg font-semibold mb-4 text-gray-700">School Info</h2>

            <div class="space-y-3 text-sm">
                <p><strong>Term:</strong> Term 2</p>
                <p><strong>Academic Year:</strong> 2026</p>
                <p><strong>Next Exam:</strong> Mid-Term Exams</p>
                <p><strong>Location:</strong> Malawi Secondary School</p>
            </div>

            <hr class="my-4">

            <h3 class="text-md font-semibold text-gray-700 mb-2">Announcements</h3>
            <ul class="text-sm text-gray-600 space-y-2">
                <li>📌 PTA Meeting this Friday</li>
                <li>📌 Exams start next week</li>
                <li>📌 Fees deadline approaching</li>
            </ul>
        </div>

    </div>

</div>

@endsection