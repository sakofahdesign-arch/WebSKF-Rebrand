@extends('layouts.admin-layout')

@section('title', 'เพิ่มผลการดำเนินงานประจำปี')

@section('header')
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                <i class="fas fa-plus-circle text-emerald-600"></i> เพิ่มผลการดำเนินงาน
            </h2>
            <nav class="flex text-sm text-gray-500 mt-1" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2">
                    <li class="inline-flex items-center">
                        <a href="{{ route('performance.index') }}" class="hover:text-emerald-600">ผลการดำเนินงาน</a>
                    </li>
                    <li><i class="fas fa-chevron-right text-xs"></i></li>
                    <li class="text-gray-400" aria-current="page">เพิ่มข้อมูลใหม่</li>
                </ol>
            </nav>
        </div>
    </div>
@endsection

@section('content')
    <div class="container mx-auto max-w-3xl">

        <div class="card bg-white shadow-lg border border-gray-100 overflow-hidden">
            <div class="h-2 bg-gradient-to-r from-emerald-500 to-teal-400"></div>

            <div class="p-8 md:p-10">
                <div class="text-center mb-8">
                    <div
                        class="w-16 h-16 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl shadow-sm">
                        <i class="fas fa-file-upload"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800">อัปโหลดเอกสารใหม่</h3>
                    <p class="text-gray-500 mt-1">กรุณากรอกข้อมูลและแนบไฟล์รายงานผลการดำเนินงาน</p>
                </div>

                <form action="{{ route('performance.upload') }}" method="post" enctype="multipart/form-data"
                    class="space-y-6">
                    @csrf

                    <div class="form-control w-full">
                        <label for="document_name" class="label">
                            <span class="label-text font-bold text-gray-700">ชื่อเอกสาร <span
                                    class="text-red-500">*</span></span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-heading text-gray-400"></i>
                            </div>
                            <input type="text" id="document_name" name="document_name"
                                class="input input-bordered w-full pl-10 focus:input-emerald-500 bg-gray-50 focus:bg-white transition-colors"
                                placeholder="เช่น รายงานประจำปี 2567" required>
                        </div>
                    </div>

                    <div class="form-control w-full" x-data="{ fileName: null, isDragging: false }">
                        <label class="label">
                            <span class="label-text font-bold text-gray-700">ไฟล์เอกสาร <span
                                    class="text-red-500">*</span></span>
                            <span class="label-text-alt text-gray-400">รองรับ PDF, DOC, XLSX</span>
                        </label>

                        <div class="relative group">
                            <label for="fileUpload"
                                class="flex flex-col items-center justify-center w-full h-48 border-2 border-dashed rounded-xl cursor-pointer transition-all duration-300 bg-gray-50 hover:bg-emerald-50/50"
                                :class="isDragging ? 'border-emerald-500 bg-emerald-50' :
                                    'border-gray-300 group-hover:border-emerald-400'"
                                @dragover.prevent="isDragging = true" @dragleave.prevent="isDragging = false"
                                @drop.prevent="isDragging = false; fileName = $event.dataTransfer.files[0].name; $refs.fileInput.files = $event.dataTransfer.files">

                                <div class="flex flex-col items-center justify-center pt-5 pb-6 text-center px-4">
                                    <div x-show="!fileName">
                                        <i
                                            class="fas fa-cloud-upload-alt text-4xl mb-3 text-gray-400 group-hover:text-emerald-500 transition-colors"></i>
                                        <p class="mb-2 text-sm text-gray-500"><span
                                                class="font-semibold text-emerald-600">คลิกเพื่อเลือกไฟล์</span>
                                            หรือลากไฟล์มาวางที่นี่</p>
                                        <p class="text-xs text-gray-400">ขนาดไฟล์ไม่เกิน 10MB</p>
                                    </div>

                                    <div x-show="fileName" style="display: none;" class="text-emerald-600">
                                        <i class="fas fa-check-circle text-4xl mb-3"></i>
                                        <p class="text-sm font-medium text-gray-900" x-text="fileName"></p>
                                        <p class="text-xs text-emerald-500 mt-1">พร้อมสำหรับอัปโหลด</p>
                                    </div>
                                </div>

                                <input id="fileUpload" x-ref="fileInput" name="documentFile" type="file" class="hidden"
                                    accept=".pdf,.doc,.docx,.xls,.xlsx"
                                    @change="fileName = $event.target.files[0] ? $event.target.files[0].name : null"
                                    required />
                            </label>
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-6 border-t border-gray-100 mt-8">
                        <a href="{{ url()->previous() }}" class="btn btn-ghost text-gray-500 hover:bg-gray-100">
                            ยกเลิก
                        </a>
                        <button type="submit"
                            class="btn bg-emerald-600 hover:bg-emerald-700 text-white border-none shadow-md gap-2 px-6">
                            <i class="fas fa-save"></i> บันทึกข้อมูล
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection

