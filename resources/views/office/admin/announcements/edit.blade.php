@extends('layouts.admin-layout')
@section('title', 'แก้ไขประกาศ')

@section('title', 'แก้ไขประกาศ')

@section('content')
<div class="p-4 md:p-8 bg-gray-100 min-h-screen">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">แก้ไขประกาศ: {{ $announcement->title }}</h1>
    <form action="{{ route('announcements.update', $announcement->id) }}" method="post" enctype="multipart/form-data" class="bg-white rounded-2xl shadow-xl p-8 max-w-3xl mx-auto">
        @csrf
        @method('PUT')
        <div class="space-y-6">
            <div>
                 <label for="type_announcement" class="block mb-2 text-sm font-medium text-gray-700">ประเภทเอกสาร</label>
                <select name="type_announcement" id="type_announcement" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3" required>
                    <option value="1" @if($announcement->type_announcement == '1') selected @endif>ประกาศทั่วไป</option>
                    <option value="2" @if($announcement->type_announcement == '2') selected @endif>แบบฟอร์ม</option>
                </select>
            </div>
            <div>
                <label for="title" class="block mb-2 text-sm font-medium text-gray-700">ชื่อเอกสาร / หัวข้อ</label>
                <input type="text" name="title" value="{{ $announcement->title }}" class="bg-gray-50 border border-gray-300 rounded-lg w-full p-3" required>
            </div>
             <div x-data="{ fileName: '' }">
                <label for="uploadfile" class="block mb-2 text-sm font-medium text-gray-700">ไฟล์แนบ (เลือกใหม่เพื่อทับไฟล์เดิม)</label>
                <div class="mt-1 flex justify-center px-6 pt-8 pb-8 border-2 border-gray-300 border-dashed rounded-lg">
                    <div class="space-y-1 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true"><path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                        <div class="flex text-sm text-gray-600 justify-center">
                            <label for="uploadfile" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500">
                                <span>เลือกไฟล์ใหม่</span>
                                <input id="uploadfile" name="uploadfile" type="file" class="sr-only" @change="fileName = $event.target.files[0] ? $event.target.files[0].name : ''">
                            </label>
                        </div>
                        @if($announcement->uploadfile)
                            <p class="text-sm text-gray-500 pt-2">ไฟล์ปัจจุบัน: {{ $announcement->uploadfile }}</p>
                        @endif
                        <p x-show="fileName" class="text-sm text-green-600 font-semibold pt-2" x-text="`ไฟล์ใหม่ที่เลือก: ${fileName}`"></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end gap-3">
            <a href="{{ route('announcements.index') }}" class="px-6 py-3 bg-gray-200 text-gray-800 font-bold rounded-lg hover:bg-gray-300">ยกเลิก</a>
            <button type="submit" class="px-6 py-3 bg-blue-600 text-white font-bold rounded-lg shadow-md hover:bg-blue-700">บันทึกการเปลี่ยนแปลง</button>
        </div>
    </form>
</div>
@endsection

