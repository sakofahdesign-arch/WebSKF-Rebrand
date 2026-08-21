<footer class="relative z-20 isolate bg-[#022c22] text-white font-sans mt-auto">
    <div class="container mx-auto px-6 py-8">
        <div class="grid grid-cols-1 gap-8 text-left md:grid-cols-2 lg:grid-cols-[1.1fr_0.9fr_1.1fr_0.9fr]">
            <div class="flex flex-col items-start gap-3">
                <div class="rounded-md bg-white p-1.5">
                    <img src="{{ asset('images/sakofah-logo.png') }}" alt="Sakofah Logo"
                        class="h-10 w-auto object-contain">
                </div>

                <div>
                    <h3 class="mb-1.5 text-base font-bold">สหกรณ์อิสลามษะกอฟะฮ จำกัด</h3>
                    <p class="max-w-sm text-sm leading-relaxed text-emerald-50/85">
                        เรามุ่งมั่นที่จะเป็นองค์กรทางการเงินที่มั่นคงและยั่งยืน
                        เพื่อยกระดับคุณภาพชีวิตของสมาชิกภายใต้หลักการอิสลาม
                    </p>
                </div>
            </div>

            <div>
                <h3 class="mb-4 inline-block border-b border-emerald-500/70 pb-1.5 text-lg font-bold text-white">บริการสมาชิก
                </h3>
                <ul class="space-y-2.5 text-sm text-emerald-50/85">
                    <li><a href="{{ route('register') }}"
                            class="inline-block transition hover:translate-x-1 hover:text-white"><i
                                class="fas fa-angle-right mr-2 text-xs"></i>สมัครสมาชิก</a></li>
                    <li><a href="{{ route('deposit') }}"
                            class="inline-block transition hover:translate-x-1 hover:text-white"><i
                                class="fas fa-angle-right mr-2 text-xs"></i>บริการเงินฝาก</a></li>
                    <li><a href="{{ route('credit_service') }}"
                            class="inline-block transition hover:translate-x-1 hover:text-white"><i
                                class="fas fa-angle-right mr-2 text-xs"></i>บริการสินเชื่อ</a></li>
                    <li><a href="{{ route('document') }}"
                            class="inline-block transition hover:translate-x-1 hover:text-white"><i
                                class="fas fa-angle-right mr-2 text-xs"></i>ดาวน์โหลดเอกสาร</a></li>
                </ul>
            </div>

            <div>
                <h3 class="mb-4 inline-block border-b border-emerald-500/70 pb-1.5 text-lg font-bold text-white">ติดต่อเรา</h3>
                <ul class="space-y-3 text-sm text-emerald-50/85">
                    <li class="flex items-start gap-3">
                        <i class="fas fa-map-marker-alt mt-1 w-5 text-center text-base text-emerald-300"></i>
                        <div>
                            <span>เลขที่ 291 หมู่ที่ 1 ตำบลคลองยาง <br>อำเภอเกาะลันตา จังหวัดกระบี่ 81120</span>
                        </div>
                    </li>
                    <li class="flex items-center gap-3">
                        <i class="fas fa-phone-alt w-5 text-center text-base text-emerald-300"></i>
                        <span class="text-base font-semibold text-white">075-652-525</span>
                    </li>
                    <li class="footer-social-links flex items-center gap-2 pl-8">
                        <a href="https://www.facebook.com/Sakofah.Islam.Savings/" target="_blank"
                            rel="noopener noreferrer"
                            class="flex h-8 w-8 items-center justify-center rounded-full bg-white/10 text-white transition hover:bg-white hover:text-emerald-900"
                            aria-label="Facebook">
                            <i class="fa-brands fa-facebook text-sm"></i>
                        </a>
                        <a href="https://www.youtube.com/channel/UCffHrfpeGIw4dlLCs-IEGDg" target="_blank"
                            rel="noopener noreferrer"
                            class="flex h-8 w-8 items-center justify-center rounded-full bg-white/10 text-white transition hover:bg-white hover:text-emerald-900"
                            aria-label="YouTube">
                            <i class="fa-brands fa-youtube text-sm"></i>
                        </a>
                    </li>
                </ul>
            </div>

            <div>
                <h3 class="mb-4 inline-block border-b border-emerald-500/70 pb-1.5 text-lg font-bold text-white">
                    สำหรับเจ้าหน้าที่</h3>
                <p class="mb-4 text-sm text-emerald-50/85">
                    ระบบจัดการข้อมูลหลังบ้านสำหรับเจ้าหน้าที่สหกรณ์
                </p>
                <a href="{{ route('login') }}"
                    class="inline-flex min-h-10 items-center justify-center gap-2 rounded-md border border-white/80 px-4 py-2 text-sm font-bold text-white transition hover:bg-white hover:text-emerald-900">
                    <i class="fas fa-sign-in-alt"></i>
                    เข้าสู่ระบบ
                </a>
            </div>
        </div>
    </div>

    <div class="border-t border-white/10 bg-[#022c22] py-3">
        <div
            class="container mx-auto flex flex-col items-center justify-between px-6 text-sm text-emerald-100/80 md:flex-row">
            <p>&copy; {{ date('Y') }} สหกรณ์อิสลามษะกอฟะฮ จำกัด. สงวนลิขสิทธิ์.</p>
            <div class="mt-2 flex gap-4 md:mt-0">
                <a href="/privacy-policy" class="transition hover:text-white">นโยบายความเป็นส่วนตัว</a>
                <span>|</span>
                <a href="/terms-of-service" class="transition hover:text-white">ข้อตกลงการใช้งาน</a>
            </div>
        </div>
    </div>
</footer>
