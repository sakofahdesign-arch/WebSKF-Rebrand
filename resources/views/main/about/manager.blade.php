@extends('layouts.layout')
@section('title', 'คณะกรรมการและบุคลากร')

@section('content')
    <div class="bg-gray-50">
        <div class="container mx-auto px-4 py-16">
            <div x-data="{ activeTab: 'directors', loaded: false }" x-init="() => { setTimeout(() => loaded = true, 100) }">
                <div class="text-center mb-12 transition-all duration-700 ease-out" :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-5'">
                    <h1 class="text-4xl md:text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-700 to-green-600 mb-4">
                        คณะกรรมการและบุคลากร
                    </h1>
                    <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                        บุคลากรผู้ทรงคุณวุฒิ ผู้อยู่เบื้องหลังความสำเร็จของสหกรณ์อิสลามษะกอฟะฮ จำกัด
                    </p>
                </div>

                <div class="flex justify-center flex-wrap gap-2 md:gap-4 mb-12 transition-all duration-700 ease-out"
                    style="transition-delay: 200ms"
                    :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-5'">
                    <button @click="activeTab = 'directors'"
                        :class="{ 'bg-blue-600 text-white shadow-md': activeTab === 'directors', 'bg-white text-gray-700 hover:bg-gray-200': activeTab !== 'directors' }"
                        class="px-4 py-2 font-semibold rounded-full transition-all duration-200">คณะกรรมการดำเนินการ</button>
                    <button @click="activeTab = 'executives'"
                        :class="{ 'bg-blue-600 text-white shadow-md': activeTab === 'executives', 'bg-white text-gray-700 hover:bg-gray-200': activeTab !== 'executives' }"
                        class="px-4 py-2 font-semibold rounded-full transition-all duration-200">ผู้บริหาร</button>
                    <button @click="activeTab = 'advisors'"
                        :class="{ 'bg-blue-600 text-white shadow-md': activeTab === 'advisors', 'bg-white text-gray-700 hover:bg-gray-200': activeTab !== 'advisors' }"
                        class="px-4 py-2 font-semibold rounded-full transition-all duration-200">คณะที่ปรึกษา</button>
                    <button @click="activeTab = 'founders'"
                        :class="{ 'bg-blue-600 text-white shadow-md': activeTab === 'founders', 'bg-white text-gray-700 hover:bg-gray-200': activeTab !== 'founders' }"
                        class="px-4 py-2 font-semibold rounded-full transition-all duration-200">ทำเนียบผู้ก่อตั้ง</button>
                </div>

                <div class="relative transition-all duration-700 ease-out" style="transition-delay: 400ms"
                    :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-5'">

                    <div x-show="activeTab === 'directors'" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                        <img src="{{ asset('images/board/คณะกรรมการชุดที่ 28.jpg') }}" alt="คณะกรรมการดำเนินการ ชุดที่ 28"
                            class="mx-auto rounded-2xl shadow-xl max-w-5xl w-full" loading="lazy">
                    </div>

                    <div x-show="activeTab === 'executives'" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" style="display: none;">
                        <img src="{{ asset('images/board/ผู้บริหาร68.jpg') }}" alt="ผู้บริหาร"
                            class="mx-auto rounded-2xl shadow-xl max-w-5xl w-full" loading="lazy">
                    </div>

                    <div x-show="activeTab === 'advisors'" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" style="display: none;">
                        <img src="{{ asset('images/board/คณะที่ปรึกษา.jpg') }}" alt="คณะที่ปรึกษา"
                            class="mx-auto rounded-2xl shadow-xl max-w-5xl w-full" loading="lazy">
                    </div>

                    <div x-show="activeTab === 'founders'" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" style="display: none;">
                        <img src="{{ asset('images/board/บอร์ดก่อตั้ง.jpg') }}" alt="ทำเนียบผู้ก่อตั้ง"
                            class="mx-auto rounded-2xl shadow-xl max-w-5xl w-full" loading="lazy">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
