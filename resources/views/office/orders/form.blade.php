@extends('layouts.admin-layout')

@section('title', 'แบบฟอร์มฝ่ายบุคคล')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800">📑 แบบฟอร์มฝ่ายบุคคล</h1>
            <p class="text-gray-500 mt-1">ดาวน์โหลดเอกสารและแบบฟอร์มที่เกี่ยวข้องกับงานบุคคล</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
        <div class="p-6 border-b">
            <h3 class="text-lg font-semibold text-gray-800">รายการแบบฟอร์มทั้งหมด</h3>
        </div>

        @if ($data->count())
            <div class="divide-y">
                @foreach ($data as $item)
                    <div class="flex flex-col md:flex-row items-start md:items-center justify-between p-4 hover:bg-gray-50 transition">
                        <div class="flex-1">
                            <h4 class="text-gray-800 font-semibold text-base md:text-lg">
                                {{ $item->title }}
                            </h4>
                            <p class="text-gray-500 text-sm mt-1">
                                {{ $item->date ? thaidate('j M Y', strtotime($item->date)) : '-' }}
                            </p>
                        </div>

                        <div class="mt-3 md:mt-0">
                            @php
                                $filePath = public_path('file/inside_publish/' . $item->uploadfile);
                                $exists = $item->uploadfile && file_exists($filePath);
                                $fileExt = $exists ? strtoupper(pathinfo($item->uploadfile, PATHINFO_EXTENSION)) : null;
                            @endphp

                            @if ($exists)
                                <div class="flex items-center space-x-2">
                                    <span class="px-2 py-1 text-xs font-medium bg-gray-100 text-gray-600 rounded-md">
                                        {{ $fileExt }}
                                    </span>
                                    <a href="{{ asset('file/inside_publish/' . $item->uploadfile) }}"
                                       target="_blank"
                                       class="inline-flex items-center px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors duration-200">
                                        <i class="fas fa-download mr-2"></i> ดาวน์โหลด
                                    </a>
                                </div>
                            @else
                                <span class="inline-flex items-center px-3 py-2 bg-red-100 text-red-600 rounded-lg text-sm">
                                    <i class="fas fa-exclamation-triangle mr-2"></i> ไฟล์ไม่พบ
                                </span>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            @if ($data->hasPages())
                <div class="p-4 bg-gray-50 border-t">
                    {{ $data->links('pagination::tailwind') }}
                </div>
            @endif
        @else
            <div class="text-center py-10 text-gray-500">
                <i class="fas fa-inbox fa-3x mb-3 text-gray-400"></i>
                <p class="text-lg">ไม่พบข้อมูลแบบฟอร์ม</p>
            </div>
        @endif
    </div>
</div>
@endsection
