@extends('layouts.admin-layout')

@section('title', 'ประกาศภายใน')

@section('header')
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                <i class="fas fa-bullhorn text-emerald-600"></i> ประกาศภายใน
            </h2>
            <nav class="flex text-sm text-gray-500 mt-1" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2">
                    <li class="inline-flex items-center">
                        <a href="#" class="hover:text-emerald-600">เอกสารภายใน</a>
                    </li>
                    <li><i class="fas fa-chevron-right text-xs"></i></li>
                    <li class="text-gray-400" aria-current="page">ประกาศภายใน</li>
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
                    <div class="w-10 h-10 rounded-lg bg-emerald-100 flex items-center justify-center text-emerald-600 shadow-sm">
                        <i class="fas fa-clipboard-list text-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-800">รายการประกาศทั้งหมด</h3>
                        <p class="text-xs text-gray-500 mt-1">เอกสารและข่าวสารประชาสัมพันธ์สำหรับเจ้าหน้าที่</p>
                    </div>
                </div>

                <div class="rounded-lg border border-gray-100 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="table w-full">
                            <thead class="bg-gray-50 text-gray-500 font-bold text-sm">
                                <tr>
                                    <th class="py-4 px-6 text-left">หัวข้อประกาศ</th>
                                    <th class="py-4 px-6 text-center w-48">วันที่ประกาศ</th>
                                    <th class="py-4 px-6 text-center w-32">ดาวน์โหลด</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-700">
                                @forelse ($data as $item)
                                    <tr class="hover:bg-emerald-50/40 transition-colors border-b border-gray-100 last:border-none">
                                        <td class="py-4 px-6">
                                            <div class="font-bold text-gray-800 text-base leading-snug">
                                                {{ $item->title }}
                                            </div>
                                        </td>

                                        <td class="py-4 px-6 text-center whitespace-nowrap">
                                            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-gray-50 border border-gray-100 text-gray-500 text-sm">
                                                <i class="far fa-calendar-alt text-emerald-500"></i>
                                                {{ $item->date ? thaidate('j M Y', strtotime($item->date)) : '-' }}
                                            </div>
                                        </td>

                                        <td class="py-4 px-6 text-center">
                                            @if (!empty($item->uploadfile) && file_exists(public_path('file/inside_publish/' . $item->uploadfile)))
                                                <a href="{{ url('file/inside_publish/' . $item->uploadfile) }}" target="_blank"
                                                   class="btn btn-sm btn-ghost text-emerald-600 hover:bg-emerald-100 hover:text-emerald-700 tooltip tooltip-left"
                                                   data-tip="ดาวน์โหลดไฟล์">
                                                    <i class="fas fa-cloud-download-alt text-lg"></i>
                                                </a>
                                            @else
                                                <div class="tooltip tooltip-left" data-tip="ไม่พบไฟล์">
                                                    <button class="btn btn-sm btn-ghost text-gray-300 cursor-not-allowed" disabled>
                                                        <i class="fas fa-ban text-lg"></i>
                                                    </button>
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="py-16 text-center text-gray-400">
                                            <div class="flex flex-col items-center justify-center">
                                                <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                                                    <i class="fas fa-folder-open text-3xl opacity-30"></i>
                                                </div>
                                                <h3 class="text-lg font-medium text-gray-600">ไม่พบข้อมูลประกาศ</h3>
                                                <p class="text-sm text-gray-400 mt-1">ขณะนี้ยังไม่มีรายการประกาศในระบบ</p>
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