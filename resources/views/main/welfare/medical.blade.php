@extends('layouts.layout')
@section('title', 'สวัสดิการช่วยเหลือค่ารักษาพยาบาล')

@section('content')
<div class="bg-gray-50 min-h-screen text-gray-800 font-sans" data-theme="light" x-data="{ loaded: false }" x-init="() => { setTimeout(() => loaded = true, 50) }">

    <div class="container mx-auto px-4 py-16 max-w-5xl">

        <div class="text-center mb-12 transition-all duration-700 ease-out"
             :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-5'">
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-6">สวัสดิการช่วยเหลือค่ารักษาพยาบาล</h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                สหกรณ์ออมทรัพย์ษะกอฟะฮ จำกัด มอบสวัสดิการเพื่อแบ่งเบาภาระและดูแลสุขภาพของสมาชิกในยามเจ็บป่วย
            </p>
        </div>

        <div class="card bg-white shadow-xl border border-gray-100 overflow-hidden mb-12 transition-all duration-700 delay-100"
             :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'">

            <div class="h-2 bg-gradient-to-r from-emerald-400 to-green-500 w-full"></div>

            <div class="card-body p-8 lg:p-12">

                <h2 class="text-2xl font-bold text-gray-800 mb-10 flex items-center justify-center md:justify-start gap-3">
                    <div class="w-10 h-10 rounded-lg bg-emerald-100 flex items-center justify-center text-emerald-600">
                        <i class="fas fa-stethoscope"></i>
                    </div>
                    เงื่อนไขและรายละเอียดสวัสดิการ
                </h2>

                <div class="flex flex-col md:flex-row items-center gap-12 mb-10">

                    <div class="w-full md:w-1/2 flex flex-col justify-center space-y-8">

                        <div class="bg-emerald-50 p-6 rounded-3xl border border-emerald-100 relative overflow-hidden">
                            <i class="fas fa-hospital-alt absolute -right-4 -bottom-4 text-8xl text-emerald-100 opacity-50 pointer-events-none"></i>

                            <p class="text-gray-700 text-lg mb-2 font-medium relative z-10">ค่ารักษาพยาบาล (ผู้ป่วยใน)</p>
                            <div class="text-4xl font-extrabold text-emerald-600 mb-2 relative z-10">
                                100 - 200 <span class="text-xl text-gray-600 font-medium">บาท/คืน</span>
                            </div>
                            <div class="badge badge-error gap-2 text-white border-none relative z-10">
                                <i class="fas fa-exclamation-circle"></i> ไม่เกิน 10 คืน/ปี
                            </div>
                        </div>

                        <div class="flex items-center justify-center md:justify-start gap-5 px-2">
                            <div class="w-14 h-14 rounded-full bg-blue-50 flex items-center justify-center text-blue-600 shrink-0">
                                <i class="fas fa-history text-2xl"></i>
                            </div>
                            <div class="text-left">
                                <h4 class="font-bold text-gray-800 text-lg">ระยะเวลายื่นเรื่อง</h4>
                                <p class="text-gray-600 text-base leading-relaxed">
                                    ต้องยื่นเอกสารภายใน <span class="font-bold text-blue-600 underline decoration-blue-300 decoration-2">90 วัน</span>
                                    <br><span class="text-sm text-gray-500">นับจากวันออกจากโรงพยาบาล</span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="w-full md:w-1/2 flex justify-center">
                        <div class="relative group w-full max-w-sm">
                            <div class="absolute -inset-2 bg-gradient-to-r from-emerald-200 to-green-200 rounded-2xl blur opacity-40 group-hover:opacity-60 transition duration-300"></div>
                            <img src="{{ asset('images/welfare/สวัสดิการช่วยเหลือค่ารักษาพยาบาล.jpg') }}"
                                 alt="การรักษาพยาบาล"
                                 class="relative rounded-xl shadow-lg w-full h-auto object-cover border-4 border-white transform transition duration-500 group-hover:scale-[1.01]">
                        </div>
                    </div>
                </div>

                <div class="divider my-8"></div>

                <div>
                    <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                        <i class="fas fa-file-medical-alt text-gray-400"></i> เอกสารที่ใช้ประกอบ
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="alert bg-white border border-gray-200 shadow-sm flex justify-start hover:border-emerald-200 transition-colors">
                            <div class="p-1 bg-green-100 rounded-full text-green-600"><i class="fas fa-check text-xs"></i></div>
                            <span class="font-medium text-gray-700">ใบรับรองแพทย์</span>
                        </div>
                        <div class="alert bg-white border border-gray-200 shadow-sm flex justify-start hover:border-emerald-200 transition-colors">
                            <div class="p-1 bg-green-100 rounded-full text-green-600"><i class="fas fa-check text-xs"></i></div>
                            <span class="font-medium text-gray-700">สำเนาบัตรประชาชนของสมาชิก</span>
                        </div>
                        <div class="alert bg-white border border-gray-200 shadow-sm flex justify-start md:col-span-2 hover:border-emerald-200 transition-colors">
                            <div class="p-1 bg-green-100 rounded-full text-green-600"><i class="fas fa-check text-xs"></i></div>
                            <span class="font-medium text-gray-700">สมุดบัญชีทุนเรือนหุ้น</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection
