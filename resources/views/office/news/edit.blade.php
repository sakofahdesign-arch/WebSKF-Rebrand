@extends('layouts.admin-layout')

@section('title', 'แก้ไขข่าวสาร')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css" rel="stylesheet">

    <style>
        .note-editable ul {
            list-style-type: disc;
            padding-left: 1.5rem;
        }

        .note-editable ol {
            list-style-type: decimal;
            padding-left: 1.5rem;
        }

        .note-editable li {
            margin-bottom: 0.25rem;
        }
    </style>
@endpush


@section('content')
    <div class="container mx-auto">

        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row justify-between items-center mb-6">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800">
                แก้ไขข่าวสาร
            </h1>
            <a href="{{ route('news.index') }}"
                class="mt-4 sm:mt-0 inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 font-bold rounded-lg hover:bg-gray-300 transition duration-300">
                <i class="fas fa-arrow-left mr-2"></i>
                กลับไปหน้ารายการ
            </a>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-lg">
            <form action="{{ route('news.update', $news->news_number) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') 
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">    
                    <div class="md:col-span-2">
                        <label for="title" class="block text-sm font-medium text-gray-700">หัวข้อข่าว <span
                                class="text-red-500">*</span></label>
                        <input type="text" id="title" name="title" value="{{ old('title', $news->title) }}"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md focus:ring-green-500 focus:border-green-500"
                            required>
                    </div>
                    <div>
                        <label for="date" class="block text-sm font-medium text-gray-700">วันที่ประกาศ <span
                                class="text-red-500">*</span></label>
                        <input type="date" id="date" name="date" value="{{ old('date', $news->dateupload) }}"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md focus:ring-green-500 focus:border-green-500"
                            required>
                    </div>
                    <div>
                        <label for="news_type" class="block text-sm font-medium text-gray-700">ประเภทข่าว <span
                                class="text-red-500">*</span></label>
                        <select id="news_type" name="news_type" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500" required>
                            <option value="1" {{ $news->news_typeid == 1 ? 'selected' : '' }}>ประชาสัมพันธ์</option>
                            <option value="2" {{ $news->news_typeid == 2 ? 'selected' : '' }}>สวัสดิการ</option>
                            <option value="3" {{ $news->news_typeid == 3 ? 'selected' : '' }}>สินเชื่อฮาลาล</option>
                            <option value="4" {{ $news->news_typeid == 4 ? 'selected' : '' }}>มูลนิธิษะกอฟะฮ</option>
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <label for="summernote" class="block text-sm font-medium text-gray-700">รายละเอียด <span
                                class="text-red-500">*</span></label>
                        <textarea id="summernote" name="description" required>{{ old('description', $news->description) }}</textarea>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">ภาพหน้าปกปัจจุบัน</label>
                        <img src="{{ asset('uploads/covers/' . $news->picture_name) }}" alt="Cover Image" class="mt-2 rounded-lg shadow-md max-h-48" loading="lazy">
                    </div>

                    <div class="md:col-span-2">
                        <label for="coverImage" class="block text-sm font-medium text-gray-700">เปลี่ยนภาพหน้าปก
                            (เลือกไฟล์ใหม่หากต้องการเปลี่ยน)</label>
                        <input id="coverImage" name="coverImage" type="file" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100" accept="image/*">
                    </div>

                    @if ($pictures->isNotEmpty())
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">รูปภาพประกอบปัจจุบัน</label>
                            <div class="mt-2 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                                @foreach ($pictures as $pic)
                                    <div class="relative">
                                        <img src="{{ asset('uploads/galleries/' . $pic->picture_name) }}" alt="Gallery image" class="rounded-lg shadow-md w-full h-24 object-cover" loading="lazy">                                     
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="md:col-span-2">
                        <label for="uploadedFiles" class="block text-sm font-medium text-gray-700">เพิ่มรูปภาพประกอบ(เลือกได้หลายรูป)</label>
                        <input id="uploadedFiles" name="uploadedFiles[]" type="file" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" accept="image/*" multiple>
                    </div>

                </div>

                <div class="mt-6 pt-6 border-t border-gray-200 flex items-center justify-end gap-4">
                    <a href="{{ route('news.index') }}" class="bg-gray-200 text-gray-700 font-bold py-2 px-4 rounded-lg hover:bg-gray-300 transition duration-300">
                        ยกเลิก
                    </a>
                    <button type="submit" class="bg-green-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-green-700 transition duration-300">
                        <i class="fas fa-save mr-2"></i>
                        บันทึกการเปลี่ยนแปลง
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#summernote').summernote({
                placeholder: 'ใส่รายละเอียดข่าวสารที่นี่...',
                tabsize: 2,
                height: 300,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
        });
    </script>
@endpush

