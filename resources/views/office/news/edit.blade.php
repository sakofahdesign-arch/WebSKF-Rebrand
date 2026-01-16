@extends('layouts.admin-layout')

@section('title', 'แก้ไขข่าวสาร')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css" rel="stylesheet">
    <style>
        /* ปรับแต่ง Summernote ให้เข้ากับ Tailwind */
        .note-editor .note-toolbar {
            background-color: #f9fafb;
            border-bottom: 1px solid #e5e7eb;
        }
        .note-editor.note-frame {
            border-color: #d1d5db;
            border-radius: 0.5rem;
            box-shadow: none;
        }
        /* แก้ปัญหา List ใน Tailwind */
        .note-editable ul {
            list-style-type: disc !important;
            padding-left: 2rem !important;
            margin-bottom: 1rem;
        }
        .note-editable ol {
            list-style-type: decimal !important;
            padding-left: 2rem !important;
            margin-bottom: 1rem;
        }
        /* ปรับแต่ง Date Input Icon */
        input[type="date"]::-webkit-calendar-picker-indicator {
            cursor: pointer;
            filter: invert(42%) sepia(93%) saturate(1352%) hue-rotate(87deg) brightness(119%) contrast(119%);
        }
    </style>
@endpush

@section('header')
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                <i class="fas fa-edit text-emerald-600"></i> แก้ไขข่าวสาร
            </h2>
            <nav class="flex text-sm text-gray-500 mt-1" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2">
                    <li class="inline-flex items-center">
                        <a href="{{ route('news.index') }}" class="hover:text-emerald-600">จัดการข่าวสาร</a>
                    </li>
                    <li><i class="fas fa-chevron-right text-xs"></i></li>
                    <li class="text-gray-400" aria-current="page">แก้ไขข้อมูล</li>
                </ol>
            </nav>
        </div>
        
        <a href="{{ route('news.index') }}" 
           class="btn btn-outline text-gray-600 hover:bg-gray-100 hover:text-gray-800 border-gray-300 font-normal gap-2">
            <i class="fas fa-arrow-left"></i> กลับหน้ารายการ
        </a>
    </div>
@endsection

