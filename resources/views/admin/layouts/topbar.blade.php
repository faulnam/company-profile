<header class="bg-[#f8f9fa] h-24 flex items-center justify-between px-6 md:px-8 z-10 sticky top-0">
    <!-- Left Side: Mobile Toggle & Page Title -->
    <div class="flex flex-col">
        <div class="flex items-center">
            <button @click="sidebarOpen = true" class="md:hidden text-gray-500 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-gray-900 rounded-md mr-4">
                <i class="fa-solid fa-bars text-xl"></i>
            </button>
            <h1 class="text-2xl font-bold text-gray-800">@yield('header')</h1>
        </div>
        <div class="hidden md:block mt-1">
            <p class="text-sm text-gray-500">Dashboard / <span class="text-gray-400">@yield('header')</span></p>
        </div>
    </div>

    <!-- Right Side -->
    <div class="flex items-center space-x-4">
        <!-- User Dropdown Pill -->
        <div class="relative" x-data="{ open: false }" @click.outside="open = false">
            <button @click="open = !open" class="flex items-center space-x-3 focus:outline-none bg-[#e2e8f0] hover:bg-gray-300 transition px-2 py-1.5 rounded-full border border-gray-200 shadow-sm">
                <div class="w-8 h-8 rounded-full bg-black text-white flex items-center justify-center font-bold text-xs">
                    {{ substr(Auth::user()->name, 0, 2) }}
                </div>
                <span class="text-sm font-semibold text-gray-800 hidden sm:block pr-1">{{ Auth::user()->name }}</span>
                <i class="fa-solid fa-chevron-down text-xs text-gray-500 pr-2"></i>
            </button>

            <!-- Dropdown Menu -->
            <div x-show="open" x-transition.opacity style="display: none;" class="absolute right-0 mt-2 w-48 bg-white border border-gray-100 rounded-lg shadow-lg py-1 z-50">
                <div class="px-4 py-3 border-b border-gray-100">
                    <p class="text-sm font-bold text-gray-900">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-gray-500 truncate mt-0.5">{{ Auth::user()->email }}</p>
                </div>
                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                    <i class="fa-regular fa-user w-5 text-gray-400"></i> Profile
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors">
                        <i class="fa-solid fa-arrow-right-from-bracket w-5"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>
