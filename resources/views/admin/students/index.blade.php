<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Students</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="max-w-7xl mx-auto py-10">

    <!-- HEADER -->
    <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-6">

        <div>
            <h1 class="text-3xl font-bold text-gray-800">Students</h1>
            <p class="text-gray-500">Manage all registered students</p>
        </div>

        <!-- SEARCH + BUTTON -->
        <div class="flex gap-3">

            <!-- Search Form -->
            <form method="GET" action="{{ route('admin.students.index') }}" class="flex">

                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       placeholder="Search student..."
                       class="px-4 py-2 border rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-500">

                <button type="submit"
                        class="bg-gray-700 text-white px-4 py-2 rounded-r-lg hover:bg-gray-800">
                    Search
                </button>

            </form>

            <!-- Add Button -->
            <a href="{{ route('admin.students.create') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700">
                + Add Student
            </a>

        </div>

    </div>

    <!-- TABLE CARD -->
    <div class="bg-white shadow-lg rounded-xl overflow-hidden">

        <table class="w-full text-sm text-left">

            <!-- TABLE HEADER -->
            <thead class="bg-blue-600 text-white uppercase text-xs">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Student</th>
                    <th class="px-4 py-3">Form</th>
                    <th class="px-4 py-3">Phone</th>
                    <th class="px-4 py-3">Email</th>
                    <th class="px-4 py-3 text-center">Actions</th>
                </tr>
            </thead>

            <!-- TABLE BODY -->
            <tbody>

                @forelse($students as $student)

                <tr class="border-b hover:bg-gray-50 transition">

                    <td class="px-4 py-3 font-semibold text-gray-600">
                        {{ $student->id }}
                    </td>

                    <td class="px-4 py-3 font-semibold text-gray-800">
                        {{ $student->first_name }} {{ $student->last_name }}
                    </td>

                    <td class="px-4 py-3">
                        <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs">
                            {{ $student->form }}
                        </span>
                    </td>

                    <td class="px-4 py-3 text-gray-600">
                        {{ $student->phone }}
                    </td>

                    <td class="px-4 py-3 text-gray-600">
                        {{ $student->email }}
                    </td>

                    <!-- ACTIONS -->
                    <td class="px-4 py-3">

                        <div class="flex justify-center gap-2">

                            <a href="{{ route('admin.students.show', $student->id) }}"
                               class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-1 rounded text-xs">
                                View
                            </a>

                            <a href="{{ route('admin.students.edit', $student->id) }}"
                               class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-xs">
                                Edit
                            </a>

                            <a href="{{ route('admin.finance.invoice', $student->id) }}"
                               class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-xs">
                                Invoice
                            </a>

                            <form action="{{ route('admin.students.destroy', $student->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Delete this student?')">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-xs">
                                    Delete
                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="6" class="text-center py-10 text-gray-500">
                        No students found
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

</body>
</html>