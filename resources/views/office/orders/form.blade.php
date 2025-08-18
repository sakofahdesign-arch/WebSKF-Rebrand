@extends('layouts.admin-layout')

@section('title', 'แบบฟอร์มฝ่ายบุคคล')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-6">แบบฟอร์มฝ่ายบุคคล</h1>
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="p-4 font-semibold text-gray-600 uppercase tracking-wider text-center">ชื่อเอกสาร</th>
                            <th class="p-4 font-semibold text-gray-600 uppercase tracking-wider text-center">วันที่ประกาศ</th>
                            <th class="p-4 font-semibold text-gray-600 uppercase tracking-wider text-center">ดาวน์โหลด</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $item)
                            <tr class="border-t hover:bg-gray-50">
                                <td class="p-4 text-left text-gray-800 font-medium">
                                    {{ $item->title }}
                                </td>
                                <td class="p-4 text-center text-gray-600 whitespace-nowrap">
                                    {{ $item->date ? thaidate('j M Y', strtotime($item->date)) : '-' }}
                                </td>
                                <td class="p-4 text-center">
                                    <a href="{{ asset('file/inside_publish/' . $item->uploadfile) }}" target="_blank" class="inline-flex items-center justify-center w-10 h-10 bg-green-500 text-white rounded-md hover:bg-green-600 transition-colors duration-200" aria-label="ดาวน์โหลด {{ $item->title }}">
                                        <i class="fas fa-download"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center py-10 text-gray-500">
                                    <i class="fas fa-inbox fa-2x mb-2 text-gray-400"></i>
                                    <p>ไม่พบข้อมูลแบบฟอร์ม</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($data->hasPages())
                <div class="p-4 bg-gray-50 border-t">
                    {{ $data->links('pagination::tailwind') }}
                </div>
            @endif
        </div>
    </div>
@endsection
