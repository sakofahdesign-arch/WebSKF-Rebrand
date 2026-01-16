<header class="flex items-center justify-between px-6 py-4 bg-white shadow-sm border-b border-gray-100 z-10">

    <div class="flex items-center">
        <button @click="sidebarOpen = true"
            class="text-gray-500 focus:outline-none lg:hidden hover:text-emerald-600 transition">
            <i class="fas fa-bars fa-lg"></i>
        </button>

        <div class="hidden md:block ml-4">
            <h2 class="text-xl font-semibold text-gray-800">
                <span class="text-emerald-600">ยินดีต้อนรับ,</span> {{ session('username') }}
            </h2>
            <p class="text-xs text-gray-500">{{ now()->format('d M Y') }}</p>
        </div>
    </div>

    <div class="flex items-center space-x-4">

        <div x-data="{ dropdownOpen: false }" class="relative">
            <button @click="dropdownOpen = !dropdownOpen"
                class="flex items-center space-x-3 focus:outline-none transition duration-150 rounded-full p-1 pr-3 hover:bg-gray-50 border border-transparent hover:border-gray-200">
                <img class="h-9 w-9 rounded-full object-cover border-2 border-emerald-500"
                    src="https://ui-avatars.com/api/?name={{ urlencode(session('username', 'Admin')) }}&background=10B981&color=fff&size=128"
                    alt="User avatar">
                <div class="hidden md:block text-left">
                    <span class="block text-sm font-medium text-gray-700 leading-none">{{ session('username') }}</span>
                    <span class="block text-xs text-gray-500 mt-0.5">
                        {{ session('level_code') == 'P' ? 'Administrator' : 'Staff Member' }}
                    </span>
                </div>
                <i class="fas fa-chevron-down text-xs text-gray-400 ml-1"></i>
            </button>

            <div x-show="dropdownOpen" @click.away="dropdownOpen = false" x-cloak
                x-transition:enter="transition ease-out duration-100"
                x-transition:enter-start="transform opacity-0 scale-95"
                x-transition:enter-end="transform opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-75"
                x-transition:leave-start="transform opacity-100 scale-100"
                x-transition:leave-end="transform opacity-0 scale-95"
                class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-lg border border-gray-100 py-2 z-50">

                <div class="px-4 py-3 border-b border-gray-100 md:hidden">
                    <p class="text-sm font-semibold text-gray-700">{{ session('username') }}</p>
                    <p class="text-xs text-gray-500">ID: {{ session('user_id', '-') }}</p>
                </div>

                <a href="#"
                    class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-emerald-50 hover:text-emerald-700 transition">
                    <i class="fas fa-user-circle w-4 mr-2 text-gray-400"></i> โปรไฟล์ส่วนตัว
                </a>

                <div class="border-t border-gray-100 my-1"></div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();"
                        class="flex items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50 hover:text-red-700 transition cursor-pointer">
                        <i class="fas fa-sign-out-alt w-4 mr-2"></i> ออกจากระบบ
                    </a>
                </form>
            </div>
        </div>
    </div>
</header>