@section('content')
    <div class="container mx-auto max-w-5xl">

        <div class="card bg-white shadow-lg border border-gray-100 overflow-hidden">
            <div class="h-2 bg-gradient-to-r from-emerald-500 to-teal-400"></div>

            <div class="p-8">
                <form action="{{ route('news.update', $news->news_number) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">    
                        
                        <div class="form-control w-full md:col-span-2">
                            <label for="title" class="label">
                                <span class="label-text font-bold text-gray-700">หัวข้อข่าว <span class="text-red-500">*</span></span>
                            </label>
                            <input type="text" id="title" name="title" value="{{ old('title', $news->title) }}"
                                class="input input-bordered w-full focus:input-emerald-500 bg-gray-50 focus:bg-white transition-colors" 
                                required>
                        </div>

                        <div class="form-control w-full">
                            <label for="date" class="label">
                                <span class="label-text font-bold text-gray-700">วันที่ประกาศ <span class="text-red-500">*</span></span>
                            </label>
                            <div class="relative">
                                <input type="date" id="date" name="date" value="{{ old('date', $news->dateupload) }}"
                                    class="input input-bordered w-full focus:input-emerald-500 bg-gray-50 focus:bg-white transition-colors" 
                                    required>
                            </div>
                        </div>

                        <div class="form-control w-full">
                            <label for="news_type" class="label">
                                <span class="label-text font-bold text-gray-700">ประเภทข่าว <span class="text-red-500">*</span></span>
                            </label>
                            <select id="news_type" name="news_type" 
                                class="select select-bordered w-full focus:select-emerald-500 bg-gray-50 focus:bg-white transition-colors" 
                                required>
                                <option value="1" {{ $news->news_typeid == 1 ? 'selected' : '' }}>ประชาสัมพันธ์</option>
                                <option value="2" {{ $news->news_typeid == 2 ? 'selected' : '' }}>สวัสดิการ</option>
                                <option value="3" {{ $news->news_typeid == 3 ? 'selected' : '' }}>สินเชื่อฮาลาล</option>
                                <option value="4" {{ $news->news_typeid == 4 ? 'selected' : '' }}>มูลนิธิษะกอฟะฮ</option>
                            </select>
                        </div>

                        <div class="form-control w-full md:col-span-2">
                            <label for="summernote" class="label">
                                <span class="label-text font-bold text-gray-700">รายละเอียดเนื้อหา <span class="text-red-500">*</span></span>
                            </label>
                            <textarea id="summernote" name="description" required>{{ old('description', $news->description) }}</textarea>
                        </div>

                        <div class="form-control w-full md:col-span-1">
                            <label class="label">
                                <span class="label-text font-bold text-gray-700">ภาพหน้าปกปัจจุบัน</span>
                            </label>
                            <div class="border rounded-xl p-2 bg-gray-50 flex justify-center items-center h-48 overflow-hidden">
                                @if($news->picture_name)
                                    <img src="{{ asset('uploads/covers/' . $news->picture_name) }}" alt="Cover Image" class="object-cover h-full rounded-lg shadow-sm">
                                @else
                                    <div class="text-gray-400 text-sm">ไม่มีภาพปก</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-control w-full md:col-span-1" x-data="{ fileName: null }">
                            <label class="label">
                                <span class="label-text font-bold text-gray-700">เปลี่ยนภาพหน้าปก</span>
                                <span class="label-text-alt text-gray-400">อัปโหลดใหม่เพื่อแทนที่</span>
                            </label>
                            
                            <label class="flex flex-col items-center justify-center w-full h-48 border-2 border-dashed border-gray-300 rounded-xl cursor-pointer hover:bg-emerald-50 hover:border-emerald-400 transition-all bg-gray-50">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <div x-show="!fileName" class="text-center">
                                        <i class="far fa-image text-3xl text-gray-400 mb-2"></i>
                                        <p class="text-sm text-gray-500">คลิกเพื่ออัปโหลดภาพใหม่</p>
                                    </div>
                                    <div x-show="fileName" class="text-center px-2" style="display: none;">
                                        <i class="fas fa-check-circle text-emerald-500 text-3xl mb-2"></i>
                                        <p class="text-sm font-semibold text-gray-700 truncate max-w-[200px]" x-text="fileName"></p>
                                    </div>
                                </div>
                                <input type="file" name="coverImage" class="hidden" accept="image/*"
                                    @change="fileName = $event.target.files[0] ? $event.target.files[0].name : null" />
                            </label>
                        </div>

                        @if ($pictures->isNotEmpty())
                            <div class="form-control w-full md:col-span-2">
                                <label class="label">
                                    <span class="label-text font-bold text-gray-700">รูปภาพประกอบปัจจุบัน</span>
                                </label>
                                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 p-4 border rounded-xl bg-gray-50">
                                    @foreach ($pictures as $pic)
                                        <div class="relative group">
                                            <img src="{{ asset('uploads/galleries/' . $pic->picture_name) }}" alt="Gallery image" class="rounded-lg shadow-sm w-full h-24 object-cover border border-gray-200">
                                            {{-- <button type="button" class="absolute top-1 right-1 btn btn-xs btn-circle btn-error text-white opacity-0 group-hover:opacity-100 transition-opacity">
                                                <i class="fas fa-times"></i>
                                            </button> --}}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <div class="form-control w-full md:col-span-2" x-data="{ fileCount: 0 }">
                            <label class="label">
                                <span class="label-text font-bold text-gray-700">เพิ่มรูปภาพประกอบ (เลือกได้หลายรูป)</span>
                            </label>
                            
                            <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-gray-300 rounded-xl cursor-pointer hover:bg-blue-50 hover:border-blue-400 transition-all bg-gray-50">
                                <div class="flex flex-col items-center justify-center">
                                    <div x-show="fileCount === 0" class="text-center">
                                        <i class="fas fa-images text-2xl text-gray-400 mb-1"></i>
                                        <p class="text-sm text-gray-500">คลิกเพื่อเพิ่มรูปภาพแกลเลอรี</p>
                                    </div>
                                    <div x-show="fileCount > 0" class="text-center" style="display: none;">
                                        <div class="badge badge-info gap-2 mb-1">
                                            <i class="fas fa-layer-group"></i>
                                            <span x-text="fileCount"></span> ไฟล์
                                        </div>
                                        <p class="text-xs text-gray-500">ถูกเลือกแล้ว</p>
                                    </div>
                                </div>
                                <input type="file" name="uploadedFiles[]" class="hidden" accept="image/*" multiple
                                    @change="fileCount = $event.target.files.length" />
                            </label>
                        </div>

                    </div>

                    <div class="flex items-center justify-end gap-3 pt-6 border-t border-gray-100 mt-6">
                        <a href="{{ route('news.index') }}" class="btn btn-ghost text-gray-500 hover:bg-gray-100">
                            ยกเลิก
                        </a>
                        <button type="submit" class="btn bg-emerald-600 hover:bg-emerald-700 text-white border-none shadow-md gap-2 px-6">
                            <i class="fas fa-save"></i> บันทึกการเปลี่ยนแปลง
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{-- โหลด Scripts ตามลำดับ: jQuery -> Summernote -> Alpine --}}
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>
    {{-- <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script> --}}

    <script>
        $(document).ready(function () {
            $('#summernote').summernote({
                placeholder: 'เขียนรายละเอียดข่าวสารที่นี่...',
                tabsize: 2,
                height: 600,
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