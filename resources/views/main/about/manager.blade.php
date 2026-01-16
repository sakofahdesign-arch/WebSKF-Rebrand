@extends('layouts.layout')
@section('title', 'คณะกรรมการและบุคลากร')

@section('content')
    <div class="bg-white min-h-screen relative overflow-hidden">

        <div class="absolute top-0 left-0 w-full h-full overflow-hidden -z-10 opacity-30 pointer-events-none">
            <div class="absolute top-[-10%] right-[-5%] w-96 h-96 bg-green-50 rounded-full mix-blend-multiply filter blur-3xl opacity-70"></div>
            <div class="absolute bottom-[-10%] left-[-10%] w-96 h-96 bg-blue-50 rounded-full mix-blend-multiply filter blur-3xl opacity-70"></div>
        </div>

        <div class="container mx-auto px-4 py-16">
            <div x-data="{ activeTab: 'directors', loaded: false }" x-init="() => { setTimeout(() => loaded = true, 100) }">

                <div class="text-center mb-12 transition-all duration-700 ease-out"
                     :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-5'">
                    <h1 class="text-3xl md:text-5xl font-extrabold text-green-800 tracking-tight mb-4">
                        โครงสร้างการบริหารงาน
                    </h1>
                    <div class="h-1.5 w-24 bg-green-500 mx-auto rounded-full mb-6"></div>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                        คณะกรรมการและบุคลากรผู้ทรงคุณวุฒิ ผู้อยู่เบื้องหลังความสำเร็จและการขับเคลื่อนสหกรณ์สู่ความมั่นคง
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-12 transition-all duration-700 ease-out max-w-5xl mx-auto"
                     style="transition-delay: 200ms"
                     :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-5'">

                    <button @click="activeTab = 'directors'"
                        :class="activeTab === 'directors' ? 'bg-green-600 text-white shadow-lg shadow-green-200 ring-2 ring-green-600 ring-offset-2' : 'bg-white text-gray-600 hover:bg-gray-50 border border-gray-200 hover:border-green-300'"
                        class="w-full py-4 rounded-xl font-bold text-lg transition-all duration-300 flex items-center justify-center">
                        <span>คณะกรรมการดำเนินการ</span>
                    </button>

                    <button @click="activeTab = 'executives'"
                        :class="activeTab === 'executives' ? 'bg-green-600 text-white shadow-lg shadow-green-200 ring-2 ring-green-600 ring-offset-2' : 'bg-white text-gray-600 hover:bg-gray-50 border border-gray-200 hover:border-green-300'"
                        class="w-full py-4 rounded-xl font-bold text-lg transition-all duration-300 flex items-center justify-center">
                        <span>ผู้บริหาร</span>
                    </button>

                    <button @click="activeTab = 'advisors'"
                        :class="activeTab === 'advisors' ? 'bg-green-600 text-white shadow-lg shadow-green-200 ring-2 ring-green-600 ring-offset-2' : 'bg-white text-gray-600 hover:bg-gray-50 border border-gray-200 hover:border-green-300'"
                        class="w-full py-4 rounded-xl font-bold text-lg transition-all duration-300 flex items-center justify-center">
                        <span>คณะที่ปรึกษา</span>
                    </button>

                    <button @click="activeTab = 'founders'"
                        :class="activeTab === 'founders' ? 'bg-green-600 text-white shadow-lg shadow-green-200 ring-2 ring-green-600 ring-offset-2' : 'bg-white text-gray-600 hover:bg-gray-50 border border-gray-200 hover:border-green-300'"
                        class="w-full py-4 rounded-xl font-bold text-lg transition-all duration-300 flex items-center justify-center">
                        <span>ทำเนียบผู้ก่อตั้ง</span>
                    </button>
                </div>

                <div class="relative transition-all duration-700 ease-out min-h-[500px]"
                     style="transition-delay: 400ms"
                     :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-5'">

                    <div class="card bg-white shadow-2xl border border-gray-100 rounded-2xl overflow-hidden max-w-6xl mx-auto">
                        <div class="card-body p-2 md:p-6 bg-gray-50/50">

                            <div x-show="activeTab === 'directors'"
                                 x-transition:enter="transition ease-out duration-300"
                                 x-transition:enter-start="opacity-0"
                                 x-transition:enter-end="opacity-100">
                                <img src="{{ asset('images/board/คณะกรรมการชุดที่ 28.jpg') }}"
                                     alt="คณะกรรมการดำเนินการ ชุดที่ 28"
                                     class="w-full h-auto rounded-xl shadow-sm"
                                     loading="lazy">
                            </div>

                            <div x-show="activeTab === 'executives'"
                                 x-transition:enter="transition ease-out duration-300"
                                 x-transition:enter-start="opacity-0"
                                 x-transition:enter-end="opacity-100"
                                 style="display: none;">
                                <img src="{{ asset('images/board/ผู้บริหาร68.jpg') }}"
                                     alt="ผู้บริหาร"
                                     class="w-full h-auto rounded-xl shadow-sm"
                                     loading="lazy">
                            </div>

                            <div x-show="activeTab === 'advisors'"
                                 x-transition:enter="transition ease-out duration-300"
                                 x-transition:enter-start="opacity-0"
                                 x-transition:enter-end="opacity-100"
                                 style="display: none;">
                                <img src="{{ asset('images/board/คณะที่ปรึกษา.jpg') }}"
                                     alt="คณะที่ปรึกษา"
                                     class="w-full h-auto rounded-xl shadow-sm"
                                     loading="lazy">
                            </div>

                            <div x-show="activeTab === 'founders'"
                                 x-transition:enter="transition ease-out duration-300"
                                 x-transition:enter-start="opacity-0"
                                 x-transition:enter-end="opacity-100"
                                 style="display: none;">
                                <img src="{{ asset('images/board/บอร์ดก่อตั้ง.jpg') }}"
                                     alt="ทำเนียบผู้ก่อตั้ง"
                                     class="w-full h-auto rounded-xl shadow-sm"
                                     loading="lazy">
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
