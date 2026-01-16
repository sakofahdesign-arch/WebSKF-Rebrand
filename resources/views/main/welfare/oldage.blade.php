@extends('layouts.layout')
@section('title', 'สวัสดิการเงินสมทบยามชรา')

@section('content')
<div class="bg-gray-50 min-h-screen text-gray-800 font-sans" data-theme="light" x-data="{ loaded: false }" x-init="() => { setTimeout(() => loaded = true, 50) }">

    <div class="container mx-auto px-4 py-16 max-w-5xl">

        <div class="text-center mb-12 transition-all duration-700 ease-out"
             :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-5'">
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-6">สวัสดิการเงินสมทบยามชรา</h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                สหกรณ์ออมทรัพย์ษะกอฟะฮ จำกัด มอบหลักประกันชีวิตเพื่อดูแลสมาชิกในวัยเกษียณ ด้วยเงินสมทบที่มั่นคง
            </p>
        </div>

        <div class="card bg-white shadow-xl border border-gray-100 overflow-hidden mb-12 transition-all duration-700 delay-100"
             :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'">

            <div class="h-2 bg-gradient-to-r from-emerald-400 to-teal-500 w-full"></div>

            <div class="card-body p-8 lg:p-12">

                <h2 class="text-2xl font-bold text-gray-800 mb-10 flex items-center justify-center md:justify-start gap-3">
                    <div class="w-10 h-10 rounded-lg bg-emerald-100 flex items-center justify-center text-emerald-600">
                        <i class="fas fa-hand-holding-heart"></i>
                    </div>
                    เงื่อนไขและรายละเอียดสวัสดิการ
                </h2>

                <div class="flex flex-col md:flex-row items-start gap-12 mb-10">

                    <div class="w-full md:w-1/2 flex flex-col space-y-8">

                        <div class="bg-emerald-50 p-6 rounded-3xl border border-emerald-100">
                            <div class="flex items-center gap-3 mb-2">
                                <i class="fas fa-coins text-emerald-500 text-xl"></i>
                                <p class="text-gray-700 font-bold">เงินสมทบสะสม</p>
                            </div>
                            <div class="text-3xl font-extrabold text-emerald-700 mb-1">
                                100 - 200 <span class="text-lg text-gray-600 font-medium">บาท</span>
                            </div>
                            <p class="text-sm text-gray-500">สมทบให้ทุกครั้งที่สมาชิกฝากหุ้น (เดือนละ 1 ครั้ง)</p>
                        </div>

                        <div>
                            <h4 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                                <i class="fas fa-sort-amount-up text-emerald-500"></i> การจัดสรรเงินสมทบ
                            </h4>
                            <ul class="space-y-4">
                                <li class="flex items-center justify-between p-3 bg-gray-50 rounded-xl border border-gray-100">
                                    <span class="text-gray-600"><i class="fas fa-user-clock text-gray-400 mr-2"></i> อายุครบ <strong>65 ปี</strong></span>
                                    <span class="badge bg-emerald-100 text-emerald-700 border-none font-bold">รับ 30%</span>
                                </li>
                                <li class="flex items-center justify-between p-3 bg-gray-50 rounded-xl border border-gray-100">
                                    <span class="text-gray-600"><i class="fas fa-user-clock text-gray-400 mr-2"></i> อายุครบ <strong>70 ปี</strong></span>
                                    <span class="badge bg-emerald-100 text-emerald-700 border-none font-bold">รับ 50%</span>
                                </li>
                                <li class="flex items-center justify-between p-3 bg-gray-50 rounded-xl border border-gray-100">
                                    <span class="text-gray-600"><i class="fas fa-user-clock text-gray-400 mr-2"></i> อายุครบ <strong>75 ปี</strong></span>
                                    <span class="badge bg-emerald-100 text-emerald-700 border-none font-bold">รับ 70%</span>
                                </li>
                                <li class="text-sm text-gray-500 pl-2">
                                    *กรณีเสียชีวิต ทายาทรับเงินสมทบคงเหลือทั้งหมด
                                </li>
                            </ul>
                        </div>

                        <div class="flex items-center gap-4 px-2">
                            <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center text-blue-600 shrink-0">
                                <i class="fas fa-hourglass-half"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-800 text-sm">ระยะเวลายื่นเรื่อง</h4>
                                <p class="text-gray-600 text-sm">
                                    ภายใน <span class="font-bold text-blue-600">1 ปี</span> นับจากวันที่อายุครบเกณฑ์
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="w-full md:w-1/2 flex justify-center items-center h-full">
                        <div class="relative group w-full max-w-sm">
                            <div class="absolute -inset-2 bg-gradient-to-r from-emerald-200 to-teal-200 rounded-2xl blur opacity-40 group-hover:opacity-60 transition duration-300"></div>
                            <img src="{{ asset('images/welfare/ชรา1.jpg') }}"
                                 alt="สวัสดิการยามชรา"
                                 class="relative rounded-xl shadow-lg w-full h-auto object-cover border-4 border-white transform transition duration-500 group-hover:scale-[1.01]">
                        </div>
                    </div>
                </div>

                <div class="divider my-8"></div>

                <div>
                    <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                        <i class="fas fa-file-alt text-gray-400"></i> เอกสารที่ใช้ประกอบ
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="alert bg-white border border-gray-200 shadow-sm flex justify-start hover:border-emerald-200 transition-colors">
                            <div class="p-1 bg-green-100 rounded-full text-green-600"><i class="fas fa-check text-xs"></i></div>
                            <span class="font-medium text-gray-700">สำเนาบัตรประชาชน</span>
                        </div>
                        <div class="alert bg-white border border-gray-200 shadow-sm flex justify-start hover:border-emerald-200 transition-colors">
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
