@extends('layouts.admin-layout')

@section('title', 'เพิ่มสินทรัพย์ใหม่')

@section('content')
    <div class="p-4 md:p-8 bg-gray-100 min-h-screen">

        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">เพิ่มสินทรัพย์ใหม่</h1>
            <p class="text-gray-500 mt-1">กรอกข้อมูลและอัปโหลดรูปภาพสำหรับสินทรัพย์ใหม่</p>
        </div>

        <form action="{{ route('asset.store') }}" method="post" enctype="multipart/form-data"
            class="bg-white rounded-2xl shadow-xl p-6 md:p-8">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                <div class="space-y-6">
                    <div>
                        <label for="title" class="block mb-2 text-sm font-medium text-gray-700">หัวข้อสินทรัพย์</label>
                        <input type="text" id="title" name="title"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="เช่น บ้านเดี่ยวสไตล์โมเดิร์น" required>
                    </div>
                    <div>
                        <label for="description1" class="block mb-2 text-sm font-medium text-gray-700">รายละเอียด 1</label>
                        <textarea id="description1" name="description1" rows="3"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="เช่น ขนาดพื้นที่, จำนวนห้องนอน/ห้องน้ำ..." required></textarea>
                    </div>
                    <div>
                        <label for="description2" class="block mb-2 text-sm font-medium text-gray-700">รายละเอียด 2</label>
                        <textarea id="description2" name="description2" rows="3"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="เช่น สถานที่ใกล้เคียง, จุดเด่นเพิ่มเติม..." required></textarea>
                    </div>
                    <div>
                        <label for="contact" class="block mb-2 text-sm font-medium text-gray-700">ข้อมูลติดต่อ</label>
                        <input type="text" id="contact" name="contact"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="เช่น เบอร์โทร, Line ID" required>
                    </div>
                    <div>
                        <label for="asset_type" class="block mb-2 text-sm font-medium text-gray-700">ประเภทสินทรัพย์</label>
                        <select id="asset_type" name="asset_type"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            required>
                            <option value="" disabled selected>-- เลือกประเภท --</option>
                            <option value="1">บ้านพร้อมที่ดิน</option>
                            <option value="2">ที่ดินเปล่า</option>
                            <option value="3">คอนโด</option>
                        </select>
                    </div>
                </div>

                <div class="space-y-6">
                    <div x-data="{ coverPreview: null }">
                        <label class="block mb-2 text-sm font-medium text-gray-700">ภาพหน้าปก</label>
                        <div
                            class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                            <div class="space-y-1 text-center">
                                <template x-if="coverPreview">
                                    <img :src="coverPreview" class="mx-auto max-h-40 rounded-md shadow-sm">
                                </template>
                                <template x-if="!coverPreview">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                                        viewBox="0 0 48 48" aria-hidden="true">
                                        <path
                                            d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </template>
                                <div class="flex text-sm text-gray-600">
                                    <label for="coverImage"
                                        class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                        <span>อัปโหลดไฟล์</span>
                                        <input id="coverImage" name="coverImage" type="file" class="sr-only"
                                            @change="coverPreview = URL.createObjectURL($event.target.files[0])" required>
                                    </label>
                                    <p class="pl-1">หรือลากและวาง</p>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, GIF ไม่เกิน 10MB</p>
                            </div>
                        </div>
                    </div>

                    <div x-data="{ galleryPreviews: [] }">
                        <label class="block mb-2 text-sm font-medium text-gray-700">รูปภาพเพิ่มเติม
                            (เลือกได้หลายรูป)</label>
                        <div
                            class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                                    viewBox="0 0 48 48" aria-hidden="true">
                                    <path
                                        d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                                <div class="flex text-sm text-gray-600">
                                    <label for="galleryImages"
                                        class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500">
                                        <span>อัปโหลดไฟล์</span>
                                        <input id="galleryImages" name="Images[]" type="file" multiple class="sr-only"
                                            @change="galleryPreviews = Array.from($event.target.files).map(file => ({ url: URL.createObjectURL(file), name: file.name }))">
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4"
                            x-show="galleryPreviews.length > 0">
                            <template x-for="(file, index) in galleryPreviews" :key="index">
                                <div class="relative">
                                    <img :src="file.url" class="w-full h-24 object-cover rounded-lg shadow-md">
                                    <p x-text="file.name" class="text-xs text-center truncate mt-1"></p>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end gap-3">
                <button type="reset"
                    class="px-5 py-2.5 bg-gray-200 text-gray-700 font-semibold rounded-lg hover:bg-gray-300 transition-colors">
                    ยกเลิก
                </button>
                <button type="submit"
                    class="px-5 py-2.5 bg-green-600 text-white font-semibold rounded-lg shadow-md hover:bg-green-700 transition-colors">
                    <i class="fas fa-upload mr-2"></i> อัปโหลดสินทรัพย์
                </button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
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
