
    </div>

</nav><nav x-data="{ open: false }" class="bg-[#1f2a5a] border-b border-[#2e3b73] text-white">

<div class="flex justify-between h-16 px-6">

    <!-- Left -->
    <div class="flex items-center gap-4">

        <!-- Hamburger -->
        <button @click="open = !open"
            class="sm:hidden p-2 text-gray-300 hover:bg-[#2d3f8a] rounded-md">
            ☰
        </button>

        <!-- Title -->
        <span class="font-semibold text-white">
            Dashboard
        </span>

    </div>

    <!-- Right -->
    <div class="flex items-center gap-4">

        <!-- Safe Auth Check -->
        @auth
            <span class="text-sm text-gray-200">
                {{ Auth::user()->name }}
            </span>
        @endauth

        @guest
            <span class="text-sm text-gray-300">
                Guest
            </span>
        @endguest

        <!-- Logout -->
        @auth
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="bg-yellow-400 hover:bg-yellow-300 text-black text-sm px-3 py-1.5 rounded-md">
                    Logout
                </button>
            </form>
        @endauth

    </div>
</div>

<!-- Mobile Menu -->
<div x-show="open" class="sm:hidden bg-[#2a356b] px-6 py-3 space-y-2">

    <a href="{{ route('admin.dashboard') }}" class="block text-sm text-white">
        Dashboard
    </a>

    <a href="{{ route('students.index') }}" class="block text-sm text-white">
        Students
    </a>

    <a href="{{ route('teachers.index') }}" class="block text-sm text-white">
        Teachers
    </a>

    <a href="{{ route('admin.classes.index') }}" class="block text-sm text-white">
        Classes
    </a>

</div>

</nav>