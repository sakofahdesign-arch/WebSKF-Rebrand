@extends('layouts.layout') {{-- Use the main layout --}}

@section('title', 'รายงานกิจการ') {{-- Page title --}}

@section('content')
    <div class="container mx-auto px-4 py-12">
        <h1 class="text-4xl md:text-5xl font-extrabold text-center text-blue-700 mb-6">รายงานกิจการประจำปี</h1>
        <p class="text-lg md:text-xl text-gray-700 text-center mb-12 max-w-4xl mx-auto">
            เข้าถึงรายงานกิจการประจำปีของสหกรณ์ออมทรัพย์ษะกอฟะฮ จำกัด เพื่อความโปร่งใส ความเข้าใจ และการตรวจสอบได้
        </p>

        {{-- Main Card Container for the entire page content --}}
        <div class="bg-white rounded-lg shadow-xl overflow-hidden border-t-4 border-green-600">
            {{-- Card Header --}}
            <div class="bg-green-600 text-white text-center py-5 rounded-t-lg">
                <h2 class="text-3xl md:text-4xl font-extrabold mb-0">เอกสารรายงาน</h2>
            </div>

            {{-- Card Body --}}
            <div class="p-6 md:p-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ([
                        ["name" => "รายงานกิจการ 2557", "path" => "file/report/รายงานกิจการ_2557.pdf"],
                        ["name" => "รายงานกิจการ 2558", "path" => "file/report/รายงานกิจการ_2558.pdf"],
                        ["name" => "รายงานกิจการ 2559", "path" => "file/report/รายงานกิจการ_2559.pdf"],
                        ["name" => "รายงานกิจการ 2560", "path" => "file/report/รายงานกิจการ_2560.pdf"],
                        ["name" => "รายงานกิจการ 2561", "path" => "file/report/รายงานกิจการ_2561.pdf"],
                        ["name" => "รายงานกิจการ 2562", "path" => "file/report/รายงานกิจการ_2562.pdf"],
                        ["name" => "รายงานกิจการ 2563 (ฉบับสมบูรณ์)", "path" => "file/report/รายงานกิจการ_2563_(สมบูรณ์_online2).pdf"]
                    ] as $report)
                        <div class="col-span-1">
                            <div class="bg-white rounded-lg shadow-md h-full flex flex-col items-center justify-center p-6
                                        transition-all duration-300 hover:shadow-xl hover:-translate-y-1 border border-gray-200">
                                <a href="{{ url($report['path']) }}" target="_blank" rel="noopener noreferrer"
                                   class="flex flex-col items-center w-full text-center">
                                    {{-- Larger PDF Icon --}}
                                    <svg class="h-16 w-16 text-red-500 mb-4 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8l-6-6zM6 4h7v4h4v12H6V4z"></path></svg>
                                    
                                    <span class="text-xl font-bold text-gray-800 mb-2">{{ $report['name'] }}</span>
                                    <p class="text-gray-600 text-sm mb-4">รูปแบบ: PDF</p> {{-- Placeholder for file info --}}

                                    {{-- Download Button/Link --}}
                                    <span class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold transition duration-300">
                                        ดาวน์โหลดรายงาน
                                        <svg class="h-5 w-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                    </span>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
