@extends('layouts.layout') {{-- Use the main layout --}}

@section('title', 'เอกสารสำหรับสมาชิก') {{-- Page title --}}

@section('content')
    <div class="container mx-auto px-4 py-12">
        {{-- Main Card Container for the entire page content --}}
        <div class="bg-white rounded-xl shadow-2xl overflow-hidden border-t-8 border-green-600"> {{-- Increased shadow and border-t --}}
            {{-- Card Header --}}
            <div class="bg-green-600 text-white text-center py-6 md:py-8 rounded-t-xl"> {{-- Increased padding, rounded-t-xl --}}
                <h2 class="text-4xl md:text-5xl font-extrabold mb-2">เอกสารสำหรับสมาชิก</h2>
                <p class="text-lg md:text-xl font-light">Document Center for Members</p>
            </div>

            {{-- Card Body --}}
            <div class="p-6 md:p-10"> {{-- Increased padding --}}
                <p class="text-xl text-gray-700 text-center mb-10 max-w-4xl mx-auto leading-relaxed">
                    ดาวน์โหลดแบบฟอร์มและเอกสารสำคัญต่างๆ ที่จำเป็นสำหรับการทำธุรกรรมกับสหกรณ์
                    เพื่อความสะดวกและรวดเร็วในการบริการ
                </p>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8"> {{-- Adjusted gap and added lg:grid-cols-3 --}}
                    @foreach ([
                        ['name' => 'ใบคำขอสมัครสมาชิก', 'path' => 'file/form/ใบคำขอสมัครสมาชิก INFORM 68-001.pdf'],
                        ['name' => 'แบบฟอร์มคำขอรับสวัสดิการ', 'path' => 'file/form/คำขอรับสวัสดิการสมาชิก.pdf'],
                        ['name' => 'แบบฟอร์มคำร้องทั่วไป', 'path' => 'file/form/แบบฟอร์มคำร้องทั่วไป.pdf'],
                        ['name' => 'แบบฟอร์มคำขอรับสวัสดิการเสียชีวิต', 'path' => 'file/form/คำรับสวัสดิการกรณีเสียชีวิต.pdf'],
                        ['name' => 'แบบฟอร์มคำขอลาออกสมาชิกเสียชีวิต', 'path' => 'file/form/แบบฟอร์มคำขอลาออกสมาชิกเสียชีวิต.pdf'],
                        ['name' => 'แบบฟอร์มยินยอมหักผ่านบัญชี', 'path' => 'file/form/แบบฟอร์มคำขอชำระผ่านการหัก.pdf'],
                        ['name' => 'แบบฟอร์มคำขอลาออกสมาชิก', 'path' => 'file/form/คำขอลาออกสมาชิก.pdf'],
                        ['name' => 'ใบสมัครเข้าร่วมโครงการ', 'path' => 'file/form/ใบสมัครเข้าร่วมโครงการ.pdf'],
                        ['name' => 'Check list สินเชื่อฮาลาล', 'path' => 'file/form/CHECK LIST.pdf']
                    ] as $file)
                        <div class="col-span-1">
                            <div class="bg-blue-50 rounded-lg shadow-md h-full flex items-center justify-center
                                        transform transition-all duration-300 hover:scale-105 hover:shadow-xl hover:bg-blue-100"> {{-- Enhanced hover effects --}}
                                <a href="{{ url($file['path']) }}" target="_blank" rel="noopener noreferrer"
                                   class="flex flex-col items-center justify-center w-full p-6 md:p-8 text-center"> {{-- Centered content vertically and horizontally --}}
                                    {{-- Larger, more prominent icon --}}
                                    <svg class="h-16 w-16 text-blue-600 mb-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    
                                    <span class="text-xl md:text-2xl font-bold text-blue-800 leading-tight mb-2">{{ $file['name'] }}</span> {{-- Larger font, bold --}}
                                    <p class="text-sm text-gray-600">คลิกเพื่อดาวน์โหลด (PDF)</p> {{-- Added descriptive text --}}
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
