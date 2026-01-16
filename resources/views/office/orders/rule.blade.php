@extends('layouts.admin-layout')

@section('title', 'ข้อบังคับและระเบียบสหกรณ์')

@section('header')
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                <i class="fas fa-gavel text-emerald-600"></i> ข้อบังคับและระเบียบสหกรณ์
            </h2>
            <nav class="flex text-sm text-gray-500 mt-1" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2">
                    <li class="inline-flex items-center">
                        <a href="#" class="hover:text-emerald-600">เอกสารภายใน</a>
                    </li>
                    <li><i class="fas fa-chevron-right text-xs"></i></li>
                    <li class="text-gray-400" aria-current="page">ข้อบังคับและระเบียบ</li>
                </ol>
            </nav>
        </div>
    </div>
@endsection

@section('content')
    <div class="container mx-auto max-w-7xl">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <div class="lg:col-span-1 space-y-6">
                <div class="card bg-white shadow-lg border border-gray-100">
                    <div class="card-body p-6">
                        <h3 class="font-bold text-gray-700 flex items-center gap-2 mb-4 border-b border-gray-100 pb-3">
                            <i class="fas fa-file-download text-emerald-500"></i> ดาวน์โหลดเอกสาร
                        </h3>
                        
                        <div class="space-y-3">
                            <a href="{{ url('file/cooperative_rules/ข้อบังคับสหกรณ์อิสลามษะกอฟะฮ 2566.pdf') }}" target="_blank" 
                               class="group flex items-center p-3 rounded-xl border border-gray-100 bg-gray-50 hover:bg-emerald-50 hover:border-emerald-200 transition-all duration-200 relative overflow-hidden">
                                <div class="w-12 h-12 rounded-lg bg-white flex items-center justify-center text-red-500 shadow-sm group-hover:scale-110 transition-transform">
                                    <i class="fas fa-file-pdf text-2xl"></i>
                                </div>
                                <div class="ml-3 flex-grow min-w-0">
                                    <h4 class="text-sm font-bold text-gray-800 group-hover:text-emerald-700 truncate">ข้อบังคับสหกรณ์ฯ 2566</h4>
                                    <span class="text-xs text-gray-500 group-hover:text-emerald-600">PDF File</span>
                                </div>
                                <div class="absolute top-0 right-0">
                                    <span class="badge badge-success text-white badge-xs rounded-bl-lg rounded-tr-lg shadow-sm">ใหม่</span>
                                </div>
                            </a>

                            <a href="{{ url('file/cooperative_rules/ข้อบังคับสหกรณ์(รวมทุกฉบับ).pdf') }}" target="_blank"
                               class="group flex items-center p-3 rounded-xl border border-gray-100 bg-gray-50 hover:bg-emerald-50 hover:border-emerald-200 transition-all duration-200">
                                <div class="w-12 h-12 rounded-lg bg-white flex items-center justify-center text-amber-500 shadow-sm group-hover:scale-110 transition-transform">
                                    <i class="fas fa-file-archive text-2xl"></i>
                                </div>
                                <div class="ml-3 flex-grow min-w-0">
                                    <h4 class="text-sm font-bold text-gray-800 group-hover:text-emerald-700 truncate">ข้อบังคับ (รวมทุกฉบับ)</h4>
                                    <span class="text-xs text-gray-500 group-hover:text-emerald-600">PDF File</span>
                                </div>
                                <div class="text-gray-300 group-hover:text-emerald-500 transition-colors">
                                    <i class="fas fa-download"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card bg-gradient-to-br from-emerald-600 to-teal-600 text-white shadow-lg">
                    <div class="card-body p-6">
                        <div class="flex items-start gap-4">
                            <i class="fas fa-info-circle text-2xl opacity-80 mt-1"></i>
                            <div>
                                <h3 class="font-bold text-lg">หมายเหตุ</h3>
                                <p class="text-sm opacity-90 mt-1 leading-relaxed font-light">
                                    ข้อบังคับและระเบียบถือเป็นกฎหมายสูงสุดของสหกรณ์ สมาชิกและเจ้าหน้าที่ควรทำความเข้าใจให้ถ่องแท้เพื่อสิทธิประโยชน์ของตนเอง
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2">
                <div class="card bg-white shadow-lg border border-gray-100 h-full overflow-hidden">
                    <div class="bg-gray-50 px-6 py-3 border-b border-gray-100 flex justify-between items-center">
                        <span class="font-bold text-gray-600 text-sm flex items-center gap-2">
                            <i class="fas fa-book-reader text-emerald-500"></i> มุมมองหนังสืออิเล็กทรอนิกส์
                        </span>
                        <a href="https://online.anyflip.com/haqcj/sfqo/index.html" target="_blank" class="btn btn-xs btn-outline btn-success gap-2">
                            เปิดเต็มจอ <i class="fas fa-external-link-alt"></i>
                        </a>
                    </div>
                    
                    <div class="relative w-full h-[600px] md:h-[750px] bg-gray-100">
                        <iframe 
                            src="https://online.anyflip.com/haqcj/sfqo/index.html" 
                            class="absolute inset-0 w-full h-full border-0"
                            seamless="seamless" 
                            scrolling="no" 
                            frameborder="0" 
                            allowtransparency="true" 
                            allowfullscreen="true">
                        </iframe>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection