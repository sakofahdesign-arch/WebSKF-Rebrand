<header class="flex justify-between items-center p-4 bg-white border-b-2 border-gray-200">
    <div>
        <button @click="sidebarOpen = !sidebarOpen" class="text-gray-500 focus:outline-none lg:hidden">
            <i class="fas fa-bars fa-lg"></i>
        </button>
    </div>

    <div x-data="{ dropdownOpen: false }" class="relative">
        <button @click="dropdownOpen = !dropdownOpen" class="flex items-center space-x-2 relative focus:outline-none">
            <h2 class="text-gray-700 text-sm font-medium hidden sm:block">เจ้าหน้าที่:
                {{ session('username') }}</h2>
            <img class="h-9 w-9 rounded-full object-cover"
                src="https://ui-avatars.com/api/?name={{ urlencode(session('username', 'Admin')) }}&background=34D399&color=fff"
                alt="Your avatar">
        </button>

        <div x-show="dropdownOpen" @click.away="dropdownOpen = false" x-cloak
            class="absolute right-0 mt-2 w-48 bg-white rounded-md overflow-hidden shadow-xl z-10">
            <a href="#"
                class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-600 hover:text-white">Profile</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-600 hover:text-white">
                    ออกจากระบบ
                </a>
            </form>
        </div>
    </div>
</header>
