@extends('layouts.layout')
@section('title', 'สวัสดิการการแต่งงาน')

@section('content')
<div class="bg-gray-50 min-h-screen text-gray-800 font-sans" data-theme="light" x-data="{ loaded: false }" x-init="() => { setTimeout(() => loaded = true, 50) }">

    <div class="container mx-auto px-4 py-16 max-w-5xl">

        <div class="text-center mb-12 transition-all duration-700 ease-out" :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-5'">
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-6">สวัสดิการการแต่งงาน</h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                สหกรณ์ออมทรัพย์ษะกอฟะฮ จำกัด มอบสวัสดิการเพื่อร่วมยินดีกับสมาชิกในวันเริ่มต้นชีวิตคู่
            </p>
        </div>

        <div class="card bg-white shadow-xl border border-gray-100 overflow-hidden mb-12 transition-all duration-700 delay-100"
             :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'">

            <div class="h-2 bg-gradient-to-r from-rose-400 to-pink-500 w-full"></div>

            <div class="card-body p-8 lg:p-12">

                <h2 class="text-2xl font-bold text-gray-800 mb-10 flex items-center justify-center md:justify-start gap-3">
                    <div class="w-10 h-10 rounded-lg bg-rose-100 flex items-center justify-center text-rose-600">
                        <i class="fas fa-gift"></i>
                    </div>
                    การขอรับสวัสดิการและเอกสาร
                </h2>

                <div class="flex flex-col md:flex-row items-center gap-12 mb-10">

                    <div class="w-full md:w-1/2 flex flex-col justify-center space-y-8">

                        <div class="bg-rose-50 p-8 rounded-3xl border border-rose-100 text-center md:text-left">
                            <p class="text-gray-700 text-lg mb-2 font-medium">มอบเงินขวัญถุง</p>
                            <div class="text-4xl md:text-5xl font-extrabold text-rose-600">
                                1,000 - 2,000 <span class="text-xl text-gray-600 font-medium">บาท</span>
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
                                    <br><span class="text-sm text-gray-500">นับจากวันที่จดทะเบียนหรือวันทำพิธี</span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="w-full md:w-1/2 flex justify-center">
                        <div class="relative group w-full max-w-sm">
                            <div class="absolute -inset-2 bg-gradient-to-r from-rose-200 to-pink-200 rounded-2xl blur opacity-40 group-hover:opacity-60 transition duration-300"></div>
                            <img src="{{ asset('images/welfare/123456.jpg') }}"
                                 alt="คู่บ่าวสาว"
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
                        <div class="alert bg-white border border-gray-200 shadow-sm flex justify-start hover:border-rose-200 transition-colors">
                            <div class="p-1 bg-green-100 rounded-full text-green-600"><i class="fas fa-check text-xs"></i></div>
                            <span class="font-medium text-gray-700">ใบนะกะฮ์ หรือ ทะเบียนสมรส</span>
                        </div>
                        <div class="alert bg-white border border-gray-200 shadow-sm flex justify-start hover:border-rose-200 transition-colors">
                            <div class="p-1 bg-green-100 rounded-full text-green-600"><i class="fas fa-check text-xs"></i></div>
                            <span class="font-medium text-gray-700">สำเนาบัตรประชาชน</span>
                        </div>
                        <div class="alert bg-white border border-gray-200 shadow-sm flex justify-start md:col-span-2 hover:border-rose-200 transition-colors">
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
