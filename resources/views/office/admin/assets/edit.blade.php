@extends('layouts.admin-layout')
@section('title', 'แก้ไขสินทรัพย์')

@section('content')
<div class="p-4 md:p-8 bg-gray-100 min-h-screen">
    
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">แก้ไขสินทรัพย์ (ID: {{ $asset->id }})</h1>
        <p class="text-gray-500 mt-1">คุณกำลังแก้ไขข้อมูลของ: <span class="font-semibold">{{ $asset->title }}</span></p>
    </div>

    <form action="{{ route('asset.update', $asset->id) }}" method="post" class="bg-white rounded-2xl shadow-xl p-6 md:p-8">
        @csrf
        @method('PUT')
        <div class="space-y-6">
            <div>
                <label for="title" class="block mb-2 text-sm font-medium text-gray-700">หัวข้อสินทรัพย์</label>
                <input type="text" id="title" name="title" value="{{ old('title', $asset->title) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
            </div>
            <div>
                <label for="description1" class="block mb-2 text-sm font-medium text-gray-700">รายละเอียด 1</label>
                <textarea id="description1" name="description1" rows="3" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>{{ old('description1', $asset->description1) }}</textarea>
            </div>
             <div>
                <label for="description2" class="block mb-2 text-sm font-medium text-gray-700">รายละเอียด 2</label>
                <textarea id="description2" name="description2" rows="3" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>{{ old('description2', $asset->description2) }}</textarea>
            </div>
            <div>
                <label for="contact" class="block mb-2 text-sm font-medium text-gray-700">ข้อมูลติดต่อ</label>
                <input type="text" id="contact" name="contact" value="{{ old('contact', $asset->contact) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
            </div>
            <div>
                <label for="asset_type" class="block mb-2 text-sm font-medium text-gray-700">ประเภทสินทรัพย์</label>
                <select id="asset_type" name="asset_type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                    <option value="1" @if($asset->asset_type == 1) selected @endif>บ้านพร้อมที่ดิน</option>
                    <option value="2" @if($asset->asset_type == 2) selected @endif>ที่ดินเปล่า</option>
                    <option value="3" @if($asset->asset_type == 3) selected @endif>คอนโด</option>
                </select>
            </div>
        </div>

        <div class="mt-8 pt-6 border-t border-gray-200 flex justify-between items-center">
            <a href="{{ route('asset.destroy', $asset->id) }}" onclick="return confirm('คุณแน่ใจหรือไม่ที่จะลบสินทรัพย์นี้? การกระทำนี้จะลบรูปภาพทั้งหมดและไม่สามารถกู้คืนได้!')"
               class="px-5 py-2.5 bg-red-600 text-white font-semibold rounded-lg shadow-md hover:bg-red-700 transition-colors">
                <i class="fas fa-trash mr-2"></i>
                ลบสินทรัพย์นี้
            </a>
            <div class="flex gap-3">
                 <a href="{{route('asset.index')}}" class="px-5 py-2.5 bg-gray-200 text-gray-700 font-semibold rounded-lg hover:bg-gray-300 transition-colors">
                    ยกเลิก
                </a>
                <button type="submit" class="px-5 py-2.5 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 transition-colors">
                    บันทึกการเปลี่ยนแปลง
                </button>
            </div>
        </div>
    </form>
</div>
@endsection

