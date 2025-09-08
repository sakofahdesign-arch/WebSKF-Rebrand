@extends('layouts.admin-layout')
@section('title', 'จัดการประกาศสำหรับเจ้าหน้าที่')

@section('content')
    <div class="p-6 md:p-10 bg-gray-100 min-h-screen">

        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-800">📢 จัดการประกาศสำหรับเจ้าหน้าที่</h1>
                <p class="text-gray-500 mt-1">เพิ่ม ลบ แก้ไข ประกาศและแบบฟอร์มภายใน</p>
            </div>
            <a href="{{ route('announcements.create') }}"
                class="inline-flex items-center px-5 py-2.5 bg-blue-600 text-white font-medium rounded-xl shadow-md hover:bg-blue-700 transition">
                <i class="fas fa-plus mr-2"></i> เพิ่มประกาศใหม่
            </a>
        </div>

        <!-- Table -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-200">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-600">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th class="px-6 py-4">ประเภท</th>
                            <th class="px-6 py-4">หัวข้อ</th>
                            <th class="px-6 py-4">วันที่อัปโหลด</th>
                            <th class="px-6 py-4">ไฟล์</th>
                            <th class="px-6 py-4 text-center">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($announcements as $item)
                            <tr class="bg-white border-b hover:bg-gray-50 transition">
                                <!-- ประเภท -->
                                <td class="px-6 py-4">
                                    <span @class([
                                        'px-3 py-1 text-xs font-medium rounded-full',
                                        'bg-blue-100 text-blue-700' => $item->type_announcement === 'ทั่วไป',
                                        'bg-green-100 text-green-700' => $item->type_announcement === 'แบบฟอร์ม',
                                        'bg-gray-100 text-gray-700' => !in_array($item->type_announcement, [
                                            'ทั่วไป',
                                            'แบบฟอร์ม',
                                        ]),
                                    ])>
                                        {{ $item->type_announcement }}
                                    </span>
                                </td>


                                <!-- หัวข้อ -->
                                <td class="px-6 py-4 font-semibold text-gray-900">{{ $item->title }}</td>

                                <!-- วันที่ -->
                                <td class="px-6 py-4 text-gray-500">{{ thaidate('j M Y', $item->date) }}</td>

                                <!-- ไฟล์ -->
                                <td class="px-6 py-4">
                                    @if ($item->file_exists)
                                        <a href="{{ asset('file/inside_publish/' . $item->uploadfile) }}" target="_blank"
                                            class="inline-flex items-center text-blue-600 hover:text-blue-800 hover:underline">
                                            <i class="fas fa-file-download mr-1"></i> ดาวน์โหลด
                                        </a>
                                    @else
                                        <span class="inline-flex items-center text-red-500">
                                            <i class="fas fa-exclamation-circle mr-1"></i> ไม่มีไฟล์
                                        </span>
                                    @endif
                                </td>

                                <!-- จัดการ -->
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center space-x-4">
                                        <a href="{{ route('announcements.edit', $item->id) }}"
                                            class="text-yellow-600 hover:text-yellow-800" title="แก้ไข">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ route('announcements.destroy', $item->id) }}"
                                            onclick="return confirm('คุณแน่ใจหรือไม่ที่จะลบประกาศนี้?')"
                                            class="text-red-600 hover:text-red-800" title="ลบ">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-10 text-gray-500">
                                    ไม่พบข้อมูลประกาศ...
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="p-4 border-t border-gray-200">
                {{ $announcements->links() }}
            </div>
        </div>
    </div>
@endsection
