@extends('layouts.layout')
@section('title', 'ปฏิทินสหกรณ์')
@push('styles')
    {{-- Fancybox for image lightbox --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
@endpush

@section('content')
<div class="bg-gray-50">
    <div class="container mx-auto px-4 py-16">
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-green-600 to-teal-500 mb-4">
                ปฏิทินกิจกรรม 2568
            </h1>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                ติดตามวันหยุดและกิจกรรมสำคัญของสหกรณ์ฯ ตลอดทั้งปี
            </p>
        </div>
        
        <div class="mb-12">
             <img src="{{ asset('images/calendar/ปกโปสเตอร์.jpg') }}" class="w-full rounded-2xl shadow-xl object-cover h-auto" alt="ปฏิทินสหกรณ์">
        </div>

        <div x-data="{ activeTab: '{{ strtolower($months[$currentMonth ?? array_key_first($months)]) }}' }" class="grid grid-cols-1 md:grid-cols-4 gap-8">
            
            <div class="md:col-span-1">
                <div class="flex flex-col space-y-2">
                    @foreach ($months as $month)
                        <button @click="activeTab = '{{ strtolower($month) }}'" class="w-full text-lg font-bold p-3 rounded-lg transition-all duration-300 transform":class="{'bg-green-600 text-white shadow-lg scale-105': activeTab === '{{ strtolower($month) }}','bg-white text-gray-700 hover:bg-green-100 hover:shadow-md': activeTab !== '{{ strtolower($month) }}'}">
                            {{ $month }}
                        </button>
                    @endforeach
                </div>
            </div>

            <div class="md:col-span-3">
                <div class="relative bg-white rounded-2xl shadow-xl p-6 min-h-[400px]">
                    @foreach ($months as $month)
                        <div x-show="activeTab === '{{ strtolower($month) }}'" 
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 -translate-y-4"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             style="display: none;">
                            
                            <h3 class="text-center text-green-700 font-bold text-3xl mb-6">{{ $month }} 2568</h3>
                            
                            <a href="{{ url('images/calendar/' . $month . '.jpg') }}" data-fancybox="gallery" data-caption="{{ $month }} 2568">
                                <img src="{{ url('images/calendar/' . $month . '.jpg') }}" class="w-full rounded-lg shadow-lg object-cover h-auto cursor-pointer hover:shadow-2xl transition-shadow" alt="ปฏิทินเดือน{{ $month }}">
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        Fancybox.bind("[data-fancybox]", {
        });
      });
    </script>
@endpush