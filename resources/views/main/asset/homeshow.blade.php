@extends('layouts.layout') {{-- Use the main layout --}}

@section('title', $detail->title ?? 'รายละเอียดบ้าน') {{-- Page title --}}
@push('styles')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
@endpush
@section('content')


    <div class="container mx-auto px-4 py-12">
        <h1 class="text-4xl font-extrabold text-center text-blue-700 mb-10">รายละเอียดบ้านพร้อมที่ดิน/ทาวน์โฮม</h1>

        <div class="flex flex-col lg:flex-row items-center lg:items-start gap-8">
            {{-- Image Gallery Section --}}
            <div class="w-full lg:w-7/12">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach ($image as $item_image)
                        <div class="relative overflow-hidden rounded-lg shadow-md border border-gray-200">
                            <a data-fancybox="gallery" href="{{ asset('assets/' . $item_image->picture_name) }}">
                                <img class="w-full h-72 object-cover transition-transform duration-300 hover:scale-105" src="{{ asset('assets/' . $item_image->picture_name) }}" alt="{{ $detail->title ?? 'รูปภาพสินทรัพย์' }}" />
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Details Section --}}
            <div
                class="w-full lg:w-5/12 text-center lg:text-left p-6 bg-white rounded-lg shadow-lg border-t-4 border-green-500">
                <h2 class="text-3xl font-bold text-green-700 mb-4">{{ $detail->title ?? 'ไม่พบชื่อสินทรัพย์' }}</h2>
                <p class="text-gray-600 text-sm mb-6">
                    ประกาศเมื่อ: {{ thaidate('l j F Y', $detail->date) ?? 'ไม่พบวันที่ประกาศ' }}
                </p>

                <div class="text-lg text-gray-700 leading-relaxed mb-6 space-y-4">
                    <p>
                        {{ $detail->description1 ?? 'ไม่มีข้อมูลรายละเอียดส่วนที่ 1' }}
                    </p>
                    <p>
                        {{ $detail->description2 ?? 'ไม่มีข้อมูลรายละเอียดส่วนที่ 2' }}
                    </p>
                </div>

                <h3 class="text-xl font-bold text-blue-700 mb-3">ติดต่อสอบถาม</h3>
                <p class="text-lg text-gray-800 leading-relaxed mb-6">
                    {{ $detail->contact ?? 'ไม่พบข้อมูลติดต่อ' }}
                </p>

                <div class="mt-8 text-center lg:text-left">
                    <a href="/homeList"
                        class="inline-flex items-center bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-6 rounded-full transition duration-300">
                        <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="[http://www.w3.org/2000/svg](http://www.w3.org/2000/svg)">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z"></path>
                        </svg>
                        กลับสู่รายการบ้าน
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $("[data-fancybox]").fancybox({});
        });
    </script>
@endpush
