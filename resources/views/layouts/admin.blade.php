<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">

<div x-data="{ open: false }" class="flex h-screen bg-gray-100">

    <!-- Sidebar -->
    <aside :class="{'block': open, 'hidden': !open}" 
        class="hidden sm:flex flex-col justify-between w-64 h-screen bg-[#1f2a5a] text-white">

        <!-- Top -->
        <div>
            <!-- Logo -->
            <div class="px-5 py-4 border-b border-[#2e3b73]">
                <h1 class="text-lg font-bold text-yellow-400 flex items-center gap-2">
                    🎓 Campus System
                </h1>
                <p class="text-xs text-gray-300 mt-1">Admin Panel</p>
            </div>

            <!-- Menu -->
            <nav class="mt-4 px-3 space-y-1 text-sm">

                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center gap-3 px-4 py-2 rounded-md
                   {{ request()->routeIs('admin.dashboard') ? 'bg-[#2d3f8a]' : 'hover:bg-[#2d3f8a]' }}">
                    📊 <span>Dashboard</span>
                </a>

                <a href="#"
                   class="flex items-center gap-3 px-4 py-2 rounded-md hover:bg-[#2d3f8a]">
                    🎓 <span>Students</span>
                </a>

                <a href="#"
                   class="flex items-center gap-3 px-4 py-2 rounded-md hover:bg-[#2d3f8a]">
                    👨‍🏫 <span>Teachers</span>
                </a>
  
                <a href="{{ route('admin.finance.index') }}"
   class="flex items-center gap-3 px-4 py-2 rounded-md hover:bg-[#2d3f8a]">
    💰 <span>Finance</span>
</a>
                <a href="#"
                   class="flex items-center gap-3 px-4 py-2 rounded-md hover:bg-[#2d3f8a]">
                    📄 <span>Reports</span>
                </a>

                <a href="#"
                   class="flex items-center gap-3 px-4 py-2 rounded-md hover:bg-[#2d3f8a]">
                    ⚙️ <span>Settings</span>
                </a>

            </nav>
        </div>

        <!-- Bottom -->
        <div class="px-4 py-4 border-t border-[#2e3b73]">
            <div class="text-sm font-semibold">
                {{ Auth::user()->name }}
            </div>
            <div class="text-xs text-gray-300 mb-3">
                {{ Auth::user()->email }}
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full bg-yellow-400 hover:bg-yellow-300 text-black font-medium py-2 rounded-md">
                    Logout
                </button>
            </form>
        </div>

    </aside>

    <!-- Main -->
    <div class="flex-1 flex flex-col">

        <!-- Navbar -->
        <nav class="bg-white border-b">
            <div class="flex justify-between h-16 px-4">

                <div class="flex items-center">
                    <button @click="open = !open" class="sm:hidden p-2 text-gray-600">
                        ☰
                    </button>
                    <span class="ml-2 font-semibold text-gray-800">Dashboard</span>
                </div>

                <div class="flex items-center">
                    <span class="text-gray-600">{{ Auth::user()->name }}</span>
                </div>

            </div>
        </nav>

        <!-- Content -->
        <main class="p-6">
            @yield('content')
        </main>

    </div>

</div>

</body>
</html>