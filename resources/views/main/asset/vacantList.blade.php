@extends('layouts.layout') {{-- Use the main layout --}}

@section('title', 'บ้านพร้อมที่ดิน/ทาวน์โฮม') {{-- Page title --}}

@section('content')
    <div class="container mx-auto px-4 py-12">
        <h1 class="text-4xl font-extrabold text-center text-blue-700 mb-10">ที่ดินเปล่า</h1>

        @if ($asset->isEmpty())
            <p class="text-center text-gray-500 text-xl p-8 bg-white rounded-lg shadow-lg">
                ไม่พบรายการที่ดินเปล่าในขณะนี้
            </p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @foreach ($asset as $item)
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden border border-gray-200">
                        <a href="vacant/{{$item->id}}" class="block">
                            <img src="{{ asset('assets/' . $item->picture_name) }}" alt="{{ $item->title ?? 'รูปภาพบ้าน' }}" class="w-full h-48 object-cover" loading="lazy"/>
                            <div class="p-4">
                                <h3 class="text-xl font-bold text-gray-800 mb-2 truncate">{{ $item->title }}</h3> 
                                <p class="text-gray-700 leading-relaxed text-sm mb-2">
                                    {{ Str::limit($item->title ?? 'ไม่มีรายละเอียด', 100) }}
                                </p>
                                <p class="text-gray-500 text-xs mt-auto"> 
                                    <small>{{ thaidate('j F Y',$item->date)  }}</small>
                                </p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

            {{-- Pagination Links --}}
            <div class="mt-12 flex justify-center">
                {{ $asset->links('pagination::tailwind') }} {{-- Use Tailwind CSS pagination theme --}}
            </div>
        @endif
    </div>
@endsection
