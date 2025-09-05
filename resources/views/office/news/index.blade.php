@extends('layouts.admin-layout')

@section('title', 'Admin รายการข่าวสาร')



@section('content')
    <div class="container mx-auto">

        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row justify-between items-center mb-6">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800">
                จัดการข่าวสารและประกาศ
            </h1>
            <a href="{{route('news.create')}}"
                class="mt-4 sm:mt-0 inline-flex items-center px-4 py-2 bg-green-600 text-white font-bold rounded-lg hover:bg-green-700 transition duration-300">
                <i class="fas fa-plus mr-2"></i>
                เพิ่มข่าวสาร
            </a>
        </div>

        <!-- News Table Card -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="p-6 border-b">
                <h3 class="text-xl font-semibold text-gray-800">รายการข่าวสารทั้งหมด</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="p-4 font-semibold text-gray-600 uppercase tracking-wider text-left">หัวข้อ</th>
                            <th class="p-4 font-semibold text-gray-600 uppercase tracking-wider text-center">ประเภทข่าว</th>
                            <th class="p-4 font-semibold text-gray-600 uppercase tracking-wider text-center">วันที่อัปโหลด
                            </th>
                            <th class="p-4 font-semibold text-gray-600 uppercase tracking-wider text-center">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $item)
                            <tr class="border-t hover:bg-gray-50">
                                <td class="p-4 text-left text-gray-800 font-medium">
                                    {{ $item->title }}
                                </td>
                                <td class="p-4 text-center text-gray-600">
                                    {{-- Assuming news_typename exists on the item object --}}
                                    {{ $item->news_typename ?? 'ทั่วไป' }}
                                </td>
                                <td class="p-4 text-center text-gray-600 whitespace-nowrap">
                                    {{ $item->dateupload ? thaidate('j M Y', strtotime($item->dateupload)) : '-' }}
                                </td>
                                <td class="p-4 text-center">
                                    <div class="flex justify-center items-center gap-2">
                                        <a href="{{route('news.edit', $item->news_number)}}"
                                            class="inline-flex items-center justify-center w-10 h-10 bg-yellow-400 text-white rounded-md hover:bg-yellow-500 transition-colors duration-200"
                                            aria-label="แก้ไข">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        <form action="{{ route('news.destroy', $item->news_number) }}" method="POST" onsubmit="return confirm('คุณแน่ใจหรือว่าต้องการลบข่าวนี้?');" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center justify-center w-10 h-10 bg-red-500 text-white rounded-md hover:bg-red-600 transition-colors duration-200" aria-label="ลบ">
                                                <i class="far fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-10 text-gray-500">
                                    <i class="fas fa-inbox fa-2x mb-2 text-gray-400"></i>
                                    <p>ไม่พบข้อมูลข่าวสาร</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if(isset($data) && $data->hasPages())
                <div class="p-4 bg-gray-50 border-t">
                    {{ $data->links('pagination::tailwind') }}
                </div>
            @endif
        </div>
    </div>
@endsection

