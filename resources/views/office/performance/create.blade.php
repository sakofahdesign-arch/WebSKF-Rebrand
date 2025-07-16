@extends('layouts.admin-layout')
@section('title', 'เพิ่มผลการดำเนินงานประจำปี')

@section('content')
<div class="p-4 md:p-8 bg-gray-100 min-h-screen">

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">เพิ่มผลการดำเนินงาน</h1>
        <p class="text-gray-500 mt-1">อัปโหลดเอกสารผลการดำเนินงานหรือรายงานประจำปี</p>
    </div>

    <form action="{{route('performance.upload')}}" method="post" enctype="multipart/form-data" class="bg-white rounded-2xl shadow-xl p-6 md:p-8 max-w-3xl mx-auto">
        @csrf

        <div class="space-y-6">
            <div>
                <label for="document_name" class="block mb-2 text-sm font-medium text-gray-700">ชื่อเอกสาร</label>
                <input type="text" id="document_name" name="document_name" 
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" 
                       placeholder="เช่น รายงานประจำปี 2567" required>
            </div>

            <div x-data="{ fileName: '' }">
                <label for="fileUpload" class="block mb-2 text-sm font-medium text-gray-700">ไฟล์เอกสาร</label>
                <div class="mt-1 flex justify-center px-6 pt-8 pb-8 border-2 border-gray-300 border-dashed rounded-md">
                    <div class="space-y-1 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                           <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m.75 12 3 3m0 0 3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                        </svg>
                        <div class="flex text-sm text-gray-600 justify-center">
                            <label for="fileUpload" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none">
                                <span>อัปโหลดไฟล์</span>
                                <input id="fileUpload" name="documentFile" type="file" class="sr-only" 
                                       accept=".pdf,.doc,.docx,.xls,.xlsx"
                                       @change="fileName = $event.target.files[0] ? $event.target.files[0].name : ''"
                                       required>
                            </label>
                        </div>
                        <p class="text-xs text-gray-500">PDF, DOC, XLSX</p>
                        
                        <p x-show="fileName" class="text-sm text-green-600 font-semibold pt-2" x-text="`ไฟล์ที่เลือก: ${fileName}`"></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end gap-3">
            <a href="{{ url()->previous() }}" class="px-5 py-2.5 bg-gray-200 text-gray-700 font-semibold rounded-lg hover:bg-gray-300 transition-colors">
                ยกเลิก
            </a>
            <button type="submit" class="px-5 py-2.5 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 transition-colors">
                <i class="fas fa-upload mr-2"></i>
                อัปโหลด
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

@if (session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'success',
                title: 'สำเร็จ!',
                text: "{{ session('success') }}",
                timer: 2500,
                showConfirmButton: false
            });
        });
    </script>
@endif
@endpush