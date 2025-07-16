@extends('layouts.admin-layout')
@section('title', 'จัดการประกาศสำหรับเจ้าหน้าที่')

@section('content')
<div class="p-4 md:p-8 bg-gray-100 min-h-screen">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">จัดการประกาศสำหรับเจ้าหน้าที่</h1>
            <p class="text-gray-500 mt-1">เพิ่ม ลบ แก้ไข ประกาศและแบบฟอร์มภายใน</p>
        </div>
        <a href="{{ route('announcements.create') }}" class="px-5 py-2.5 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700">
            <i class="fas fa-plus mr-2"></i> เพิ่มประกาศใหม่
        </a>
    </div>
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-600">
                 <thead class="text-xs text-gray-700 uppercase bg-gray-100">
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
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-6 py-4">{{ $item->type_announcement }}</td>
                            <td class="px-6 py-4 font-semibold text-gray-900">{{ $item->title }}</td>
                            <td class="px-6 py-4">{{ thaidate('j M Y', $item->date) }}</td>
                            <td class="px-6 py-4">
                                <a href="{{ asset('file/inside_publish/' . $item->uploadfile) }}" target="_blank" class="text-blue-600 hover:underline">ดาวน์โหลด</a>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <a href="{{ route('announcements.edit', $item->id) }}" class="font-medium text-yellow-600 hover:underline mr-4">แก้ไข</a>
                                <a href="{{ route('announcements.destroy', $item->id) }}" onclick="return confirm('คุณแน่ใจหรือไม่ที่จะลบประกาศนี้?')" class="font-medium text-red-600 hover:underline">ลบ</a>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center py-8 text-gray-500">ไม่พบข้อมูลประกาศ...</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4">{{ $announcements->links() }}</div>
    </div>
</div>
@endsection