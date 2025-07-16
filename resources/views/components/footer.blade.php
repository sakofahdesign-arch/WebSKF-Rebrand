<footer class="bg-green-800 text-white p-8 mt-auto">
    <div class="container mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 md:gap-12 text-center md:text-left">
        <div>
            <h3 class="text-xl font-bold mb-4 text-green-200"> สหกรณ์อิสลามษะกอฟะฮ จำกัด</h3>
            <p class="text-sm text-green-100 leading-relaxed">เรามุ่งมั่นที่จะเป็นองค์กรทางการเงินที่มั่นคงและยั่งยืน เพื่อยกระดับคุณภาพชีวิตของสมาชิกภายใต้หลักการอิสลาม</p>
            <div class="mt-4 flex justify-center md:justify-start space-x-4">
                <a href="https://www.facebook.com/Sakofah.Islam.Savings/" class="text-green-300 hover:text-white transition duration-300" aria-label="Facebook">
                    <i class="fab fa-facebook-f fa-lg"></i>
                </a>
                <a href="#" class="text-green-300 hover:text-white transition duration-300" aria-label="Line">
                    <i class="fab fa-line fa-lg"></i>
                </a>
            </div>
        </div>
        <div>
            <h3 class="text-xl font-bold mb-4 text-green-200">บริการ</h3>
            <ul class="space-y-2 text-sm">
                <li><a href="/register" class="text-green-100 hover:text-white transition duration-300">สมัครสมาชิก</a></li>
                <li><a href="/deposit" class="text-green-100 hover:text-white transition duration-300">บริการเงินฝาก</a></li>
                <li><a href="/credit_service" class="text-green-100 hover:text-white transition duration-300">บริการสินเชื่อ</a></li>
                <li><a href="/document" class="text-green-100 hover:text-white transition duration-300">ดาวน์โหลดเอกสาร</a></li>
            </ul>
        </div>
        <div>
            <h3 class="text-xl font-bold mb-4 text-green-200">ติดต่อเรา</h3>
            <ul class="space-y-3 text-sm">
                <li class="flex items-start justify-center md:justify-start">
                    <i class="fas fa-map-marker-alt text-green-300 mr-3 mt-1 flex-shrink-0"></i>
                    <span>เลขที่ 291 หมู่ที่ 1 ตำบลคลองยาง อำเภอเกาะลันตา จังหวัดกระบี่ 81120</span>
                </li>
                <li class="flex items-center justify-center md:justify-start">
                    <i class="fas fa-phone-alt text-green-300 mr-3 flex-shrink-0"></i>
                    <span>075-652-525</span>
                </li>
                {{-- <li class="flex items-center justify-center md:justify-start">
                    <i class="fas fa-envelope text-green-300 mr-3 flex-shrink-0"></i>
                    <span>contact@sakofah.co.th</span>
                </li> --}}
            </ul>
        </div>

        <div>
            <h3 class="text-xl font-bold mb-4 text-green-200">สำหรับเจ้าหน้าที่</h3>
            <p class="text-sm text-green-100 mb-4">
                เข้าสู่ระบบเพื่อจัดการข้อมูลหลังบ้านของสหกรณ์
            </p>
            <a href="/login" class="inline-flex items-center justify-center bg-green-600 text-white hover:bg-green-700 font-bold py-2 px-4 rounded-lg text-sm shadow-md transition duration-300 w-full md:w-auto">
                <i class="fas fa-sign-in-alt mr-2"></i>
                เข้าสู่ระบบ
            </a>
        </div>
    </div>

    <div class="border-t border-green-700 mt-8 pt-6 text-center text-sm text-green-200">
        <p>&copy; {{ date('Y') }} สหกรณ์อิสลามษะกอฟะฮ จำกัด. สงวนลิขสิทธิ์.</p>
    </div>
</footer>
