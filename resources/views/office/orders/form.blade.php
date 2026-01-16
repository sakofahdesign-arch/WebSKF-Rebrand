@extends('layouts.admin-layout')

@section('title', 'แบบฟอร์มฝ่ายบุคคล')

@section('header')
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                <i class="fas fa-file-signature text-emerald-600"></i> แบบฟอร์มฝ่ายบุคคล
            </h2>
            <nav class="flex text-sm text-gray-500 mt-1" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2">
                    <li class="inline-flex items-center">
                        <a href="{{ route('form') }}" class="hover:text-emerald-600">เอกสารภายใน</a>
                    </li>
                    <li><i class="fas fa-chevron-right text-xs"></i></li>
                    <li class="text-gray-400" aria-current="page">แบบฟอร์มฝ่ายบุคคล</li>
                </ol>
            </nav>
        </div>
    </div>
@endsection

@section('content')
    <div class="container mx-auto max-w-7xl">

        <div class="card bg-white shadow-lg border border-gray-100 overflow-hidden">
            <div class="h-2 bg-gradient-to-r from-emerald-500 to-teal-400"></div>

            <div class="p-6 md:p-8">
                <div class="flex items-center gap-3 mb-6">
                    <div
                        class="w-10 h-10 rounded-lg bg-emerald-100 flex items-center justify-center text-emerald-600 shadow-sm">
                        <i class="fas fa-folder-open text-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-800">รายการแบบฟอร์มทั้งหมด</h3>
                        <p class="text-xs text-gray-500 mt-1">ดาวน์โหลดเอกสารและแบบฟอร์มสำหรับติดต่อฝ่ายบุคคล</p>
                    </div>
                </div>

                <div class="rounded-lg border border-gray-100 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="table w-full">
                            <thead class="bg-gray-50 text-gray-500 font-bold text-sm">
                                <tr>
                                    <th class="py-4 px-6 text-left">ชื่อแบบฟอร์ม</th>
                                    <th class="py-4 px-6 text-center w-48">วันที่อัปเดต</th>
                                    <th class="py-4 px-6 text-center w-40">สถานะไฟล์</th>
                                    <th class="py-4 px-6 text-center w-32">จัดการ</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-700">
                                @forelse ($data as $item)
                                    @php
                                        // ตรวจสอบไฟล์
                                        $filePath = public_path('file/inside_publish/' . $item->uploadfile);
                                        $exists = !empty($item->uploadfile) && file_exists($filePath);
                                        $fileExt = $exists
                                            ? strtolower(pathinfo($item->uploadfile, PATHINFO_EXTENSION))
                                            : null;

                                        // เลือกไอคอนตามนามสกุลไฟล์
                                        $iconClass = 'fa-file';
                                        $iconColor = 'text-gray-400';

                                        if ($fileExt === 'pdf') {
                                            $iconClass = 'fa-file-pdf';
                                            $iconColor = 'text-red-500';
                                        } elseif (in_array($fileExt, ['doc', 'docx'])) {
                                            $iconClass = 'fa-file-word';
                                            $iconColor = 'text-blue-500';
                                        } elseif (in_array($fileExt, ['xls', 'xlsx'])) {
                                            $iconClass = 'fa-file-excel';
                                            $iconColor = 'text-green-500';
                                        }
                                    @endphp

                                    <tr
                                        class="hover:bg-emerald-50/40 transition-colors border-b border-gray-100 last:border-none group">
                                        <td class="py-4 px-6">
                                            <div class="flex items-center gap-3">
                                                <div
                                                    class="w-8 h-8 rounded bg-gray-50 flex items-center justify-center {{ $iconColor }}">
                                                    <i class="fas {{ $iconClass }} text-lg"></i>
                                                </div>
                                                <div>
                                                    <div
                                                        class="font-bold text-gray-800 text-base leading-snug group-hover:text-emerald-700 transition-colors">
                                                        {{ $item->title }}
                                                    </div>
                                                    @if ($exists)
                                                        <span
                                                            class="text-[10px] text-gray-400 uppercase">{{ $fileExt }}
                                                            FILE</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>

                                        <td class="py-4 px-6 text-center whitespace-nowrap">
                                            <div
                                                class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-gray-50 border border-gray-100 text-gray-500 text-sm">
                                                <i class="far fa-calendar-alt text-emerald-500"></i>
                                                {{ $item->date ? thaidate('j M Y', strtotime($item->date)) : '-' }}
                                            </div>
                                        </td>

                                        <td class="py-4 px-6 text-center whitespace-nowrap">
                                            @if ($exists)
                                                <span
                                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-200">
                                                    <i class="fas fa-check-circle text-emerald-500"></i> พร้อมดาวน์โหลด
                                                </span>
                                            @else
                                                <span
                                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-medium bg-red-50 text-red-700 border border-red-200">
                                                    <i class="fas fa-times-circle text-red-500"></i> ไม่พบไฟล์
                                                </span>
                                            @endif
                                        </td>

                                        <td class="py-4 px-6 text-center">
                                            @if ($exists)
                                                <a href="{{ asset('file/inside_publish/' . $item->uploadfile) }}"
                                                    target="_blank"
                                                    class="btn btn-sm bg-emerald-600 hover:bg-emerald-700 text-white border-none gap-2 shadow-sm shadow-emerald-200">
                                                    <i class="fas fa-download"></i> <span
                                                        class="hidden lg:inline">ดาวน์โหลด</span>
                                                </a>
                                            @else
                                                <button
                                                    class="btn btn-sm btn-disabled bg-gray-100 text-gray-400 border-none cursor-not-allowed opacity-50">
                                                    <i class="fas fa-download"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="py-16 text-center text-gray-400">
                                            <div class="flex flex-col items-center justify-center">
                                                <div
                                                    class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                                                    <i class="fas fa-folder-open text-3xl opacity-30"></i>
                                                </div>
                                                <h3 class="text-lg font-medium text-gray-600">ไม่พบแบบฟอร์ม</h3>
                                                <p class="text-sm text-gray-400 mt-1">ยังไม่มีเอกสารในหมวดหมู่นี้</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                @if ($data->hasPages())
                    <div class="mt-6 border-t border-gray-100 pt-4 flex justify-end">
                        {{ $data->links('vendor.pagination.daisyui') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
