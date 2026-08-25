@extends('layouts.admin-layout')

@section('title', 'แก้ไขสินทรัพย์')

@section('header')
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                <i class="fas fa-edit text-emerald-600"></i> แก้ไขข้อมูลสินทรัพย์
            </h2>
            <nav class="flex text-sm text-gray-500 mt-1" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2">
                    <li class="inline-flex items-center">
                        <a href="{{ route('asset.index') }}" class="hover:text-emerald-600">จัดการสินทรัพย์</a>
                    </li>
                    <li><i class="fas fa-chevron-right text-xs"></i></li>
                    <li class="text-gray-400" aria-current="page">แก้ไขข้อมูล</li>
                </ol>
            </nav>
        </div>
        
        <div class="badge badge-lg badge-outline gap-2 p-4 text-gray-500">
            ID: <span class="font-mono font-bold">{{ $asset->id }}</span>
        </div>
    </div>
@endsection

@section('content')
    <div class="container mx-auto max-w-4xl">

        <div class="card bg-white shadow-lg border border-gray-100 overflow-hidden">
            <div class="h-2 bg-gradient-to-r from-emerald-500 to-teal-400"></div>

            <div class="p-8 md:p-10">
                <div class="flex items-center gap-4 mb-8 pb-6 border-b border-gray-100">
                    <div class="w-14 h-14 bg-amber-100 text-amber-600 rounded-full flex items-center justify-center text-xl shadow-sm">
                        <i class="fas fa-pen"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-800">รายละเอียดสินทรัพย์</h3>
                        <p class="text-gray-500 text-sm mt-1">กำลังแก้ไข: <span class="text-emerald-600 font-semibold">{{ $asset->title }}</span></p>
                    </div>
                </div>

                <form action="{{ route('asset.update', $asset->id) }}" method="post" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        <div class="form-control w-full md:col-span-2">
                            <label for="title" class="label">
                                <span class="label-text font-bold text-gray-700">หัวข้อสินทรัพย์ <span class="text-red-500">*</span></span>
                            </label>
                            <input type="text" id="title" name="title" value="{{ old('title', $asset->title) }}"
                                class="input input-bordered w-full focus:input-emerald-500 bg-gray-50 focus:bg-white transition-colors" required>
                        </div>

                        <div class="form-control w-full">
                            <label for="asset_type" class="label">
                                <span class="label-text font-bold text-gray-700">ประเภทสินทรัพย์ <span class="text-red-500">*</span></span>
                            </label>
                            <select id="asset_type" name="asset_type"
                                class="select select-bordered w-full focus:select-emerald-500 bg-gray-50 focus:bg-white transition-colors" required>
                                <option value="1" @selected($asset->asset_type == 1)>บ้านพร้อมที่ดิน</option>
                                <option value="2" @selected($asset->asset_type == 2)>ที่ดินเปล่า</option>
                                <option value="3" @selected($asset->asset_type == 3)>คอนโด</option>
                            </select>
                        </div>

                        <div class="form-control w-full">
                            <label for="listing_type" class="label">
                                <span class="label-text font-bold text-gray-700">สถานะประกาศ <span class="text-red-500">*</span></span>
                            </label>
                            <select id="listing_type" name="listing_type"
                                class="select select-bordered w-full focus:select-emerald-500 bg-gray-50 focus:bg-white transition-colors" required>
                                <option value="sale" @selected(old('listing_type', $asset->listing_type ?? 'sale') === 'sale')>ขาย</option>
                                <option value="rent" @selected(old('listing_type', $asset->listing_type ?? 'sale') === 'rent')>เช่า</option>
                                <option value="inactive" @selected(old('listing_type', $asset->listing_type ?? 'sale') === 'inactive')>ไม่ขาย / ไม่แสดงบนหน้า GPS</option>
                            </select>
                            <p class="mt-1 text-xs text-gray-500">รายการที่เลือก “ไม่ขาย” จะไม่แสดงบนหน้าแผนที่ขายสินทรัพย์</p>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 md:col-span-2">
                            <div class="form-control w-full">
                                <label for="latitude" class="label">
                                    <span class="label-text font-bold text-gray-700">ละติจูด GPS <span class="text-red-500">*</span></span>
                                </label>
                                <input type="number" step="any" id="latitude" name="latitude"
                                    value="{{ old('latitude', $asset->latitude ?? '') }}"
                                    class="input input-bordered w-full focus:input-emerald-500 bg-gray-50 focus:bg-white transition-colors"
                                    placeholder="7.810533" required>
                            </div>

                            <div class="form-control w-full">
                                <label for="longitude" class="label">
                                    <span class="label-text font-bold text-gray-700">ลองจิจูด GPS <span class="text-red-500">*</span></span>
                                </label>
                                <input type="number" step="any" id="longitude" name="longitude"
                                    value="{{ old('longitude', $asset->longitude ?? '') }}"
                                    class="input input-bordered w-full focus:input-emerald-500 bg-gray-50 focus:bg-white transition-colors"
                                    placeholder="99.090014" required>
                            </div>
                        </div>

                        <div class="form-control w-full">
                            <label for="contact" class="label">
                                <span class="label-text font-bold text-gray-700">ข้อมูลติดต่อ <span class="text-red-500">*</span></span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-phone-alt text-gray-400"></i>
                                </div>
                                <input type="text" id="contact" name="contact" value="{{ old('contact', $asset->contact) }}"
                                    class="input input-bordered w-full pl-10 focus:input-emerald-500 bg-gray-50 focus:bg-white transition-colors" required>
                            </div>
                        </div>

                        <div class="form-control w-full">
                            <label for="description1" class="label">
                                <span class="label-text font-bold text-gray-700">รายละเอียดหลัก <span class="text-red-500">*</span></span>
                            </label>
                            <textarea id="description1" name="description1" rows="4"
                                class="textarea textarea-bordered w-full focus:textarea-emerald-500 bg-gray-50 focus:bg-white transition-colors" required>{{ old('description1', $asset->description1) }}</textarea>
                        </div>

                        <div class="form-control w-full">
                            <label for="description2" class="label">
                                <span class="label-text font-bold text-gray-700">รายละเอียดเพิ่มเติม <span class="text-red-500">*</span></span>
                            </label>
                            <textarea id="description2" name="description2" rows="4"
                                class="textarea textarea-bordered w-full focus:textarea-emerald-500 bg-gray-50 focus:bg-white transition-colors" required>{{ old('description2', $asset->description2) }}</textarea>
                        </div>

                    </div>

                    <div class="rounded-xl border border-emerald-100 bg-emerald-50/50 p-5">
                        <label for="deedFile" class="block text-sm font-bold text-gray-700">
                            ไฟล์โฉนดที่ดิน / เอกสารแนบ
                        </label>
                        @if (!empty($asset->deed_file))
                            <a href="{{ asset('assets/deeds/' . $asset->deed_file) }}" target="_blank"
                                class="mt-2 inline-flex items-center gap-2 text-sm font-semibold text-emerald-700 hover:text-emerald-900">
                                <i class="fas fa-file-contract"></i> เปิดไฟล์แนบปัจจุบัน
                            </a>
                        @endif
                        <input id="deedFile" name="deedFile" type="file" accept=".pdf,image/*"
                            class="file-input file-input-bordered w-full mt-3 bg-white">
                        <p class="mt-2 text-xs text-gray-500">เลือกไฟล์ใหม่เฉพาะเมื่อต้องการเปลี่ยนเอกสาร</p>
                    </div>

                    <div class="flex flex-col-reverse sm:flex-row justify-between items-center gap-4 pt-8 border-t border-gray-100 mt-8">
                        <button type="button" form="delete-asset-form" onclick="if (confirm('คุณแน่ใจหรือไม่ที่จะลบสินทรัพย์นี้? การกระทำนี้จะลบรูปภาพทั้งหมดและไม่สามารถกู้คืนได้!')) document.getElementById('delete-asset-form').submit();"
                            class="btn btn-outline btn-error w-full sm:w-auto gap-2 hover:bg-red-50">
                            <i class="fas fa-trash-alt"></i> ลบสินทรัพย์นี้
                        </button>

                        <div class="flex gap-3 w-full sm:w-auto justify-end">
                            <a href="{{ route('asset.index') }}" class="btn btn-ghost text-gray-500 hover:bg-gray-100 w-full sm:w-auto">
                                ยกเลิก
                            </a>
                            <button type="submit" class="btn bg-emerald-600 hover:bg-emerald-700 text-white border-none shadow-md gap-2 px-6 w-full sm:w-auto">
                                <i class="fas fa-save"></i> บันทึกการเปลี่ยนแปลง
                            </button>
                        </div>
                    </div>
                </form>
                <form id="delete-asset-form" action="{{ route('asset.destroy', $asset->id) }}" method="POST" class="hidden">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </div>
    </div>
@endsection
