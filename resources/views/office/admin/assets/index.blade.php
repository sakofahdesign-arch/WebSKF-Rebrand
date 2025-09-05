@extends('layouts.admin-layout')

@section('title', 'Admin จัดการสินทรัพย์')
@section('content')
    <div class="p-4 md:p-8 bg-gray-100 min-h-screen">

        <div class="flex flex-col md:flex-row justify-between items-center mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">จัดการสินทรัพย์</h1>
                <p class="text-gray-500 mt-1">ดูแลและจัดการข้อมูลสินทรัพย์ทั้งหมดในระบบ</p>
            </div>
            <a href="{{ route('asset.create') }}"
                class="w-full md:w-auto mt-4 md:mt-0 px-5 py-2.5 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 transition-colors flex items-center justify-center">
                <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                เพิ่มสินทรัพย์ใหม่
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-xl border border-gray-200/80">
            <div class="p-4 border-b border-gray-200">
                <form action="{{ route('asset.index') }}" method="GET">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                            </svg>
                        </div>
                        <input name="search" type="text" value="{{ request('search') }}"
                            placeholder="ค้นหาจากชื่อ หรือ ประเภท..."
                            class="w-full md:w-1/3 pl-10 px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </form>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-600">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                        <tr>
                            <th scope="col" class="px-6 py-4">ID</th>
                            <th scope="col" class="px-6 py-4">ภาพปก</th>
                            <th scope="col" class="px-6 py-4">หัวข้อ / ประเภท</th>
                            <th scope="col" class="px-6 py-4">รายละเอียด</th>
                            <th scope="col" class="px-6 py-4">วันที่</th>
                            <th scope="col" class="px-6 py-4">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($assets as $item)
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td class="px-6 py-4 font-semibold">{{ $item->id }}</td>
                                <td class="px-6 py-4">
                                    @if($item->picture_name)
                                        <img src="{{ asset('assets/' . $item->picture_name) }}"
                                            class="w-24 h-16 object-cover rounded-md shadow-sm" alt="{{ $item->title }}" loading="lazy">
                                    @else
                                        <div
                                            class="w-24 h-16 bg-gray-200 rounded-md flex items-center justify-center text-xs text-gray-400">
                                            No Image</div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="font-semibold text-gray-900">{{ $item->title }}</div>
                                    <span
                                        class="px-2 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full">{{ $item->asset_name ?? 'N/A' }}</span>
                                </td>
                                <td class="px-6 py-4 max-w-xs truncate">{{ Str::limit($item->description1, 80) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ thaidate('j M Y', strtotime($item->date)) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-4">
                                        <a href="{{ route('asset.edit', $item->id) }}"
                                            class="font-medium text-blue-600 hover:underline">แก้ไข</a>
                                        <form action="{{ route('asset.destroy', $item->id) }}" method="POST"
                                            onsubmit="return confirm('คุณแน่ใจหรือไม่ที่จะลบสินทรัพย์นี้และรูปภาพทั้งหมด?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="font-medium text-red-600 hover:underline">ลบ</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-16 text-gray-500">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                                    </svg>
                                    <h3 class="mt-2 text-lg font-medium text-gray-800">ไม่พบข้อมูลสินทรัพย์</h3>
                                    <p class="mt-1 text-sm">ลองค้นหาด้วยคำอื่น หรือเพิ่มสินทรัพย์ใหม่</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($assets->hasPages())
                <div class="p-4 bg-white border-t">
                    {{ $assets->appends(request()->input())->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection

