@extends('layouts.admin-layout')

@section('title', 'ประกาศภายใน')

@section('content')
    <div class="container mx-auto px-4 md:px-8 py-6">
        <!-- หัวข้อหลัก -->
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800">📢 ประกาศภายใน</h1>
                <p class="text-gray-500 mt-1">รายการประกาศและแบบฟอร์มล่าสุดสำหรับเจ้าหน้าที่</p>
            </div>
        </div>

        <!-- กล่องหลัก -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
            <div class="p-6 border-b bg-gray-50">
                <h3 class="text-lg font-semibold text-gray-700">📂 เอกสารทั้งหมด</h3>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-4 font-semibold text-gray-600 uppercase tracking-wider text-left">ชื่อเอกสาร</th>
                            <th class="p-4 font-semibold text-gray-600 uppercase tracking-wider text-center">วันที่ประกาศ</th>
                            <th class="p-4 font-semibold text-gray-600 uppercase tracking-wider text-center">ไฟล์</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $item)
                            <tr class="border-t hover:bg-gray-50 transition">
                                <!-- ชื่อเอกสาร -->
                                <td class="p-4 text-left text-gray-800 font-medium">
                                    {{ $item->title }}
                                </td>
                                <!-- วันที่ -->
                                <td class="p-4 text-center text-gray-600 whitespace-nowrap">
                                    {{ $item->date ? thaidate('j M Y', strtotime($item->date)) : '-' }}
                                </td>

                                <!-- ปุ่มดาวน์โหลด -->
                                <td class="p-4 text-center">
                                    @if (!empty($item->uploadfile) && file_exists(public_path('file/inside_publish/' . $item->uploadfile)))
                                        <a href="{{ url('file/inside_publish/' . $item->uploadfile) }}" target="_blank"
                                            class="inline-flex items-center justify-center w-10 h-10 bg-green-500 text-white rounded-full hover:bg-green-600 transition-colors duration-200"
                                            title="ดาวน์โหลด: {{ $item->title }}">
                                            <i class="fas fa-download"></i>
                                        </a>
                                    @else
                                        <span class="inline-flex items-center justify-center w-10 h-10 bg-gray-300 text-gray-600 rounded-full cursor-not-allowed" title="ไม่มีไฟล์แนบ">
                                            <i class="fas fa-ban"></i>
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-10 text-gray-500">
                                    <i class="fas fa-inbox fa-2x mb-2 text-gray-400"></i>
                                    <p>ไม่พบข้อมูลประกาศ</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- pagination -->
            @if ($data->hasPages())
                <div class="p-4 bg-gray-50 border-t">
                    {{ $data->links('pagination::tailwind') }}
                </div>
            @endif
        </div>
    </div>
@endsection
