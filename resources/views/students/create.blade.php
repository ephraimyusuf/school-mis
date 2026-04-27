@extends('layouts.admin')
@section('title', 'Add Student')

@section('content')

<div class="max-w-3xl mx-auto bg-white p-6 rounded-xl shadow">

    <h2 class="text-xl font-bold mb-6">Add New Student</h2>

    <!-- Errors -->
    @if ($errors->any())
        <div class="bg-red-100 text-red-600 p-3 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.students.store') }}" method="POST">
        @csrf

        <!-- Names -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm">First Name</label>
                <input type="text" name="first_name" class="w-full border p-2 rounded" required>
            </div>

            <div>
                <label class="block text-sm">Last Name</label>
                <input type="text" name="last_name" class="w-full border p-2 rounded" required>
            </div>
        </div>

        <!-- DOB + Gender -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm">Date of Birth</label>
                <input type="date" name="dob" class="w-full border p-2 rounded" required>
            </div>

            <div>
                <label class="block text-sm">Gender</label>
                <select name="gender" class="w-full border p-2 rounded" required>
                    <option value="">Select</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
        </div>

        <!-- Contact -->
        <div>
            <label class="block text-sm">Phone Number</label>
            <input type="text" name="phone" class="w-full border p-2 rounded">
        </div>

        <!-- Address -->
        <div>
            <label class="block text-sm">Address</label>
            <input type="text" name="address" class="w-full border p-2 rounded">
        </div>

        <!-- Form -->
        <div>
            <label class="block text-sm">Form</label>
            <select name="form" class="w-full border p-2 rounded" required>
                <option value="F1">Form 1</option>
                <option value="F2">Form 2</option>
                <option value="F3">Form 3</option>
                <option value="F4">Form 4</option>
            </select>
        </div>

        <!-- Student Number -->
        <div>
            <label class="block text-sm">Student Number</label>
            <input type="number" name="student_number" class="w-full border p-2 rounded" placeholder="e.g. 26" required>
        </div>

        <!-- Submit -->
        <div class="flex justify-end">
            <button class="bg-green-600 text-white px-5 py-2 rounded hover:bg-green-700">
                Save Student
            </button>
        </div>

    </form>

</div>

@endsection