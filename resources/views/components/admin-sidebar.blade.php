<div x-show="sidebarOpen" x-transition:enter="transition-opacity ease-linear duration-300"
    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
    x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0" class="fixed inset-0 z-20 bg-gray-900 bg-opacity-50 lg:hidden glass"
    @click="sidebarOpen = false"></div>

<aside :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'"
    class="fixed inset-y-0 left-0 z-30 w-64 overflow-y-auto transition duration-300 transform bg-emerald-900 lg:translate-x-0 lg:static lg:inset-0 shadow-2xl flex flex-col">

    <div class="flex items-center justify-center h-20 shadow-md bg-emerald-950">
        <div class="flex items-center space-x-3">
            <img src="{{ asset('images/sakofah-logo.png') }}" alt="Logo"
                class="h-10 w-10 bg-white p-1 rounded-full shadow-sm">
            <span class="text-xl font-bold text-white tracking-wide">ADMIN PANEL</span>
        </div>
    </div>

    <nav class="flex-1 mt-6 px-4 space-y-6 pb-4">

        <div>
            <p class="px-2 text-xs font-semibold text-emerald-400 uppercase tracking-wider mb-2">
                งานสมาชิก
            </p>
            <a href="{{ route('member') }}"
                class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('member') ? 'bg-emerald-600 text-white shadow-lg' : 'text-emerald-100 hover:bg-emerald-800 hover:text-white' }}">
                <i class="fas fa-users w-5 h-5 transition-transform group-hover:scale-110"></i>
                <span class="ml-3 font-medium">ค้นหาสมาชิก</span>
            </a>
        </div>

        <div>
            <p class="px-2 text-xs font-semibold text-emerald-400 uppercase tracking-wider mb-2">
                เอกสารและข้อมูล
            </p>
            <div class="space-y-1">
                <a href="{{ route('rules') }}"
                    class="flex items-center px-4 py-2.5 rounded-xl transition-all duration-200 group {{ request()->routeIs('rules') ? 'bg-emerald-600 text-white' : 'text-emerald-100 hover:bg-emerald-800 hover:text-white' }}">
                    <i class="fas fa-gavel w-5 h-5"></i>
                    <span class="ml-3">ข้อบังคับ/ระเบียบ</span>
                </a>
                <a href="{{ route('order') }}"
                    class="flex items-center px-4 py-2.5 rounded-xl transition-all duration-200 group {{ request()->routeIs('order') ? 'bg-emerald-600 text-white' : 'text-emerald-100 hover:bg-emerald-800 hover:text-white' }}">
                    <i class="fas fa-book w-5 h-5"></i>
                    <span class="ml-3">ระเบียบสหกรณ์</span>
                </a>
                <a href="{{ route('publish') }}"
                    class="flex items-center px-4 py-2.5 rounded-xl transition-all duration-200 group {{ request()->routeIs('publish') ? 'bg-emerald-600 text-white' : 'text-emerald-100 hover:bg-emerald-800 hover:text-white' }}">
                    <i class="fas fa-bullhorn w-5 h-5"></i>
                    <span class="ml-3">ประกาศภายใน</span>
                </a>
                <a href="{{ route('form') }}"
                    class="flex items-center px-4 py-2.5 rounded-xl transition-all duration-200 group {{ request()->routeIs('form') ? 'bg-emerald-600 text-white' : 'text-emerald-100 hover:bg-emerald-800 hover:text-white' }}">
                    <i class="fas fa-file-alt w-5 h-5"></i>
                    <span class="ml-3">แบบฟอร์มเจ้าหน้าที่</span>
                </a>
                <a href="{{ route('performance.index') }}"
                    class="flex items-center px-4 py-2.5 rounded-xl transition-all duration-200 group {{ request()->routeIs('performance.index') ? 'bg-emerald-600 text-white' : 'text-emerald-100 hover:bg-emerald-800 hover:text-white' }}">
                    <i class="fas fa-chart-pie w-5 h-5"></i>
                    <span class="ml-3">ผลการดำเนินงาน</span>
                </a>
            </div>
        </div>

        <div>
            <p class="px-2 text-xs font-semibold text-emerald-400 uppercase tracking-wider mb-2">
                งานสินเชื่อ
            </p>
            <div class="space-y-1">
                <a href="{{ route('searchcredit') }}"
                    class="flex items-center px-4 py-2.5 rounded-xl transition-all duration-200 group {{ request()->routeIs('searchcredit') ? 'bg-emerald-600 text-white' : 'text-emerald-100 hover:bg-emerald-800 hover:text-white' }}">
                    <i class="fas fa-search-dollar w-5 h-5"></i>
                    <span class="ml-3">ค้นหาสินเชื่อ</span>
                </a>
                <a href="{{ route('uploadcredit') }}"
                    class="flex items-center px-4 py-2.5 rounded-xl transition-all duration-200 group {{ request()->routeIs('uploadcredit') ? 'bg-emerald-600 text-white' : 'text-emerald-100 hover:bg-emerald-800 hover:text-white' }}">
                    <i class="fas fa-cloud-upload-alt w-5 h-5"></i>
                    <span class="ml-3">อัพโหลดสินเชื่อ</span>
                </a>
            </div>
        </div>

        <div>
            <p class="px-2 text-xs font-semibold text-emerald-400 uppercase tracking-wider mb-2">
                งานขายสินทรัพย์
            </p>
            <div class="space-y-1">
                <a href="{{ route('asset.index') }}"
                    class="flex items-center px-4 py-2.5 rounded-xl transition-all duration-200 group {{ request()->routeIs('asset.*') ? 'bg-emerald-600 text-white' : 'text-emerald-100 hover:bg-emerald-800 hover:text-white' }}">
                    <i class="fas fa-sign-hanging w-5 h-5"></i>
                    <span class="ml-3">จัดการทรัพย์สิน</span>
                </a>
            </div>
        </div>

        @if (session('level_code') == 'P')
            <div>
                <p class="px-2 text-xs font-semibold text-amber-400 uppercase tracking-wider mb-2">
                    ผู้ดูแลระบบ (Admin)
                </p>
                <div class="space-y-1">
                    <a href="{{ route('news.index') }}"
                        class="flex items-center px-4 py-2.5 rounded-xl transition-all duration-200 group text-emerald-100 hover:bg-emerald-800 hover:text-white">
                        <i class="fas fa-newspaper w-5 h-5"></i>
                        <span class="ml-3">ข่าวสาร/กิจกรรม</span>
                    </a>
                    <a href="{{ route('performance.add') }}"
                        class="flex items-center px-4 py-2.5 rounded-xl transition-all duration-200 group text-emerald-100 hover:bg-emerald-800 hover:text-white">
                        <i class="fas fa-chart-line w-5 h-5"></i>
                        <span class="ml-3">เพิ่มผลการดำเนินงาน</span>
                    </a>
                    <a href="{{ route('login.history') }}"
                        class="flex items-center px-4 py-2.5 rounded-xl transition-all duration-200 group text-emerald-100 hover:bg-emerald-800 hover:text-white">
                        <i class="fas fa-history w-5 h-5"></i>
                        <span class="ml-3">ประวัติการเข้าใช้งาน</span>
                    </a>
                    <a href="{{ route('announcements.index') }}"
                        class="flex items-center px-4 py-2.5 rounded-xl transition-all duration-200 group text-emerald-100 hover:bg-emerald-800 hover:text-white">
                        <i class="fas fa-file-upload w-5 h-5"></i>
                        <span class="ml-3">อัพโหลดประกาศ</span>
                    </a>
                    <a href="{{ route('credit.index') }}"
                        class="flex items-center px-4 py-2.5 rounded-xl transition-all duration-200 group text-emerald-100 hover:bg-emerald-800 hover:text-white">
                        <i class="fas fa-credit-card w-5 h-5"></i>
                        <span class="ml-3">จัดการรายการสินเชื่อ</span>
                    </a>
                    <a href="{{ route('admin.logs') }}"
                        class="flex items-center px-4 py-2.5 rounded-xl transition-all duration-200 group text-emerald-100 hover:bg-emerald-800 hover:text-white">
                        <i class="fas fa-terminal w-5 h-5"></i>
                        <span class="ml-3">บันทึกระบบ</span>
                    </a>
                </div>
            </div>
        @endif

    </nav>
</aside>
