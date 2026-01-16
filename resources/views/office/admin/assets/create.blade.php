@extends('layouts.admin-layout')

@section('title', 'เพิ่มสินทรัพย์ใหม่')

@section('header')
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                <i class="fas fa-plus-circle text-emerald-600"></i> เพิ่มสินทรัพย์ใหม่
            </h2>
            <nav class="flex text-sm text-gray-500 mt-1" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2">
                    <li class="inline-flex items-center">
                        <a href="{{ route('asset.index') }}" class="hover:text-emerald-600">จัดการสินทรัพย์</a>
                    </li>
                    <li><i class="fas fa-chevron-right text-xs"></i></li>
                    <li class="text-gray-400" aria-current="page">เพิ่มข้อมูล</li>
                </ol>
            </nav>
        </div>
    </div>
@endsection

@section('content')
    <div class="container mx-auto max-w-5xl">

        <div class="card bg-white shadow-lg border border-gray-100 overflow-hidden">
            <div class="h-2 bg-gradient-to-r from-emerald-500 to-teal-400"></div>

            <div class="p-8 md:p-10">
                <div class="text-center mb-10">
                    <div class="w-16 h-16 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl shadow-sm">
                        <i class="fas fa-home"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800">ข้อมูลสินทรัพย์</h3>
                    <p class="text-gray-500 mt-1">กรุณากรอกรายละเอียดและอัปโหลดรูปภาพให้ครบถ้วน</p>
                </div>

                <form action="{{ route('asset.store') }}" method="post" enctype="multipart/form-data" class="space-y-8">
                    @csrf

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">

                        <div class="space-y-6">
                            <div class="form-control w-full">
                                <label for="title" class="label">
                                    <span class="label-text font-bold text-gray-700">หัวข้อสินทรัพย์ <span class="text-red-500">*</span></span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-heading text-gray-400"></i>
                                    </div>
                                    <input type="text" id="title" name="title"
                                        class="input input-bordered w-full pl-10 focus:input-emerald-500 bg-gray-50 focus:bg-white transition-colors"
                                        placeholder="เช่น บ้านเดี่ยวสไตล์โมเดิร์น" required>
                                </div>
                            </div>

                            <div class="form-control w-full">
                                <label for="description1" class="label">
                                    <span class="label-text font-bold text-gray-700">รายละเอียดหลัก <span class="text-red-500">*</span></span>
                                </label>
                                <textarea id="description1" name="description1" rows="3"
                                    class="textarea textarea-bordered w-full focus:textarea-emerald-500 bg-gray-50 focus:bg-white transition-colors"
                                    placeholder="เช่น ขนาดพื้นที่, จำนวนห้องนอน/ห้องน้ำ..." required></textarea>
                            </div>

                            <div class="form-control w-full">
                                <label for="description2" class="label">
                                    <span class="label-text font-bold text-gray-700">รายละเอียดเพิ่มเติม <span class="text-red-500">*</span></span>
                                </label>
                                <textarea id="description2" name="description2" rows="3"
                                    class="textarea textarea-bordered w-full focus:textarea-emerald-500 bg-gray-50 focus:bg-white transition-colors"
                                    placeholder="เช่น สถานที่ใกล้เคียง, จุดเด่นเพิ่มเติม..." required></textarea>
                            </div>

                            <div class="form-control w-full">
                                <label for="contact" class="label">
                                    <span class="label-text font-bold text-gray-700">ข้อมูลติดต่อ <span class="text-red-500">*</span></span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-phone-alt text-gray-400"></i>
                                    </div>
                                    <input type="text" id="contact" name="contact"
                                        class="input input-bordered w-full pl-10 focus:input-emerald-500 bg-gray-50 focus:bg-white transition-colors"
                                        placeholder="เช่น เบอร์โทร, Line ID" required>
                                </div>
                            </div>

                            <div class="form-control w-full">
                                <label for="asset_type" class="label">
                                    <span class="label-text font-bold text-gray-700">ประเภทสินทรัพย์ <span class="text-red-500">*</span></span>
                                </label>
                                <select id="asset_type" name="asset_type"
                                    class="select select-bordered w-full focus:select-emerald-500 bg-gray-50 focus:bg-white transition-colors"
                                    required>
                                    <option value="" disabled selected>-- เลือกประเภท --</option>
                                    <option value="1">บ้านพร้อมที่ดิน</option>
                                    <option value="2">ที่ดินเปล่า</option>
                                    <option value="3">คอนโด</option>
                                </select>
                            </div>
                        </div>

                        <div class="space-y-6">
                            
                            <div class="form-control w-full" x-data="{ coverPreview: null }">
                                <label class="label">
                                    <span class="label-text font-bold text-gray-700">ภาพหน้าปก <span class="text-red-500">*</span></span>
                                    <span class="label-text-alt text-gray-400">ภาพหลัก (1 รูป)</span>
                                </label>
                                
                                <label class="flex flex-col items-center justify-center w-full h-56 border-2 border-dashed border-gray-300 rounded-xl cursor-pointer hover:bg-emerald-50 hover:border-emerald-400 transition-all bg-gray-50 relative overflow-hidden group">
                                    
                                    <div x-show="coverPreview" class="absolute inset-0 w-full h-full flex items-center justify-center bg-gray-100">
                                        <img :src="coverPreview" class="w-full h-full object-cover">
                                        <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                            <p class="text-white font-medium"><i class="fas fa-edit mr-2"></i>เปลี่ยนรูปภาพ</p>
                                        </div>
                                    </div>

                                    <div x-show="!coverPreview" class="flex flex-col items-center justify-center pt-5 pb-6 text-center px-4">
                                        <i class="far fa-image text-4xl text-gray-400 mb-3 group-hover:text-emerald-500 transition-colors"></i>
                                        <p class="mb-1 text-sm text-gray-500"><span class="font-semibold text-emerald-600">คลิกเพื่ออัปโหลด</span> หรือลากไฟล์มาวาง</p>
                                        <p class="text-xs text-gray-400">PNG, JPG, GIF (Max 10MB)</p>
                                    </div>

                                    <input id="coverImage" name="coverImage" type="file" class="hidden" accept="image/*"
                                        @change="coverPreview = URL.createObjectURL($event.target.files[0])" required>
                                </label>
                            </div>

                            <div class="form-control w-full" x-data="{ fileCount: 0 }">
                                <label class="label">
                                    <span class="label-text font-bold text-gray-700">รูปภาพเพิ่มเติม</span>
                                    <span class="label-text-alt text-gray-400">เลือกได้หลายรูป</span>
                                </label>
                                
                                <label class="flex flex-col items-center justify-center w-full h-40 border-2 border-dashed border-gray-300 rounded-xl cursor-pointer hover:bg-blue-50 hover:border-blue-400 transition-all bg-gray-50">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6 text-center">
                                        
                                        <div x-show="fileCount === 0">
                                            <i class="fas fa-images text-3xl text-gray-400 mb-3 group-hover:text-blue-500 transition-colors"></i>
                                            <p class="text-sm text-gray-500">เพิ่มรูปภาพแกลเลอรี</p>
                                        </div>

                                        <div x-show="fileCount > 0" style="display: none;">
                                            <div class="badge badge-lg badge-info gap-2 p-4 mb-2">
                                                <i class="fas fa-check-circle"></i>
                                                เลือกแล้ว <span x-text="fileCount" class="font-bold"></span> ไฟล์
                                            </div>
                                            <p class="text-xs text-gray-500">คลิกเพื่อเลือกใหม่</p>
                                        </div>

                                    </div>
                                    <input id="galleryImages" name="Images[]" type="file" multiple class="hidden" accept="image/*"
                                        @change="fileCount = $event.target.files.length">
                                </label>
                            </div>

                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-8 border-t border-gray-100">
                        <a href="{{ route('asset.index') }}" class="btn btn-ghost text-gray-500 hover:bg-gray-100">
                            ยกเลิก
                        </a>
                        <button type="submit" class="btn bg-emerald-600 hover:bg-emerald-700 text-white border-none shadow-md gap-2 px-8">
                            <i class="fas fa-save"></i> บันทึกข้อมูล
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
