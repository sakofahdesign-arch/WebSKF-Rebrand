@extends('layouts.layout')

@section('title', 'ข้อตกลงการใช้งาน')

@section('content')
<div class="bg-gray-50 min-h-screen py-12">
    <div class="container mx-auto max-w-4xl px-4">
        
        <div class="card bg-white shadow-xl border border-gray-100 overflow-hidden">
            <div class="h-2 bg-gradient-to-r from-emerald-600 to-teal-500"></div>

            <div class="card-body p-8 md:p-12 text-gray-700 leading-relaxed">
                
                <div class="text-center mb-10">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-emerald-100 text-emerald-600 mb-4">
                        <i class="fas fa-file-contract text-3xl"></i>
                    </div>
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-2">ข้อตกลงการใช้งาน</h1>
                    <p class="text-gray-500">Terms of Use</p>
                </div>

                <div class="prose max-w-none text-gray-600">
                    <p class="mb-6">
                        ยินดีต้อนรับสู่เว็บไซต์ของ <strong class="text-emerald-700">สหกรณ์อิสลามษะกอฟะฮ จำกัด</strong> ("เว็บไซต์") การเข้าถึงและใช้งานเว็บไซต์นี้แสดงว่าท่านยอมรับและตกลงที่จะปฏิบัติตามข้อตกลงและเงื่อนไขการใช้งานที่ระบุไว้ด้านล่างนี้ หากท่านไม่ยอมรับเงื่อนไขเหล่านี้ กรุณาระงับการใช้งานเว็บไซต์
                    </p>
                </div>

                <div class="divider my-6"></div>

                <div class="space-y-8">
                    
                    <section>
                        <h2 class="text-xl font-bold text-gray-800 mb-3 flex items-center gap-3">
                            <span class="flex-shrink-0 w-8 h-8 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-sm font-bold">1</span>
                            การยอมรับข้อตกลง
                        </h2>
                        <p class="pl-11 text-gray-600">
                            การใช้งานเว็บไซต์นี้ถือว่าท่านได้อ่าน ทำความเข้าใจ และยอมรับข้อตกลงการใช้งานนี้ รวมถึงนโยบายความเป็นส่วนตัวของเรา สหกรณ์ฯ ขอสงวนสิทธิ์ในการแก้ไข เปลี่ยนแปลง หรือปรับปรุงข้อตกลงนี้ได้ตลอดเวลาโดยไม่ต้องแจ้งให้ทราบล่วงหน้า
                        </p>
                    </section>

                    <section>
                        <h2 class="text-xl font-bold text-gray-800 mb-3 flex items-center gap-3">
                            <span class="flex-shrink-0 w-8 h-8 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-sm font-bold">2</span>
                            สิทธิในทรัพย์สินทางปัญญา
                        </h2>
                        <p class="pl-11 text-gray-600">
                            เนื้อหา รูปภาพ โลโก้ เครื่องหมายการค้า และข้อมูลทั้งหมดที่ปรากฏบนเว็บไซต์นี้ เป็นทรัพย์สินของสหกรณ์อิสลามษะกอฟะฮ จำกัด หรือผู้อนุญาตให้ใช้สิทธิ ห้ามมิให้ผู้ใดคัดลอก ดัดแปลง ทำซ้ำ หรือนำไปใช้เพื่อการพาณิชย์โดยไม่ได้รับอนุญาตเป็นลายลักษณ์อักษร
                        </p>
                    </section>

                    <section>
                        <h2 class="text-xl font-bold text-gray-800 mb-3 flex items-center gap-3">
                            <span class="flex-shrink-0 w-8 h-8 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-sm font-bold">3</span>
                            การใช้งานเว็บไซต์
                        </h2>
                        <p class="mb-2 pl-11 text-gray-600">ท่านตกลงที่จะใช้งานเว็บไซต์นี้เพื่อวัตถุประสงค์ที่ถูกต้องตามกฎหมาย และจะไม่กระทำการใดๆ ดังต่อไปนี้:</p>
                        <ul class="list-disc list-outside ml-16 space-y-1 text-gray-600">
                            <li>การกระทำที่ละเมิดสิทธิของผู้อื่น หรือขัดต่อกฎหมาย</li>
                            <li>การส่งต่อไวรัส มัลแวร์ หรือโค้ดที่เป็นอันตรายต่อระบบ</li>
                            <li>การพยายามเข้าถึงข้อมูลส่วนบุคคลของผู้อื่นโดยไม่ได้รับอนุญาต</li>
                            <li>การรบกวนการทำงานของเว็บไซต์ หรือเซิร์ฟเวอร์</li>
                        </ul>
                    </section>

                    <section>
                        <h2 class="text-xl font-bold text-gray-800 mb-3 flex items-center gap-3">
                            <span class="flex-shrink-0 w-8 h-8 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-sm font-bold">4</span>
                            บัญชีสมาชิกและความปลอดภัย
                        </h2>
                        <p class="pl-11 text-gray-600">
                            หากเว็บไซต์มีส่วนที่ต้องสมัครสมาชิก ท่านมีหน้าที่รับผิดชอบในการรักษาความลับของชื่อบัญชีและรหัสผ่านของท่าน และต้องรับผิดชอบต่อกิจกรรมทั้งหมดที่เกิดขึ้นภายใต้บัญชีของท่าน หากพบการใช้งานที่ไม่ได้รับอนุญาต กรุณาแจ้งให้เราทราบทันที
                        </p>
                    </section>

                    <section>
                        <h2 class="text-xl font-bold text-gray-800 mb-3 flex items-center gap-3">
                            <span class="flex-shrink-0 w-8 h-8 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-sm font-bold">5</span>
                            การจำกัดความรับผิด
                        </h2>
                        <p class="pl-11 text-gray-600">
                            สหกรณ์ฯ พยายามให้ข้อมูลบนเว็บไซต์มีความถูกต้องและเป็นปัจจุบัน แต่ไม่รับประกันความสมบูรณ์ หรือความถูกต้องของข้อมูล การใช้งานข้อมูลบนเว็บไซต์ถือเป็นความเสี่ยงของท่านเอง สหกรณ์ฯ จะไม่รับผิดชอบต่อความเสียหายใดๆ ที่เกิดจากการใช้งาน หรือการไม่สามารถใช้งานเว็บไซต์นี้ได้
                        </p>
                    </section>

                    <section>
                        <h2 class="text-xl font-bold text-gray-800 mb-3 flex items-center gap-3">
                            <span class="flex-shrink-0 w-8 h-8 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-sm font-bold">6</span>
                            ลิงก์ไปยังเว็บไซต์ภายนอก
                        </h2>
                        <p class="pl-11 text-gray-600">
                            เว็บไซต์นี้อาจมีการเชื่อมโยงไปยังเว็บไซต์ของบุคคลที่สาม ซึ่งเราไม่ได้เป็นผู้ควบคุมหรือรับรองเนื้อหาของเว็บไซต์เหล่านั้น การเข้าชมเว็บไซต์ภายนอกถือเป็นดุลยพินิจของท่านเอง
                        </p>
                    </section>

                    <section>
                        <h2 class="text-xl font-bold text-gray-800 mb-3 flex items-center gap-3">
                            <span class="flex-shrink-0 w-8 h-8 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-sm font-bold">7</span>
                            กฎหมายที่ใช้บังคับ
                        </h2>
                        <p class="pl-11 text-gray-600">
                            ข้อตกลงการใช้งานนี้อยู่ภายใต้บังคับของกฎหมายราชอาณาจักรไทย ข้อพิพาทใดๆ ที่เกี่ยวข้องกับการใช้งานเว็บไซต์นี้ให้อยู่ในเขตอำนาจของศาลไทย
                        </p>
                    </section>

                    <section>
                        <h2 class="text-xl font-bold text-gray-800 mb-3 flex items-center gap-3">
                            <span class="flex-shrink-0 w-8 h-8 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-sm font-bold">8</span>
                            ช่องทางติดต่อ
                        </h2>
                        <div class="ml-11 bg-emerald-50/80 border border-emerald-100 p-6 rounded-xl">
                            <p class="mb-4 text-emerald-800 font-medium">หากท่านมีคำถามเกี่ยวกับข้อตกลงการใช้งาน กรุณาติดต่อ:</p>
                            
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