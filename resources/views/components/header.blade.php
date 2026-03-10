<header class="sticky top-0 z-50 w-full bg-green-600 shadow-lg text-white font-sans">
    <div class="navbar container mx-auto px-2 lg:px-4">

        <div class="flex-1">
            <div class="dropdown lg:hidden">
                <div tabindex="0" role="button" class="btn btn-ghost text-white lg:hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h8m-8 6h16" />
                    </svg>
                </div>
                <ul tabindex="0"
                    class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-white text-gray-800 rounded-box w-80">
                    <li><a href="{{ route('index') }}" class="font-bold text-green-700">หน้าหลัก</a></li>

                    <li>
                        <a>เกี่ยวกับเรา</a>
                        <ul class="p-2">
                            <li><a href="{{ route('history') }}">ประวัติความเป็นมา</a></li>
                            <li><a href="{{ route('vision') }}">วิสัยทัศน์ พันธกิจ</a></li>
                            <li><a href="{{ route('manager') }}">คณะกรรมการและผู้บริหาร</a></li>
                            <li><a href="{{ route('structure') }}">โครงสร้างสหกรณ์</a></li>
                            <li><a href="{{ route('mobile') }}">รถโมบาย</a>></li>
                        </ul>
                    </li>

                    <li>
                        <a>บริการสหกรณ์</a>
                        <ul class="p-2">
                            <li><a href="{{ route('register') }}">สมัครสมาชิก</a></li>
                            <li><a href="{{ route('deposit') }}">บริการเงินฝาก</a></li>
                            <li><a href="{{ route('credit_service') }}">บริการสินเชื่อ</a></li>
                        </ul>
                    </li>

                    <li>
                        <a>สวัสดิการสมาชิก</a>
                        <ul class="p-2">
                            <li><a href="{{ route('marry') }}">แต่งงาน / คลอดบุตร</a></li>
                            <li><a href="{{ route('oldage') }}">เงินสมทบยามชรา</a></li>
                            <li><a href="{{ route('medical') }}">ค่ารักษาพยาบาล</a></li>
                            <li><a href="{{ route('dead') }}">สวัสดิการเสียชีวิต</a></li>
                        </ul>
                    </li>

                    <li>
                        <a>ข่าวสาร</a>
                        <ul class="p-2">
                            <li><a href="{{ route('activity') }}">กิจกรรมความเคลื่อนไหว</a></li>
                            <li><a href="{{ route('calender') }}">ปฏิทินสหกรณ์</a></li>
                        </ul>
                    </li>

                    <li>
                        <a>บริการสินทรัพย์</a>
                        <ul class="p-2">
                            <li><a href="{{ route('homeList') }}">บ้านพร้อมที่ดิน</a></li>
                            <li><a href="{{ route('vacantList') }}">ที่ดินเปล่า</a></li>
                            <li><a href="{{ route('condoList') }}">คอนโด</a></li>
                        </ul>
                    </li>

                    <li>
                        <a>ดาวน์โหลด</a>
                        <ul class="p-2">
                            <li><a href="{{ route('document') }}">เอกสารสำหรับสมาชิก</a></li>
                            <li><a href="{{ route('businessreport') }}">รายงานกิจการ</a></li>
                        </ul>
                    </li>

                    <li>
                        <a>ติดต่อ</a>
                        <ul class="p-2">
                            <li><a href="#">แบบประเมินการให้บริการ</a></li>
                            <li><a href="{{ route('withus') }}">ร่วมงานกับเรา</a></li>
                            <li><a href="{{ route('office') }}">สาขา</a></li>
                        </ul>
                    </li>
                </ul>
            </div>

            <a href="{{ route('index') }}" class="btn btn-ghost text-xl hover:bg-green-700 px-2 h-auto py-2">
                <img src="{{ asset('images/sakofah-logo.png') }}" alt="Sakofah Logo"
                    class="h-10 w-auto lg:brightness-100 lg:invert-0">
            </a>
        </div>

        <div class="hidden lg:flex flex-none">
            <ul class="menu menu-horizontal px-1 gap-1 text-base font-medium">

                <li><a href="{{ route('index') }}" class="hover:bg-green-700 hover:text-white rounded-md">หน้าหลัก</a>
                </li>

                <li class="dropdown dropdown-hover dropdown-end group">
                    <div tabindex="0" role="button"
                        class="group-hover:bg-green-700 rounded-md flex items-center gap-1">
                        เกี่ยวกับเรา <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4 opacity-70 group-hover:rotate-180 transition-transform duration-300"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                    <ul tabindex="0"
                        class="dropdown-content z-[1] menu p-2 shadow-xl bg-white text-gray-800 rounded-box w-60 mt-0">
                        <li><a href="{{ route('history') }}"
                                class="hover:bg-green-50 hover:text-green-700">ประวัติความเป็นมา</a></li>
                        <li><a href="{{ route('vision') }}" class="hover:bg-green-50 hover:text-green-700">วิสัยทัศน์
                                พันธกิจ</a></li>
                        <li><a href="{{ route('manager') }}"
                                class="hover:bg-green-50 hover:text-green-700">คณะกรรมการ/ผู้บริหาร</a></li>
                        <li><a href="{{ route('office') }}" class="hover:bg-green-50 hover:text-green-700">สำนักงาน</a>
                        </li>
                        <li><a href="{{ route('structure') }}"
                                class="hover:bg-green-50 hover:text-green-700">โครงสร้างสหกรณ์</a></li>
                        <li><a href="{{ route('mobile') }}" class="hover:bg-green-50 hover:text-green-700">รถโมบาย</a>
                        </li>
                    </ul>
                </li>

                <li class="dropdown dropdown-hover dropdown-end group">
                    <div tabindex="0" role="button"
                        class="group-hover:bg-green-700 rounded-md flex items-center gap-1">
                        บริการสหกรณ์ <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4 opacity-70 group-hover:rotate-180 transition-transform duration-300"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                    <ul tabindex="0"
                        class="dropdown-content z-[1] menu p-2 shadow-xl bg-white text-gray-800 rounded-box w-52 mt-0">
                        <li><a href="{{ route('register') }}"
                                class="hover:bg-green-50 hover:text-green-700">สมัครสมาชิก</a></li>
                        <li><a href="{{ route('deposit') }}"
                                class="hover:bg-green-50 hover:text-green-700">บริการเงินฝาก</a></li>
                        <li><a href="{{ route('credit_service') }}"
                                class="hover:bg-green-50 hover:text-green-700">บริการสินเชื่อ</a></li>
                    </ul>
                </li>

                <li class="dropdown dropdown-hover dropdown-end group">
                    <div tabindex="0" role="button"
                        class="group-hover:bg-green-700 rounded-md flex items-center gap-1">
                        สวัสดิการ <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4 opacity-70 group-hover:rotate-180 transition-transform duration-300"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                    <ul tabindex="0"
                        class="dropdown-content z-[1] menu p-2 shadow-xl bg-white text-gray-800 rounded-box w-64 mt-0">
                        <li><a href="{{ route('marry') }}"
                                class="hover:bg-green-50 hover:text-green-700">สวัสดิการแต่งงาน</a></li>
                        <li><a href="{{ route('maternity') }}"
                                class="hover:bg-green-50 hover:text-green-700">สวัสดิการคลอดบุตร</a></li>
                        <li><a href="{{ route('oldage') }}"
                                class="hover:bg-green-50 hover:text-green-700">เงินสมทบยามชรา</a></li>
                        <li><a href="{{ route('medical') }}"
                                class="hover:bg-green-50 hover:text-green-700">ค่ารักษาพยาบาล</a></li>
                        <li><a href="{{ route('dead') }}"
                                class="hover:bg-green-50 hover:text-green-700">สวัสดิการเสียชีวิต</a></li>
                    </ul>
                </li>

                <li class="dropdown dropdown-hover dropdown-end group">
                    <div tabindex="0" role="button"
                        class="group-hover:bg-green-700 rounded-md flex items-center gap-1">
                        ข่าวสาร <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4 opacity-70 group-hover:rotate-180 transition-transform duration-300"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                    <ul tabindex="0"
                        class="dropdown-content z-[1] menu p-2 shadow-xl bg-white text-gray-800 rounded-box w-52 mt-0">
                        <li><a href="{{ route('activity') }}"
                                class="hover:bg-green-50 hover:text-green-700">กิจกรรม/ความเคลื่อนไหว</a></li>
                        <li><a href="{{ route('calender') }}"
                                class="hover:bg-green-50 hover:text-green-700">ปฏิทินสหกรณ์</a></li>
                    </ul>
                </li>

                <li class="dropdown dropdown-hover dropdown-end group">

                    <div tabindex="0" role="button"
                        class="group-hover:bg-green-700 rounded-md flex items-center gap-1">
                        <span class="fire-text">🔥ขายสินทรัพย์🔥</span>
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4 opacity-70 group-hover:rotate-180 transition-transform duration-300"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>

                    <ul tabindex="0"
                        class="dropdown-content z-[1] menu p-2 shadow-xl bg-white text-gray-800 rounded-box w-60 mt-0">
                        <li><a href="{{ route('homeList') }}"
                                class="hover:bg-red-50 hover:text-red-600">บ้านพร้อมที่ดิน/ทาวน์โฮม</a></li>
                        <li><a href="{{ route('vacantList') }}"
                                class="hover:bg-red-50 hover:text-red-600">ที่ดินเปล่า</a></li>
                        <li><a href="{{ route('condoList') }}" class="hover:bg-red-50 hover:text-red-600">คอนโด</a>
                        </li>
                    </ul>
                </li>

                <li class="dropdown dropdown-hover dropdown-end group">
                    <div tabindex="0" role="button"
                        class="group-hover:bg-green-700 rounded-md flex items-center gap-1">
                        ดาวน์โหลด <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4 opacity-70 group-hover:rotate-180 transition-transform duration-300"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                    <ul tabindex="0"
                        class="dropdown-content z-[1] menu p-2 shadow-xl bg-white text-gray-800 rounded-box w-56 mt-0">
                        <li><a href="{{ route('document') }}"
                                class="hover:bg-green-50 hover:text-green-700">เอกสารสำหรับสมาชิก</a></li>
                        <li><a href="{{ route('businessreport') }}"
                                class="hover:bg-green-50 hover:text-green-700">รายงานกิจการ</a></li>
                    </ul>
                </li>

                <li class="dropdown dropdown-hover dropdown-end group">
                    <div tabindex="0" role="button"
                        class="group-hover:bg-green-700 rounded-md flex items-center gap-1">
                        ติดต่อ <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4 opacity-70 group-hover:rotate-180 transition-transform duration-300"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                    <ul tabindex="0"
                        class="dropdown-content z-[1] menu p-2 shadow-xl bg-white text-gray-800 rounded-box w-56 mt-0">
                        <li><a href="#" class="hover:bg-green-50 hover:text-green-700">แบบประเมินบริการ</a></li>
                        <li><a href="{{ route('withus') }}"
                                class="hover:bg-green-50 hover:text-green-700">ร่วมงานกับเรา</a></li>
                    </ul>
                </li>

                <li class="dropdown dropdown-hover dropdown-end group">
                    <div tabindex="0" role="button"
                        class="group-hover:bg-green-700 rounded-md flex items-center gap-1">
                        พาทเนอร์ <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4 opacity-70 group-hover:rotate-180 transition-transform duration-300"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                    <ul tabindex="0"
                        class="dropdown-content z-[1] menu p-2 shadow-xl bg-white text-gray-800 rounded-box w-60 mt-0">
                        <li><a href="https://www.tiptakaful.com/th/insurance" target="_blank"
                                class="hover:bg-green-50 hover:text-green-700">ผลิตภัณฑ์ทิพยตะกาฟุล</a></li>
                        <li><a href="https://affinity.tipinsure.com/product/affinity/takaful_branch?branch=TKF_SKF"
                                target="_blank" class="hover:bg-green-50 hover:text-green-700">ซื้อประกันออนไลน์</a>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</header>
