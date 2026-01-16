@extends('layouts.layout')
@section('title', 'สวัสดิการเสียชีวิต')

@section('content')
<div class="bg-gray-50 min-h-screen text-gray-800 font-sans" data-theme="light" x-data="{ loaded: false }" x-init="() => { setTimeout(() => loaded = true, 50) }">

    <div class="container mx-auto px-4 py-16 max-w-5xl">

        <div class="text-center mb-12 transition-all duration-700 ease-out"
             :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-5'">
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-6">สวัสดิการเสียชีวิต</h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                สหกรณ์ออมทรัพย์ษะกอฟะฮ จำกัด มอบสวัสดิการเพื่อแบ่งเบาภาระและเป็นขวัญกำลังใจแก่ครอบครัวสมาชิก
            </p>
        </div>

        <div class="card bg-white shadow-xl border border-gray-100 overflow-hidden mb-12 transition-all duration-700 delay-100"
             :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'">

            <div class="h-2 bg-gradient-to-r from-gray-400 to-slate-500 w-full"></div>

            <div class="card-body p-8 lg:p-12">

                <h2 class="text-2xl font-bold text-gray-800 mb-10 flex items-center justify-center md:justify-start gap-3">
                    <div class="w-10 h-10 rounded-lg bg-gray-100 flex items-center justify-center text-gray-600">
                        <i class="fas fa-praying-hands"></i>
                    </div>
                    รายละเอียดการรับสวัสดิการ
                </h2>

                <div class="flex flex-col md:flex-row items-center gap-12 mb-10">

                    <div class="w-full md:w-1/2 flex flex-col justify-center space-y-8">

                        <div class="bg-gray-50 p-6 rounded-3xl border border-gray-100 relative overflow-hidden">
                            <p class="text-gray-700 text-lg mb-2 font-medium relative z-10">เงินช่วยเหลือค่าจัดการศพ</p>
                            <div class="text-3xl font-extrabold text-slate-700 mb-2 relative z-10">
                                10,000 - 20,000 <span class="text-xl text-gray-600 font-medium">บาท</span>
                            </div>
                            <p class="text-sm text-gray-500 relative z-10">*ขึ้นอยู่กับระดับอายุของสมาชิก</p>
                        </div>

                        <div class="flex items-start gap-4 px-2">
                            <div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-600 shrink-0 mt-1">
                                <i class="fas fa-hand-holding-usd"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-800 text-lg">การคืนเงินสะสม</h4>
                                <p class="text-gray-600 text-sm leading-relaxed">
                                    เงินฝากและเงินสมทบทั้งหมด จะถูกส่งคืนให้แก่ทายาทหรือผู้รับผลประโยชน์ที่ระบุไว้
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="w-full md:w-1/2 flex justify-center">
                        <div class="relative group w-full max-w-sm">
                            <div class="absolute -inset-2 bg-gradient-to-r from-gray-200 to-slate-300 rounded-2xl blur opacity-40 group-hover:opacity-60 transition duration-300"></div>
                            <img src="{{ asset('images/welfare/สวัสดิการเสียชีวิต.jpg') }}"
                                 alt="สวัสดิการเสียชีวิต"
                                 class="relative rounded-xl shadow-lg w-full h-auto object-cover border-4 border-white transform transition duration-500 group-hover:scale-[1.01] grayscale hover:grayscale-0">
                        </div>
                    </div>
                </div>

                <div class="divider my-8"></div>

                <div class="mb-10">
                    <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                        <i class="fas fa-file-contract text-gray-400"></i> เอกสารที่ใช้ประกอบ
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="alert bg-white border border-gray-200 shadow-sm flex justify-start hover:border-slate-300 transition-colors">
                            <div class="p-1 bg-green-100 rounded-full text-green-600"><i class="fas fa-check text-xs"></i></div>
                            <span class="font-medium text-gray-700">ใบมรณบัตร</span>
                        </div>
                        <div class="alert bg-white border border-gray-200 shadow-sm flex justify-start hover:border-slate-300 transition-colors">
                            <div class="p-1 bg-green-100 rounded-full text-green-600"><i class="fas fa-check text-xs"></i></div>
                            <span class="font-medium text-gray-700">บัตรประชาชน (ผู้เสียชีวิต)</span>
                        </div>
                        <div class="alert bg-white border border-gray-200 shadow-sm flex justify-start md:col-span-2 hover:border-slate-300 transition-colors">
                            <div class="p-1 bg-green-100 rounded-full text-green-600"><i class="fas fa-check text-xs"></i></div>
                            <span class="font-medium text-gray-700">บัตรประชาชน (ทายาทผู้รับผลประโยชน์)</span>
                        </div>
                    </div>
                </div>

                <div class="bg-yellow-50 rounded-2xl p-6 border border-yellow-100">
                    <h3 class="text-lg font-bold text-yellow-800 mb-4 flex items-center gap-2">
                        <i class="fas fa-exclamation-circle"></i> เงื่อนไขการรับสวัสดิการ
                    </h3>
                    <ul class="space-y-3 text-sm text-yellow-900">
                        <li class="flex items-start gap-2">
                            <i class="fas fa-circle text-[6px] mt-2 text-yellow-500"></i>
                            ต้องเป็นสมาชิกสหกรณ์และกองทุนสวัสดิการ (ตะกาฟุล)
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fas fa-circle text-[6px] mt-2 text-yellow-500"></i>
                            ไม่ขาดการชำระทุนเกิน <span class="font-bold text-red-600 mx-1">3 เดือน</span> ย้อนหลัง
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fas fa-circle text-[6px] mt-2 text-yellow-500"></i>
                            มีเงินชำระทุนสะสมไม่น้อยกว่า <span class="font-bold text-blue-600 mx-1">1,000 บาท</span>
                        </li>
                    </ul>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection
