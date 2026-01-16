@extends('layouts.admin-layout')

@section('title', 'ระเบียบสหกรณ์')

@section('header')
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                <i class="fas fa-book text-emerald-600"></i> ระเบียบสหกรณ์
            </h2>
            <nav class="flex text-sm text-gray-500 mt-1" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2">
                    <li class="inline-flex items-center">
                        <a href="#" class="hover:text-emerald-600">เอกสารภายใน</a>
                    </li>
                    <li><i class="fas fa-chevron-right text-xs"></i></li>
                    <li class="text-gray-400" aria-current="page">ระเบียบสหกรณ์</li>
                </ol>
            </nav>
        </div>
    </div>
@endsection

@section('content')
    {{-- กำหนดข้อมูลไฟล์ในรูปแบบ Array เพื่อให้โค้ดสะอาดและจัดการง่าย --}}
    @php
        $documents = [
            ['name' => 'ว่าด้วยกองทุนให้ยืมเพื่อการศึกษา', 'file' => 'ว่าด้วยกองทุนให้ยืมเพื่อการศึกษา.pdf'],
            ['name' => 'ว่าด้วยการจ่ายและเก็บรักษาเงินสด', 'file' => 'ว่าด้วยการจ่ายและเก็บรักษาเงินสด.pdf'],
            ['name' => 'ว่าด้วยการใช้ทุนสาธารณประโยชน์', 'file' => 'ว่าด้วยการใช้ทุนสาธารณประโยชน์.pdf'],
            ['name' => 'ว่าด้วยการให้เงินกู้ยืมเพื่อศึกษาต่อสำหรับเจ้าหน้าที่สหกรณ์', 'file' => 'ว่าด้วยการให้เงินกู้ยืมเพื่อศึกษาต่อสำหรับเจ้าหน้าที่สหกรณ์.pdf'],
            ['name' => 'ว่าด้วยคณะอนุกรรมการ', 'file' => 'ว่าด้วยคณะอนุกรรมการ.pdf'],
            ['name' => 'ว่าด้วยค่าเบี้ยเลี้ยง-ค่าพาหนะ-ค่าเดินทาง', 'file' => 'ว่าด้วยค่าเบี้ยเลี้ยง-ค่าพาหนะ-ค่าเดินทาง.pdf'],
            ['name' => 'ว่าด้วยเงินยืมทดลองจ่าย', 'file' => 'ว่าด้วยเงินยืมทดลองจ่าย.pdf'],
            ['name' => 'ว่าด้วยเจ้าหน้าที่และข้อบังคับเกี่ยวกับการทำงาน', 'file' => 'ว่าด้วยเจ้าหน้าที่และข้อบังคับเกี่ยวกับการทำงาน.pdf'],
            ['name' => 'ว่าด้วยเจ้าหน้าที่และลูกจ้างสหกรณ์', 'file' => 'ว่าด้วยเจ้าหน้าที่และลูกจ้างสหกรณ์.pdf'],
            ['name' => 'ว่าด้วยใช้เงินทุนสะสมเพื่อการศึกษาอบรม', 'file' => 'ว่าด้วยใช้เงินทุนสะสมเพื่อการศึกษาอบรม.pdf'],
            ['name' => 'ว่าด้วยที่ปรึกษาของสหกรณ์', 'file' => 'ว่าด้วยที่ปรึกษาของสหกรณ์.pdf'],
            ['name' => 'ว่าด้วยสวัสดิการคณะกรรมการและเจ้าหน้าที่', 'file' => 'ว่าด้วยสวัสดิการคณะกรรมการและเจ้าหน้าที่.pdf'],
            ['name' => 'ว่าด้วยอำนาจหน้าที่และความรับผิดชอบของเจ้าหน้าที่สหกรณ์', 'file' => 'ว่าด้วยอำนาจหน้าที่และความรับผิดชอบของเจ้าหน้าที่สหกรณ์.pdf'],
        ];
    @endphp

    <div class="container mx-auto max-w-7xl">
        
        <div class="flex items-center gap-3 mb-6">
            <div class="w-10 h-10 rounded-lg bg-emerald-100 flex items-center justify-center text-emerald-600 shadow-sm">
                <i class="fas fa-scroll text-lg"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-800">ระเบียบสหกรณ์ปี 2565</h3>
            <div class="flex-grow h-px bg-gray-200 ml-4"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($documents as $doc)
                <a href="{{ url('file/order/' . $doc['file']) }}" target="_blank" 
                   class="group relative bg-white p-5 rounded-xl shadow-sm border border-gray-100 hover:shadow-lg hover:-translate-y-1 hover:border-emerald-200 transition-all duration-300">
                    
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 rounded-lg bg-red-50 text-red-500 flex items-center justify-center group-hover:bg-red-100 group-hover:scale-110 transition-all duration-300">
                                <i class="fas fa-file-pdf text-2xl"></i>
                            </div>
                        </div>

                        <div class="flex-grow min-w-0">
                            <h4 class="text-sm font-bold text-gray-800 group-hover:text-emerald-700 leading-tight mb-2 line-clamp-2">
                                {{ $doc['name'] }}
                            </h4>
                            <div class="flex items-center justify-between mt-auto">
                                <span class="text-xs text-gray-400 font-medium bg-gray-50 px-2 py-1 rounded">PDF File</span>
                                <span class="text-xs font-bold text-emerald-500 flex items-center gap-1 opacity-0 group-hover:opacity-100 transform translate-x-2 group-hover:translate-x-0 transition-all duration-300">
                                    ดาวน์โหลด <i class="fas fa-download"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="absolute top-0 right-0 w-16 h-16 bg-gradient-to-br from-white via-white to-gray-50 opacity-50 rounded-tr-xl pointer-events-none"></div>
                </a>
            @endforeach
        </div>

        <div class="mt-8 text-center text-gray-400 text-sm">
            <i class="fas fa-info-circle mr-1"></i> เอกสารทั้งหมดอยู่ในรูปแบบ PDF หากไม่สามารถเปิดได้ กรุณาติดตั้งโปรแกรมอ่าน PDF
        </div>

    </div>
@endsection