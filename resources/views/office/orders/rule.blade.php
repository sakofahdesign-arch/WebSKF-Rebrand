@extends('layouts.admin-layout')

@section('title', 'ข้อบังคับและระเบียบสหกรณ์')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-6">ข้อบังคับและระเบียบสหกรณ์</h1>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Left Column: Download Links -->
        <div class="lg:col-span-1">
            <div class="bg-white p-6 rounded-xl shadow-lg h-full">
                <h3 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-4">
                    <i class="fas fa-download mr-2 text-gray-500"></i>
                    ดาวน์โหลดเอกสาร
                </h3>
                <div class="space-y-3">
                    
                    <!-- Download Item 1 -->
                    <a href="{{ url('file/cooperative_rules/ข้อบังคับสหกรณ์อิสลามษะกอฟะฮ 2566.pdf') }}" target="_blank" class="block p-4 border rounded-lg hover:bg-gray-50 hover:border-green-500 transition duration-200">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <i class="fas fa-file-pdf text-red-500 text-2xl mr-4"></i>
                                <div>
                                    <p class="font-semibold text-gray-800">ข้อบังคับสหกรณ์ฯ 2566</p>
                                    <p class="text-xs text-gray-500">ไฟล์ PDF</p>
                                </div>
                            </div>
                            {{-- Replaced the broken new.gif with a Tailwind CSS badge --}}
                            <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">ใหม่</span>
                        </div>
                    </a>

                    <!-- Download Item 2 -->
                    <a href="{{ url('file/cooperative_rules/ข้อบังคับสหกรณ์(รวมทุกฉบับ).pdf') }}" target="_blank" class="block p-4 border rounded-lg hover:bg-gray-50 hover:border-green-500 transition duration-200">
                        <div class="flex justify-between items-center">
                             <div class="flex items-center">
                                <i class="fas fa-file-archive text-yellow-500 text-2xl mr-4"></i>
                                <div>
                                    <p class="font-semibold text-gray-800">ข้อบังคับสหกรณ์ (รวมทุกฉบับ)</p>
                                    <p class="text-xs text-gray-500">ไฟล์ PDF</p>
                                </div>
                            </div>
                            <i class="fas fa-cloud-download-alt text-gray-400"></i>
                        </div>
                    </a>

                    {{-- Add more download links here if needed --}}

                </div>
            </div>
        </div>

        <!-- Right Column: Document Viewer -->
        <div class="lg:col-span-2">
            <div class="bg-white p-6 rounded-xl shadow-lg">
                <h3 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-4">
                    <i class="fas fa-book-open mr-2 text-gray-500"></i>
                    เอกสารสำหรับแสดงผล
                </h3>
                {{-- Removed aspect ratio and set a fixed, taller height --}}
                <div class="w-full h-[75vh] bg-gray-100 rounded-lg overflow-hidden">
                    <iframe 
                        src="https://online.anyflip.com/haqcj/sfqo/index.html" 
                        class="w-full h-full border-0"
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
