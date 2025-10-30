<header class="sticky top-0 z-50 bg-green-600 shadow-lg p-3">
    <div class="container mx-auto flex items-center justify-between h-10">
        <a href="{{route('index')}}" class="flex-shrink-0">
            <img src="{{ asset('images/sakofah-logo.png') }}" alt="Co-op Logo" class="h-9 w-auto">
        </a>
        <nav class="hidden md:block">
            <ul class="flex items-center space-x-5 lg:space-x-6">
                <li>
                    <a href="{{route('index')}}" class="nav-link text-white text-base font-medium hover:text-green-100 transition duration-300">หน้าหลัก</a>
                </li>


                <li class="relative full-width-dropdown-trigger">
                    <a href="#"
                        class="nav-link text-white text-base font-medium hover:text-green-100 transition duration-300 flex items-center">
                        เกี่ยวกับเรา
                        <svg class="ml-1 w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </a>
                </li>
                <li class="relative full-width-dropdown-trigger">
                    <a href="#"
                        class="nav-link text-white text-base font-medium hover:text-green-100 transition duration-300 flex items-center">
                        บริการสหกรณ์
                        <svg class="ml-1 w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </a>
                </li>
                <li class="relative full-width-dropdown-trigger">
                    <a href="#"
                        class="nav-link text-white text-base font-medium hover:text-green-100 transition duration-300 flex items-center">
                        สวัสดิการสมาชิก
                        <svg class="ml-1 w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </a>
                </li>
                <li class="relative full-width-dropdown-trigger">
                    <a href="#"
                        class="nav-link text-white text-base font-medium hover:text-green-100 transition duration-300 flex items-center">
                        ข่าวสาร
                        <svg class="ml-1 w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </a>
                </li>
                <li class="relative full-width-dropdown-trigger">
                    <a href="#"
                        class="nav-link text-white text-base font-medium hover:text-green-100 transition duration-300 flex items-center">
                        บริการสินทรัพย์
                        <svg class="ml-1 w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </a>
                </li>
                <li class="relative full-width-dropdown-trigger">
                    <a href="#"
                        class="nav-link text-white text-base font-medium hover:text-green-100 transition duration-300 flex items-center">
                        ดาวน์โหลด
                        <svg class="ml-1 w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </a>
                </li>
                <li class="relative full-width-dropdown-trigger">
                    <a href="#"
                        class="nav-link text-white text-base font-medium hover:text-green-100 transition duration-300 flex items-center">
                        ติดต่อ
                        <svg class="ml-1 w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </a>
                </li>

                <li class="relative full-width-dropdown-trigger">
                    <a href="#"
                        class="nav-link text-white text-base font-medium hover:text-green-100 transition duration-300 flex items-center">
                        พาทเนอร์สหกรณ์
                        <svg class="ml-1 w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </a>
                </li>
            </ul>
        </nav>

        <div class="md:hidden">
            <button id="mobile-menu-button" class="text-white focus:outline-none">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>
    </div>

    <div id="full-width-dropdown-overlay"
        class="fixed inset-x-0 top-16 bg-white shadow-xl opacity-0 invisible transition-all duration-300 ease-in-out z-30">
        <div class="container mx-auto px-4 py-8">
            <div id="dropdown-content-area" class="flex flex-wrap justify-start gap-x-12 gap-y-8">
            </div>
            <div class="mt-8 text-center">
                <p class="text-gray-500 text-sm">สอบถามเพิ่มเติม? <a href="/contact"
                        class="text-blue-600 hover:underline">ติดต่อเรา</a></p>
            </div>
        </div>
    </div>

    <div id="mobile-menu-overlay"
        class="fixed inset-0 bg-green-700 bg-opacity-95 z-40 hidden flex-col items-center justify-center md:hidden overflow-y-auto py-10">
        <button id="close-mobile-menu" class="absolute top-4 right-4 text-white text-4xl">&times;</button>
        <ul class="text-center w-full">
            <li><a href="/" class="block text-white text-2xl font-bold py-3 hover:text-green-200">หน้าหลัก</a>
            </li>
            <li>
                <div class="text-white text-2xl font-bold py-3 hover:text-green-200 flex items-center justify-center w-full cursor-pointer"
                    data-mobile-dropdown-toggle="about-us">
                    เกี่ยวกับเรา <svg class="ml-2 w-6 h-6 transform transition-transform duration-300"
                        data-mobile-dropdown-icon="about-us" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                        </path>
                    </svg>
                </div>
                <ul class="hidden bg-green-800 bg-opacity-80 py-2" data-mobile-dropdown-menu="about-us">
                    <li><a href="/history" class="block text-white text-xl py-2 hover:bg-green-700">ประวัติความเป็นมา</a></li>
                    <li><a href="/vision" class="block text-white text-xl py-2 hover:bg-green-700">วิสัยทัศน์ พันธกิจ วัตถุประสงค์</a></li>
                    <li><a href="/manager" class="block text-white text-xl py-2 hover:bg-green-700">คณะกรรมการและผู้บริหาร</a></li>
                    <li><a href="/office" class="block text-white text-xl py-2 hover:bg-green-700">สำนักงาน</a></li>
                    <li><a href="/structure" class="block text-white text-xl py-2 hover:bg-green-700">โครงสร้างสหกรณ์</a></li>
                </ul>
            </li>
            <li>
                <div class="text-white text-2xl font-bold py-3 hover:text-green-200 flex items-center justify-center w-full cursor-pointer" data-mobile-dropdown-toggle="coop-services">บริการสหกรณ์
                    <svg class="ml-2 w-6 h-6 transform transition-transform duration-300" data-mobile-dropdown-icon="coop-services" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </div>
                <ul class="hidden bg-green-800 bg-opacity-80 py-2" data-mobile-dropdown-menu="coop-services">
                    <li><a href="/register" class="block text-white text-xl py-2 hover:bg-green-700">สมัครสมาชิก</a>
                    </li>
                    <li><a href="/deposit" class="block text-white text-xl py-2 hover:bg-green-700">บริการเงินฝาก</a>
                    </li>
                    <li><a href="/credit_service"
                            class="block text-white text-xl py-2 hover:bg-green-700">บริการสินเชื่อ</a></li>
                </ul>
            </li>

            <li>
                <div class="text-white text-2xl font-bold py-3 hover:text-green-200 flex items-center justify-center w-full cursor-pointer"
                    data-mobile-dropdown-toggle="member-welfare">
                    สวัสดิการสมาชิก <svg class="ml-2 w-6 h-6 transform transition-transform duration-300"
                        data-mobile-dropdown-icon="member-welfare" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                        </path>
                    </svg>
                </div>
                <ul class="hidden bg-green-800 bg-opacity-80 py-2" data-mobile-dropdown-menu="member-welfare">
                    <li><a href="/marry"
                            class="block text-white text-xl py-2 hover:bg-green-700">สวัสดิการแต่งงาน</a></li>
                    <li><a href="/maternity"
                            class="block text-white text-xl py-2 hover:bg-green-700">สวัสดิการคลอดบุตร</a></li>
                    <li><a href="/oldage"
                            class="block text-white text-xl py-2 hover:bg-green-700">สวัสดิการเงินสมทบยามชรา</a></li>
                    <li><a href="/medical"
                            class="block text-white text-xl py-2 hover:bg-green-700">สวัสดิการช่วยเหลือค่ารักษาพยาบาล</a>
                    </li>
                    <li><a href="/dead"
                            class="block text-white text-xl py-2 hover:bg-green-700">สวัสดิการเสียชีวิต</a></li>
                </ul>
            </li>

            <li>
                <div class="text-white text-2xl font-bold py-3 hover:text-green-200 flex items-center justify-center w-full cursor-pointer"
                    data-mobile-dropdown-toggle="news">
                    ข่าวสาร <svg class="ml-2 w-6 h-6 transform transition-transform duration-300"
                        data-mobile-dropdown-icon="news" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                        </path>
                    </svg>
                </div>
                <ul class="hidden bg-green-800 bg-opacity-80 py-2" data-mobile-dropdown-menu="news">
                    <li><a href="/activity"
                            class="block text-white text-xl py-2 hover:bg-green-700">ข่าวสาร/กิจกรรมความเคลื่อนไหว</a>
                    </li>
                    <li><a href="/calender" class="block text-white text-xl py-2 hover:bg-green-700">ปฏิทินสหกรณ์</a>
                    </li>
                </ul>
            </li>
            <li>
                <div class="text-white text-2xl font-bold py-3 hover:text-green-200 flex items-center justify-center w-full cursor-pointer"
                    data-mobile-dropdown-toggle="asset-services">
                    บริการสินทรัพย์ <svg class="ml-2 w-6 h-6 transform transition-transform duration-300"
                        data-mobile-dropdown-icon="asset-services" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                        </path>
                    </svg>
                </div>
                <ul class="hidden bg-green-800 bg-opacity-80 py-2" data-mobile-dropdown-menu="asset-services">
                    <li><a href="/asset/homeList"
                            class="block text-white text-xl py-2 hover:bg-green-700">บ้านพร้อมที่ดิน/ทาวน์โฮม</a></li>
                    <li><a href="#" class="block text-white text-xl py-2 hover:bg-green-700">ที่ดินเปล่า</a>
                    </li>
                    <li><a href="#" class="block text-white text-xl py-2 hover:bg-green-700">คอนโด</a></li>
                </ul>
            </li>

            <li>
                <div class="text-white text-2xl font-bold py-3 hover:text-green-200 flex items-center justify-center w-full cursor-pointer"
                    data-mobile-dropdown-toggle="downloads">
                    ดาวน์โหลด <svg class="ml-2 w-6 h-6 transform transition-transform duration-300"
                        data-mobile-dropdown-icon="downloads" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                        </path>
                    </svg>
                </div>
                <ul class="hidden bg-green-800 bg-opacity-80 py-2" data-mobile-dropdown-menu="downloads">
                    <li><a href="/document"
                            class="block text-white text-xl py-2 hover:bg-green-700">เอกสารสำหรับสมาชิก</a></li>
                    <li><a href="/businessreport"
                            class="block text-white text-xl py-2 hover:bg-green-700">รายงานกิจการ</a></li>
                </ul>
            </li>

            <li>
                <div class="text-white text-2xl font-bold py-3 hover:text-green-200 flex items-center justify-center w-full cursor-pointer"
                    data-mobile-dropdown-toggle="contact">
                    ติดต่อ <svg class="ml-2 w-6 h-6 transform transition-transform duration-300"
                        data-mobile-dropdown-icon="contact" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                        </path>
                    </svg>
                </div>
                <ul class="hidden bg-green-800 bg-opacity-80 py-2" data-mobile-dropdown-menu="contact">
                    <li><a href="#"
                            class="block text-white text-xl py-2 hover:bg-green-700">แบบประเมินการให้บริการ</a></li>
                    <li><a href="/withus" class="block text-white text-xl py-2 hover:bg-green-700">ร่วมงานกับเรา</a>
                    </li>
                </ul>
            </li>

            <li>
                <div class="text-white text-2xl font-bold py-3 hover:text-green-200 flex items-center justify-center w-full cursor-pointer"
                    data-mobile-dropdown-toggle="partners">
                    พาทเนอร์สหกรณ์ <svg class="ml-2 w-6 h-6 transform transition-transform duration-300"
                        data-mobile-dropdown-icon="partners" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                        </path>
                    </svg>
                </div>
                <ul class="hidden bg-green-800 bg-opacity-80 py-2" data-mobile-dropdown-menu="partners">
                    <li><a href="#" class="block text-white text-xl py-2 hover:bg-green-700">ทิพยตะกาฟุล</a></li>
                    <li><a href="https://www.tiptakaful.com/th/insurance" target="_blank" rel="noopener noreferrer" class="block text-white text-xl py-2 hover:bg-green-700">ผลิตภัณฑ์ทิพยตะกาฟุล</a></li>
                    <li><a href="https://affinity.tipinsure.com/product/affinity/takaful_branch?branch=TKF_SKF" target="_blank" rel="noopener noreferrer" class="block text-white text-xl py-2 hover:bg-green-700">ซื้อประกันกับทิพยตะกาฟุล</a></li>
                </ul>
            </li>
        </ul>
    </div>
</header>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenuOverlay = document.getElementById('mobile-menu-overlay');
            const closeMobileMenuButton = document.getElementById('close-mobile-menu');

            if (mobileMenuButton && mobileMenuOverlay && closeMobileMenuButton) {
                mobileMenuButton.addEventListener('click', function() {
                    mobileMenuOverlay.classList.remove('hidden');
                    document.body.classList.add('overflow-hidden');
                });
                closeMobileMenuButton.addEventListener('click', function() {
                    mobileMenuOverlay.classList.add('hidden');
                    document.body.classList.remove('overflow-hidden');
                });
                mobileMenuOverlay.addEventListener('click', function(event) {
                    if (event.target === mobileMenuOverlay) {
                        mobileMenuOverlay.classList.add('hidden');
                        document.body.classList.remove('overflow-hidden');
                    }
                });
            }

            document.querySelectorAll('[data-mobile-dropdown-toggle]').forEach(function(toggle) {
                toggle.addEventListener('click', function() {
                    const targetId = toggle.getAttribute('data-mobile-dropdown-toggle');
                    const menu = document.querySelector(`[data-mobile-dropdown-menu="${targetId}"]`);
                    const icon = document.querySelector(`[data-mobile-dropdown-icon="${targetId}"]`);

                    if (menu) {
                        const isHidden = menu.classList.contains('hidden');
                        document.querySelectorAll('[data-mobile-dropdown-menu]').forEach(otherMenu => {
                            otherMenu.classList.add('hidden');
                        });
                        document.querySelectorAll('[data-mobile-dropdown-icon]').forEach(otherIcon => {
                            otherIcon.classList.remove('rotate-180');
                        });
                        if (isHidden) {
                            menu.classList.remove('hidden');
                            if (icon) icon.classList.add('rotate-180');
                        }
                    }
                });
            });

            const fullWidthDropdownTriggers = document.querySelectorAll('.full-width-dropdown-trigger');
            const fullWidthDropdownOverlay = document.getElementById('full-width-dropdown-overlay');
            const dropdownContentArea = document.getElementById('dropdown-content-area');
            let hideTimeout;
            const dropdownContents = {
                'เกี่ยวกับเรา': `
                    <div>
                        <h3 class="text-lg font-bold text-gray-800 mb-4">เกี่ยวกับเรา</h3>
                        <ul class="space-y-2 text-sm">
                            <li><a href="{{ route('history') }}" class="block text-gray-700 hover:text-blue-600 p-1 rounded-md transition duration-300">ประวัติความเป็นมา</a></li>
                            <li><a href="{{ route('vision') }}" class="block text-gray-700 hover:text-blue-600 p-1 rounded-md transition duration-300">วิสัยทัศน์ พันธกิจ วัตถุประสงค์</a></li>
                            <li><a href="{{ route('manager') }}" class="block text-gray-700 hover:text-blue-600 p-1 rounded-md transition duration-300">คณะกรรมการและผู้บริหาร</a></li>
                            <li><a href="{{ route('office') }}" class="block text-gray-700 hover:text-blue-600 p-1 rounded-md transition duration-300">สำนักงาน</a></li>
                            <li><a href="{{ route('mobile') }}" class="block text-gray-700 hover:text-blue-600 p-1 rounded-md transition duration-300">รถโมบายเคลื่อนที่</a></li>
                            <li><a href="{{ route('structure') }}" class="block text-gray-700 hover:text-blue-600 p-1 rounded-md transition duration-300">โครงสร้างสหกรณ์</a></li>
                        </ul>
                    </div>
                `,
                'บริการสหกรณ์': `
                    <div>
                        <h3 class="text-lg font-bold text-gray-800 mb-4">บริการสหกรณ์</h3>
                        <ul class="space-y-2 text-sm">
                            <li><a href="{{ route('register') }}" class="block text-gray-700 hover:text-blue-600 p-1 rounded-md transition duration-300">สมัครสมาชิก</a></li>
                            <li><a href="{{ route('deposit') }}" class="block text-gray-700 hover:text-blue-600 p-1 rounded-md transition duration-300">บริการเงินฝาก</a></li>
                            <li><a href="{{ route('credit_service') }}" class="block text-gray-700 hover:text-blue-600 p-1 rounded-md transition duration-300">บริการสินเชื่อ</a></li>
                        </ul>
                    </div>
                `,
                'สวัสดิการสมาชิก': `
                    <div>
                        <h3 class="text-lg font-bold text-gray-800 mb-4">ประเภทสวัสดิการ</h3>
                        <ul class="space-y-2 text-sm columns-2 gap-x-8">
                            <li><a href="{{ route('marry') }}" class="block text-gray-700 hover:text-blue-600 p-1 rounded-md transition duration-300">สวัสดิการแต่งงาน</a></li>
                            <li><a href="{{ route('maternity') }}" class="block text-gray-700 hover:text-blue-600 p-1 rounded-md transition duration-300">สวัสดิการคลอดบุตร</a></li>
                            <li><a href="{{ route('oldage') }}" class="block text-gray-700 hover:text-blue-600 p-1 rounded-md transition duration-300">สวัสดิการเงินสมทบยามชรา</a></li>
                            <li><a href="{{ route('medical') }}" class="block text-gray-700 hover:text-blue-600 p-1 rounded-md transition duration-300">สวัสดิการช่วยเหลือค่ารักษาพยาบาล</a></li>
                            <li><a href="{{ route('dead') }}" class="block text-gray-700 hover:text-blue-600 p-1 rounded-md transition duration-300">สวัสดิการเสียชีวิต</a></li>
                        </ul>
                    </div>
                `,
                 'ข่าวสาร': `
                    <div>
                        <h3 class="text-lg font-bold text-gray-800 mb-4">ติดตามข่าวสาร</h3>
                        <ul class="space-y-2 text-sm">
                            <li><a href="{{ route('activity') }}" class="block text-gray-700 hover:text-blue-600 p-1 rounded-md transition duration-300">ข่าวสาร/กิจกรรมความเคลื่อนไหว</a></li>
                            <li><a href="{{ route('calender') }}" class="block text-gray-700 hover:text-blue-600 p-1 rounded-md transition duration-300">ปฏิทินสหกรณ์</a></li>
                        </ul>
                    </div>
                `,
                'บริการสินทรัพย์': `
                    <div>
                        <h3 class="text-lg font-bold text-gray-800 mb-4">ประเภทสินทรัพย์</h3>
                        <ul class="space-y-2 text-sm">
                            <li><a href="{{ route('homeList') }}" class="block text-gray-700 hover:text-blue-600 p-1 rounded-md transition duration-300">บ้านพร้อมที่ดิน/ทาวน์โฮม</a></li>
                            <li><a href="{{ route('vacantList') }}" class="block text-gray-700 hover:text-blue-600 p-1 rounded-md transition duration-300">ที่ดินเปล่า</a></li>
                            <li><a href="{{ route('condoList') }}" class="block text-gray-700 hover:text-blue-600 p-1 rounded-md transition duration-300">คอนโด</a></li>
                        </ul>
                    </div>
                `,
                'ดาวน์โหลด': `
                    <div>
                        <h3 class="text-lg font-bold text-gray-800 mb-4">เอกสารสำคัญ</h3>
                         <ul class="space-y-2 text-sm">
                            <li><a href="{{ route('document') }}" class="block text-gray-700 hover:text-blue-600 p-1 rounded-md transition duration-300">เอกสารสำหรับสมาชิก</a></li>
                            <li><a href="{{ route('businessreport') }}" class="block text-gray-700 hover:text-blue-600 p-1 rounded-md transition duration-300">รายงานกิจการ</a></li>
                        </ul>
                    </div>
                `,
                'ติดต่อ': `
                    <div>
                        <h3 class="text-lg font-bold text-gray-800 mb-4">ช่องทางการติดต่อ</h3>
                        <ul class="space-y-2 text-sm">
                            <li><a href="#" class="block text-gray-700 hover:text-blue-600 p-1 rounded-md transition duration-300">แบบประเมินการให้บริการ</a></li>
                            <li><a href="{{ route('withus') }}" class="block text-gray-700 hover:text-blue-600 p-1 rounded-md transition duration-300">ร่วมงานกับเรา</a></li>
                            <li><a href="{{ route('office') }}" class="block text-gray-700 hover:text-blue-600 p-1 rounded-md transition duration-300">สำนักงานสาขา</a></li>
                        </ul>
                    </div>
                `,
                'พาทเนอร์สหกรณ์': `
                     <div>
                        <h3 class="text-lg font-bold text-gray-800 mb-4">พันธมิตรของเรา</h3>
                        <ul class="space-y-2 text-sm">
                            <li><a href="#" class="block text-gray-700 hover:text-blue-600 p-1 rounded-md transition duration-300">ทิพยตะกาฟุล</a></li>
                            <li><a href="https://www.tiptakaful.com/th/insurance" target="_blank" rel="noopener noreferrer" class="block text-gray-700 hover:text-blue-600 p-1 rounded-md transition duration-300">ผลิตภัณฑ์ทิพยตะกาฟุล</a></li>
                            <li><a href="https://affinity.tipinsure.com/product/affinity/takaful_branch?branch=TKF_SKF" target="_blank" rel="noopener noreferrer" class="block text-gray-700 hover:text-blue-600 p-1 rounded-md transition duration-300">ซื้อประกันกับทิพยตะกาฟุล</a></li>
                        </ul>
                    </div>
                `
            };

            function showDropdown(trigger) {
                clearTimeout(hideTimeout);
                const menuText = trigger.querySelector('.nav-link').textContent.trim();
                const content = dropdownContents[menuText];

                if (content) {
                    dropdownContentArea.innerHTML = content;
                    fullWidthDropdownOverlay.classList.remove('invisible', 'opacity-0');
                    fullWidthDropdownOverlay.classList.add('visible', 'opacity-100');
                }
            }

            function hideDropdown() {
                hideTimeout = setTimeout(() => {
                    fullWidthDropdownOverlay.classList.remove('visible', 'opacity-100');
                    fullWidthDropdownOverlay.classList.add('invisible', 'opacity-0');
                }, 200);
            }

            fullWidthDropdownTriggers.forEach(trigger => {
                trigger.addEventListener('mouseenter', () => showDropdown(trigger));
                trigger.addEventListener('mouseleave', hideDropdown);
            });

            fullWidthDropdownOverlay.addEventListener('mouseenter', () => clearTimeout(hideTimeout));
            fullWidthDropdownOverlay.addEventListener('mouseleave', hideDropdown);
        });
    </script>
@endpush
