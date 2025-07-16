@extends('layouts.layout')
@section('title', 'บริการเงินฝาก')

@section('content')
<div class="bg-gray-50" x-data="{ loaded: false }" x-init="() => { setTimeout(() => loaded = true, 50) }">
    <div class="container mx-auto px-4 py-16">

        <div class="text-center mb-20 transition-all duration-700 ease-out" 
             :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-5'">
            <h1 class="text-4xl md:text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-green-500 mb-4">
                บริการเงินฝาก
            </h1>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                เลือกรูปแบบการออมและการลงทุนที่หลากหลาย ตอบโจทย์ทุกเป้าหมายทางการเงินของคุณตามหลักการอิสลาม
            </p>
        </div>

        <div class="space-y-20">
            @foreach ($depositServices as $service)
                <section class="transition-all duration-1000 ease-out opacity-0 transform translate-y-10"
                         :class="{ 'opacity-100 !translate-y-0': loaded }"
                         style="transition-delay: {{ $loop->index * 150 }}ms">
                         
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                        <div class="text-center @if($loop->even) lg:order-last @endif">
                            <div class="relative inline-block bg-{{ $service['color'] }}-100 p-8 rounded-full shadow-lg">
                                <div class="w-28 h-28 text-{{ $service['color'] }}-600">{!! $service['icon_svg'] !!}</div>
                            </div>
                        </div>

                        <div class="bg-white p-8 rounded-2xl shadow-xl border">
                            <h2 class="text-3xl font-bold text-gray-800">{{ $service['name'] }} <span class="text-xl font-normal text-gray-500">{{ $service['subtitle'] }}</span></h2>
                            
                            <div class="mt-8">
                                <h3 class="font-bold text-lg text-{{ $service['color'] }}-700 mb-3 border-b-2 border-{{ $service['color'] }}-200 pb-2">ลักษณะบริการ</h3>
                                <ul class="mt-4 space-y-3 text-gray-700">
                                    @foreach($service['features'] as $feature)
                                        <li class="flex items-start">
                                            <svg class="w-5 h-5 mr-3 text-green-500 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                            <span>{{ $feature }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            
                            <div class="mt-8">
                                <h3 class="font-bold text-lg text-{{ $service['color'] }}-700 mb-3 border-b-2 border-{{ $service['color'] }}-200 pb-2">เงื่อนไขการให้บริการ</h3>
                                <ul class="mt-4 space-y-3 text-gray-700">
                                    @foreach($service['conditions'] as $condition)
                                        <li class="flex items-start">
                                            <svg class="w-5 h-5 mr-3 text-green-500 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                            <span>{{ $condition }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </section>
            @endforeach
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endpush