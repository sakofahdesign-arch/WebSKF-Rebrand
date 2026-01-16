@extends('layouts.layout')
@section('title', 'เอกสารสำหรับสมาชิก')

@section('content')
<div class="bg-gray-50 min-h-screen text-gray-800 font-sans" data-theme="light" x-data="{ loaded: false }" x-init="() => { setTimeout(() => loaded = true, 50) }">

    <div class="relative bg-gradient-to-r from-green-700 to-indigo-600 text-white py-20 shadow-lg overflow-hidden">
        <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
        <div class="absolute top-0 right-0 w-96 h-96 bg-white rounded-full mix-blend-overlay filter blur-3xl opacity-20 -mr-20 -mt-20"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-indigo-300 rounded-full mix-blend-overlay filter blur-3xl opacity-20 -ml-20 -mb-20"></div>
        
        <div class="container mx-auto px-4 text-center relative z-10 transition-all duration-700 ease-out" 
             :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-5'">
            <h1 class="text-4xl md:text-5xl font-extrabold mb-4 drop-shadow-md">เอกสารสำหรับสมาชิก</h1>
            <p class="text-lg md:text-xl font-light max-w-2xl mx-auto opacity-95">
                รวมแบบฟอร์มและเอกสารสำคัญต่างๆ เพื่ออำนวยความสะดวกในการทำธุรกรรมกับสหกรณ์
            </p>
        </div>
    </div>

    <div class="container mx-auto px-4 py-16 max-w-7xl relative z-20 -mt-10">

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ([
                ['name' => 'ใบคำขอสมัครสมาชิก', 'path' => 'file/form/ใบคำขอสมัครสมาชิก INFORM 68-001.pdf'],
                ['name' => 'แบบฟอร์มคำขอรับสวัสดิการ', 'path' => 'file/form/คำขอรับสวัสดิการสมาชิก.pdf'],
                ['name' => 'แบบฟอร์มคำร้องทั่วไป', 'path' => 'file/form/แบบฟอร์มคำร้องทั่วไป.pdf'],
                ['name' => 'แบบฟอร์มคำขอรับสวัสดิการเสียชีวิต', 'path' => 'file/form/คำรับสวัสดิการกรณีเสียชีวิต.pdf'],
                ['name' => 'แบบฟอร์มคำขอลาออกสมาชิกเสียชีวิต', 'path' => 'file/form/แบบฟอร์มคำขอลาออกสมาชิกเสียชีวิต.pdf'],
                ['name' => 'แบบฟอร์มยินยอมหักผ่านบัญชี', 'path' => 'file/form/แบบฟอร์มคำขอชำระผ่านการหัก.pdf'],
                ['name' => 'แบบฟอร์มคำขอลาออกสมาชิก', 'path' => 'file/form/คำขอลาออกสมาชิก.pdf'],
                ['name' => 'ใบสมัครเข้าร่วมโครงการ', 'path' => 'file/form/ใบสมัครเข้าร่วมโครงการ.pdf'],
                ['name' => 'Check list สินเชื่อฮาลาล', 'path' => 'file/form/CHECK LIST.pdf'],
                ['name' => 'LY-SH-003-69 แบบคำขอไถ่ถอนจากจำนอง', 'path' => 'file/form/LY-SH-003-69 แบบคำขอไถ่ถอนจากจำนอง.pdf'],
                ['name' => 'LY-SH-002-69 แบบคำขออนุมัติใช้หลักทรัพย์ระหว่างจำนอง', 'path' => 'file/form/LY-SH-002-69 แบบคำขออนุมัติใช้หลักทรัพย์ระหว่างจำนอง.pdf'],
                ['name' => 'LY-SH-001-69 แบบคำขอปลอด หรือ เปลี่ยนแปลงหลักทรัพย์', 'path' => 'file/form/LY-SH-001-69 แบบคำขอปลอด หรือ เปลี่ยนแปลงหลักทรัพย์.pdf'],
            ] as $index => $file)
                
                <a href="{{ url($file['path']) }}" target="_blank" rel="noopener noreferrer" 
                   class="group h-full block transform transition-all duration-300 hover:-translate-y-2">
                    
                    <div class="card bg-white shadow-lg border border-gray-100 h-full hover:shadow-2xl transition-shadow duration-300 opacity-0 translate-y-10"
                         :class="loaded ? '!opacity-100 !translate-y-0' : ''"
                         style="transition-delay: {{ $index * 50 + 200 }}ms">
                        
                        <div class="card-body p-6 items-center text-center">
                            
                            <div class="w-16 h-16 rounded-2xl bg-red-50 text-red-500 flex items-center justify-center mb-4 shadow-sm group-hover:bg-red-100 group-hover:scale-110 transition-all duration-300">
                                <i class="fas fa-file-pdf text-3xl"></i>
                            </div>

                            <h3 class="card-title text-lg font-bold text-gray-800 group-hover:text-blue-600 transition-colors mb-2 min-h-[3.5rem] flex items-center justify-center">
                                {{ $file['name'] }}
                            </h3>

                            <div class="w-12 h-1 bg-gray-100 rounded-full my-2 group-hover:bg-blue-200 transition-colors"></div>

                            <div class="mt-auto pt-2">
                                <span class="text-sm font-semibold text-gray-400 group-hover:text-blue-500 flex items-center gap-2 transition-colors">
                                    <i class="fas fa-download"></i> ดาวน์โหลดเอกสาร
                                </span>
                            </div>
                        </div>
                    </div>
                </a>

            @endforeach
        </div>
    </div>
</div>
@endsection