@extends('layouts.admin-layout')
@section('title', 'เพิ่มประกาศใหม่')

@section('content')
<div class="p-4 md:p-8 bg-gray-100 min-h-screen">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">เพิ่มประกาศสำหรับเจ้าหน้าที่</h1>
        <p class="text-gray-500 mt-1">กรอกข้อมูลและอัปโหลดไฟล์ประกาศหรือแบบฟอร์ม</p>
    </div>

    <form action="{{ route('announcements.store') }}" method="post" enctype="multipart/form-data" class="bg-white rounded-2xl shadow-xl p-6 md:p-8 max-w-3xl mx-auto">
        @csrf
        <div class="space-y-6">
            <div>
                <label for="type_announcement" class="block mb-2 text-sm font-medium text-gray-700">ประเภทเอกสาร</label>
                <select name="type_announcement" id="type_announcement" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3" required>
                    <option value="" disabled selected>-- กรุณาเลือกประเภท --</option>
                    <option value="1">ประกาศทั่วไป</option>
                    <option value="2">แบบฟอร์ม</option>
                </select>
            </div>
            <div>
                <label for="title" class="block mb-2 text-sm font-medium text-gray-700">ชื่อเอกสาร / หัวข้อ</label>
                <input type="text" name="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3" placeholder="เช่น ประกาศวันหยุด, แบบฟอร์มใบเบิก" required>
            </div>
            <div x-data="{ fileName: '' }">
                <label for="uploadfile" class="block mb-2 text-sm font-medium text-gray-700">ไฟล์แนบ</label>
                <div class="mt-1 flex justify-center px-6 pt-8 pb-8 border-2 border-gray-300 border-dashed rounded-lg">
                    <div class="space-y-1 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true"><path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                        <div class="flex text-sm text-gray-600 justify-center">
                            <label for="uploadfile" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500">
                                <span>อัปโหลดไฟล์</span>
                                <input id="uploadfile" name="uploadfile" type="file" class="sr-only" @change="fileName = $event.target.files[0] ? $event.target.files[0].name : ''" required>
                            </label>
                        </div>
                        <p class="text-xs text-gray-500">PDF, DOC, XLSX, JPG, PNG (ไม่เกิน 10MB)</p>
                        <p x-show="fileName" class="text-sm text-green-600 font-semibold pt-2" x-text="`ไฟล์ที่เลือก: ${fileName}`"></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end gap-3">
            <a href="{{ route('announcements.index') }}" class="px-6 py-3 bg-gray-200 text-gray-800 font-bold rounded-lg hover:bg-gray-300">ยกเลิก</a>
            <button type="submit" class="px-6 py-3 bg-blue-600 text-white font-bold rounded-lg shadow-md hover:bg-blue-700">บันทึก</button>
        </div>
    </form>
</div>
@endsection

@include('components.sweetalert2')