<footer class="bg-green-900 text-white font-sans mt-auto">
    <div class="container mx-auto px-6 py-12">

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 text-left">

            <div class="flex flex-col items-start gap-4">

                <div class="bg-white p-2 rounded-lg">
                    <img src="{{ asset('images/sakofah-logo.png') }}" alt="Sakofah Logo"
                        class="h-12 w-auto object-contain">
                </div>

                <div>
                    <h3 class="font-bold text-lg mb-2">สหกรณ์อิสลามษะกอฟะฮ จำกัด</h3>
                    <p class="text-sm text-green-100 leading-relaxed">
                        เรามุ่งมั่นที่จะเป็นองค์กรทางการเงินที่มั่นคงและยั่งยืน
                        เพื่อยกระดับคุณภาพชีวิตของสมาชิกภายใต้หลักการอิสลาม
                    </p>
                </div>

                <div class="flex gap-3 mt-2">
                    <a href="https://www.facebook.com/Sakofah.Islam.Savings/" target="_blank"
                        class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-green-600 transition-colors text-white group">
                        <i class="fa-brands fa-facebook text-xl"></i>
                    </a>
                    <a href="https://line.me/R/ti/p/@sakofah" target="_blank"
                        class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-green-600 transition-colors text-white group">
                        <i class="fa-brands fa-line text-xl"></i>
                    </a>
                </div>
            </div>

            <div>
                <h3 class="font-bold text-xl mb-6 text-white border-b border-green-700 pb-2 inline-block">บริการสมาชิก
                </h3>
                <ul class="space-y-3 text-green-100">
                    <li><a href="{{ route('register') }}"
                            class="hover:text-white hover:translate-x-1 transition-transform inline-block"><i
                                class="fas fa-angle-right mr-2 text-xs"></i>สมัครสมาชิก</a></li>
                    <li><a href="{{ route('deposit') }}"
                            class="hover:text-white hover:translate-x-1 transition-transform inline-block"><i
                                class="fas fa-angle-right mr-2 text-xs"></i>บริการเงินฝาก</a></li>
                    <li><a href="{{ route('credit_service') }}"
                            class="hover:text-white hover:translate-x-1 transition-transform inline-block"><i
                                class="fas fa-angle-right mr-2 text-xs"></i>บริการสินเชื่อ</a></li>
                    <li><a href="{{ route('document') }}"
                            class="hover:text-white hover:translate-x-1 transition-transform inline-block"><i
                                class="fas fa-angle-right mr-2 text-xs"></i>ดาวน์โหลดเอกสาร</a></li>
                </ul>
            </div>

            <div>
                <h3 class="font-bold text-xl mb-6 text-white border-b border-green-700 pb-2 inline-block">ติดต่อเรา</h3>
                <ul class="space-y-4 text-green-100">
                    <li class="flex items-start gap-3">
                        <i class="fas fa-map-marker-alt text-green-400 mt-1 text-lg w-5 text-center"></i>
                        <span>เลขที่ 291 หมู่ที่ 1 ตำบลคลองยาง <br>อำเภอเกาะลันตา จังหวัดกระบี่ 81120</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <i class="fas fa-phone-alt text-green-400 text-lg w-5 text-center"></i>
                        <span class="text-lg font-semibold text-white">075-652-525</span>
                    </li>
                </ul>
            </div>

            <div>
                <h3 class="font-bold text-xl mb-6 text-white border-b border-green-700 pb-2 inline-block">
                    สำหรับเจ้าหน้าที่</h3>
                <p class="text-sm text-green-100 mb-4">
                    ระบบจัดการข้อมูลหลังบ้านสำหรับเจ้าหน้าที่สหกรณ์
                </p>
                <a href="{{ route('login') }}"
                    class="btn btn-outline border-white text-white hover:bg-white hover:text-green-900 w-full md:w-auto gap-2">
                    <i class="fas fa-sign-in-alt"></i>
                    เข้าสู่ระบบ
                </a>
            </div>

        </div>
    </div>

    <div class="bg-green-950 py-4 border-t border-green-800">
        <div
            class="container mx-auto px-6 flex flex-col md:flex-row justify-between items-center text-sm text-green-300">
            <p>&copy; {{ date('Y') }} สหกรณ์อิสลามษะกอฟะฮ จำกัด. สงวนลิขสิทธิ์.</p>
            <div class="flex gap-4 mt-2 md:mt-0">
                <a href="/privacy-policy" class="hover:text-white transition-colors">นโยบายความเป็นส่วนตัว</a>
                <span>|</span>
                <a href="/terms-of-service" class="hover:text-white transition-colors">ข้อตกลงการใช้งาน</a>
            </div>
        </div>
    </div>
</footer>
