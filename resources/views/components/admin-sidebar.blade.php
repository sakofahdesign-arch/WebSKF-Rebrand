<div x-show="sidebarOpen" class="fixed inset-0 z-20 bg-black opacity-50 transition-opacity lg:hidden" @click="sidebarOpen = false"></div>

<aside x-show="sidebarOpen" x-transition:enter="transition ease-in-out duration-300"
    x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
    x-transition:leave="transition ease-in-out duration-300" x-transition:leave-start="translate-x-0"
    x-transition:leave-end="-translate-x-full"
    class="fixed inset-y-0 left-0 z-30 w-64 bg-green-800 text-white overflow-y-auto lg:static lg:translate-x-0">

    <div class="flex items-center justify-center mt-8">
        <div class="flex items-center">
            <img src="{{ asset('images/sakofah-logo.png') }}" alt="Logo" class="h-10 w-auto bg-white p-1 rounded-full">
            <span class="ml-3 text-2xl font-bold">DASHBOARD</span>
        </div>
    </div>

    <nav class="mt-10 px-2">
        <div class="space-y-6">

            <div>
                <h3 class="px-4 mb-2 text-xs font-semibold uppercase text-green-300 tracking-wider">จัดการสมาชิก</h3>
                <div class="mt-2 space-y-1">
                    <a href="{{ route('member') }}"
                        class="flex items-center px-4 py-2 rounded-md transition-colors duration-200 {{ request()->routeIs('member') ? 'bg-green-700' : 'hover:bg-green-700' }}">
                        <i class="fas fa-search w-5 h-5"></i>
                        <span class="ml-3">ค้นหาสมาชิก</span>
                    </a>
                </div>
            </div>

            <div>
                <h3 class="px-4 mb-2 text-xs font-semibold uppercase text-green-300 tracking-wider">เอกสารภายใน</h3>
                <div class="mt-2 space-y-1">
                    <a href="{{ route('rules') }}"
                        class="flex items-center px-4 py-2 rounded-md hover:bg-green-700 transition-colors duration-200">
                        <i class="fas fa-gavel w-5 h-5"></i>
                        <span class="ml-3">ข้อบังคับ/ระเบียบ</span>
                    </a>
                    <a href="{{ route('order') }}"
                        class="flex items-center px-4 py-2 rounded-md hover:bg-green-700 transition-colors duration-200">
                        <i class="fas fa-book w-5 h-5"></i>
                        <span class="ml-3">ระเบียบสหกรณ์</span>
                    </a>
                    <a href="{{ route('publish') }}"
                        class="flex items-center px-4 py-2 rounded-md hover:bg-green-700 transition-colors duration-200">
                        <i class="fas fa-bullhorn w-5 h-5"></i>
                        <span class="ml-3">ประกาศภายใน</span>
                    </a>
                    <a href="{{ route('form') }}"
                        class="flex items-center px-4 py-2 rounded-md hover:bg-green-700 transition-colors duration-200">
                        <i class="fas fa-file-alt w-5 h-5"></i>
                        <span class="ml-3">แบบฟอร์มเจ้าหน้าที่</span>
                    </a>
                    <a href="{{ route('performance.index') }}"
                        class="flex items-center px-4 py-2 rounded-md hover:bg-green-700 transition-colors duration-200">
                        <i class="fas fa-chart-pie w-5 h-5"></i>
                        <span class="ml-3">ผลการดำเนินงาน</span>
                    </a>
                </div>
            </div>

            <div>
                <h3 class="px-4 mb-2 text-xs font-semibold uppercase text-green-300 tracking-wider">จัดการสินเชื่อ</h3>
                <div class="mt-2 space-y-1">
                    <a href="{{ route('searchcredit') }}"
                        class="flex items-center px-4 py-2 rounded-md hover:bg-green-700 transition-colors duration-200">
                        <i class="fas fa-search-dollar w-5 h-5"></i>
                        <span class="ml-3">ค้นหาสินเชื่อ</span>
                    </a>
                    <a href="{{ route('uploadcredit') }}"
                        class="flex items-center px-4 py-2 rounded-md hover:bg-green-700 transition-colors duration-200">
                        <i class="fas fa-upload w-5 h-5"></i>
                        <span class="ml-3">อัพโหลดสินเชื่อ</span>
                    </a>
                </div>
            </div>

            @if (session('level_code') == 'P')
                <div>
                    <h3 class="px-4 mb-2 text-xs font-semibold uppercase text-green-300 tracking-wider">
                        จัดการเนื้อหาเว็บไซต์</h3>
                    <div class="mt-2 space-y-1">
                        <a href="{{ route('news.index') }}"
                            class="flex items-center px-4 py-2 rounded-md hover:bg-green-700 transition-colors duration-200">
                            <i class="fas fa-newspaper w-5 h-5"></i>
                            <span class="ml-3">จัดการประกาศ/ข่าวสาร</span>
                        </a>
                        <a href="{{ route('asset.index') }}"
                            class="flex items-center px-4 py-2 rounded-md hover:bg-green-700 transition-colors duration-200">
                            <i class="fas fa-building w-5 h-5"></i>
                            <span class="ml-3">จัดการสินทรัพย์</span>
                        </a>
                    </div>
                </div>

                <div>
                    <h3 class="px-4 mb-2 text-xs font-semibold uppercase text-green-300 tracking-wider">ระบบและรายงาน</h3>
                    <div class="mt-2 space-y-1">
                        <a href="{{ route('performance.add') }}"
                            class="flex items-center px-4 py-2 rounded-md hover:bg-green-700 transition-colors duration-200">
                            <i class="fas fa-chart-line w-5 h-5"></i>
                            <span class="ml-3">เพิ่มผลการดำเนินงาน</span>
                        </a>
                        <a href="{{route('login.history')}}"
                            class="flex items-center px-4 py-2 rounded-md hover:bg-green-700 transition-colors duration-200">
                            <i class="fas fa-history w-5 h-5"></i>
                            <span class="ml-3">ประวัติการล็อกอิน</span>
                        </a>
                        <a href="{{route('announcements.index')}}"
                            class="flex items-center px-4 py-2 rounded-md hover:bg-green-700 transition-colors duration-200">
                            <i class="fas fa-file-upload w-5 h-5"></i>
                            <span class="ml-3">อัพโหลดประกาศ</span>
                        </a>
                        <a href="{{route('credit.index')}}"
                            class="flex items-center px-4 py-2 rounded-md hover:bg-green-700 transition-colors duration-200">
                            <i class="fa fa-credit-card w-5 h-5"></i>
                            <span class="ml-3">รายการสินเชื่อ</span>
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </nav>
</aside>