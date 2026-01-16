@extends('layouts.layout')

@section('title', 'นโยบายความเป็นส่วนตัว')

@section('content')
<div class="bg-gray-50 min-h-screen py-12">
    <div class="container mx-auto max-w-4xl px-4">
        
        <div class="card bg-white shadow-xl border border-gray-100 overflow-hidden">
            <div class="h-2 bg-gradient-to-r from-emerald-600 to-teal-500"></div>

            <div class="card-body p-8 md:p-12 text-gray-700 leading-relaxed">
                
                <div class="text-center mb-10">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-emerald-100 text-emerald-600 mb-4">
                        <i class="fas fa-user-shield text-3xl"></i>
                    </div>
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-2">นโยบายความเป็นส่วนตัว</h1>
                    <p class="text-gray-500">Privacy Policy</p>
                </div>

                <div class="prose max-w-none text-gray-600">
                    <p class="mb-6">
                        <strong class="text-emerald-700">สหกรณ์อิสลามษะกอฟะฮ จำกัด</strong> ("เรา", "สหกรณ์", "เว็บไซต์") ให้ความสำคัญกับความเป็นส่วนตัวและการคุ้มครองข้อมูลส่วนบุคคลของสมาชิกและผู้ใช้งานเว็บไซต์ของเราอย่างสูงสุด นโยบายฉบับนี้จัดทำขึ้นเพื่อชี้แจงถึงวิธีการที่เรารวบรวม ใช้ เก็บรักษา และเปิดเผยข้อมูลส่วนบุคคล รวมถึงสิทธิของท่านตามกฎหมาย
                    </p>
                </div>

                <div class="divider my-6"></div>

                <div class="space-y-8">
                    
                    <section>
                        <h2 class="text-xl font-bold text-gray-800 mb-3 flex items-center gap-3">
                            <span class="flex-shrink-0 w-8 h-8 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-sm font-bold">1</span>
                            ข้อมูลที่เรารวบรวม
                        </h2>
                        <p class="mb-2 pl-11">เรารวบรวมข้อมูลจากผู้ใช้งานโดยตรง และโดยอัตโนมัติผ่านการใช้งานเว็บไซต์ ซึ่งรวมถึง:</p>
                        <ul class="list-disc list-outside ml-16 space-y-1 text-gray-600">
                            <li><strong class="text-gray-800">ข้อมูลที่ท่านให้กับเราโดยสมัครใจ:</strong> ชื่อ, อีเมล, เบอร์โทรศัพท์, ที่อยู่, ข้อมูลบัญชีสมาชิก</li>
                            <li><strong class="text-gray-800">ข้อมูลที่ระบบเก็บโดยอัตโนมัติ:</strong> IP, ประเภทเบราว์เซอร์, คุกกี้, Google Analytics</li>
                        </ul>
                    </section>

                    <section>
                        <h2 class="text-xl font-bold text-gray-800 mb-3 flex items-center gap-3">
                            <span class="flex-shrink-0 w-8 h-8 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-sm font-bold">2</span>
                            วัตถุประสงค์ของการใช้ข้อมูล
                        </h2>
                        <ul class="list-disc list-outside ml-16 space-y-1 text-gray-600">
                            <li>ดำเนินการตามคำขอของท่าน</li>
                            <li>ให้บริการของสหกรณ์</li>
                            <li>วิเคราะห์และปรับปรุงเว็บไซต์</li>
                            <li>ส่งข่าวสาร/กิจกรรม (เมื่อได้รับความยินยอม)</li>
                            <li>ปฏิบัติตามกฎหมาย</li>
                        </ul>
                    </section>

                    <section>
                        <h2 class="text-xl font-bold text-gray-800 mb-3 flex items-center gap-3">
                            <span class="flex-shrink-0 w-8 h-8 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-sm font-bold">3</span>
                            คุกกี้และเทคโนโลยีติดตาม
                        </h2>
                        <p class="pl-11 text-gray-600">เราใช้คุกกี้เพื่อปรับปรุงประสบการณ์ผู้ใช้งาน เช่น คุกกี้พื้นฐาน คุกกี้วิเคราะห์ (Google Analytics) และคุกกี้การตลาด (ถ้ามี) ท่านสามารถเลือกยอมรับหรือปฏิเสธได้ผ่านป็อปอัปการยินยอม หรือการตั้งค่าเบราว์เซอร์</p>
                    </section>

                    <section>
                        <h2 class="text-xl font-bold text-gray-800 mb-3 flex items-center gap-3">
                            <span class="flex-shrink-0 w-8 h-8 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-sm font-bold">4</span>
                            การเก็บรักษาข้อมูล
                        </h2>
                        <p class="pl-11 text-gray-600">เราจะเก็บรักษาข้อมูลตามวัตถุประสงค์หรือตามกฎหมายกำหนด และจะลบ/ทำลายข้อมูลเมื่อหมดวาระ</p>
                    </section>

                    <section>
                        <h2 class="text-xl font-bold text-gray-800 mb-3 flex items-center gap-3">
                            <span class="flex-shrink-0 w-8 h-8 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-sm font-bold">5</span>
                            การเปิดเผยข้อมูลแก่บุคคลภายนอก
                        </h2>
                        <ul class="list-disc list-outside ml-16 space-y-1 text-gray-600">
                            <li>ได้รับความยินยอม</li>
                            <li>จำเป็นตามกฎหมาย</li>
                            <li>เพื่อให้บริการ (โฮสติ้ง, Google Analytics เป็นต้น)</li>
                        </ul>
                    </section>

                    <section>
                        <h2 class="text-xl font-bold text-gray-800 mb-3 flex items-center gap-3">
                            <span class="flex-shrink-0 w-8 h-8 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-sm font-bold">6</span>
                            สิทธิของเจ้าของข้อมูล
                        </h2>
                        <ul class="list-disc list-outside ml-16 space-y-1 text-gray-600">
                            <li>ขอเข้าถึง/แก้ไข/ลบข้อมูล</li>
                            <li>ถอนความยินยอม</li>
                            <li>คัดค้านหรือโอนข้อมูล</li>
                        </ul>
                    </section>

                    <section>
                        <h2 class="text-xl font-bold text-gray-800 mb-3 flex items-center gap-3">
                            <span class="flex-shrink-0 w-8 h-8 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-sm font-bold">7</span>
                            การรักษาความปลอดภัยของข้อมูล
                        </h2>
                        <p class="pl-11 text-gray-600">เราใช้การเข้ารหัส SSL, การควบคุมการเข้าถึง และมาตรการทางเทคนิคอื่น ๆ เพื่อป้องกันการเข้าถึงโดยไม่ได้รับอนุญาต</p>
                    </section>

                    <section>
                        <h2 class="text-xl font-bold text-gray-800 mb-3 flex items-center gap-3">
                            <span class="flex-shrink-0 w-8 h-8 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-sm font-bold">8</span>
                            ลิงก์ไปยังเว็บไซต์ภายนอก
                        </h2>
                        <p class="pl-11 text-gray-600">เว็บไซต์ของเราอาจมีลิงก์ภายนอก ซึ่งไม่อยู่ภายใต้ความควบคุมของเรา โปรดอ่านนโยบายของเว็บไซต์เหล่านั้นแยกต่างหาก</p>
                    </section>

                    <section>
                        <h2 class="text-xl font-bold text-gray-800 mb-3 flex items-center gap-3">
                            <span class="flex-shrink-0 w-8 h-8 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-sm font-bold">9</span>
                            การเปลี่ยนแปลงนโยบาย
                        </h2>
                        <p class="pl-11 text-gray-600">เราอาจแก้ไขนโยบายนี้เป็นระยะ โดยไม่จำเป็นต้องแจ้งให้ทราบล่วงหน้า</p>
                    </section>

                    <section>
                        <h2 class="text-xl font-bold text-gray-800 mb-3 flex items-center gap-3">
                            <span class="flex-shrink-0 w-8 h-8 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-sm font-bold">10</span>
                            ช่องทางติดต่อ
                        </h2>
                        <div class="ml-11 bg-emerald-50/80 border border-emerald-100 p-6 rounded-xl">
                            <p class="mb-4 text-emerald-800 font-medium">หากท่านมีข้อสงสัยเกี่ยวกับนโยบายความเป็นส่วนตัว กรุณาติดต่อ:</p>
                            
                            <div class="space-y-2">
                                <p class="font-bold text-gray-800 text-lg">สหกรณ์อิสลามษะกอฟะฮ จำกัด</p>
                                <p class="flex items-start gap-3 text-gray-600">
                                    <i class="fas fa-map-marker-alt mt-1 text-emerald-600"></i>
                                    <span>เลขที่ 291 หมู่ที่ 1 ตำบลคลองยาง อำเภอเกาะลันตา จังหวัดกระบี่ 81120</span>
                                </p>
                                <p class="flex items-center gap-3 text-gray-600">
                                    <i class="fas fa-phone-alt text-emerald-600"></i>
                                    <span>075-652-525</span>
                                </p>
                                <p class="flex items-center gap-3 text-gray-600">
                                    <i class="fas fa-globe text-emerald-600"></i>
                                    <a href="https://www.sakofahislamic.com/" target="_blank" class="text-emerald-600 hover:text-emerald-800 hover:underline transition-colors">
                                        https://www.sakofahislamic.com/
                                    </a>
                                </p>
                            </div>
                        </div>
                    </section>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection