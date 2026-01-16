@extends('layouts.layout')
@section('title', 'บริการสินเชื่อ')

@section('content')
<div class="bg-gray-50 min-h-screen text-gray-800 font-sans" data-theme="light" x-data="{ loaded: false, activeTab: '{{ $loanProducts[0]['id'] }}' }" x-init="() => { setTimeout(() => loaded = true, 50) }">

    <div class="relative bg-gradient-to-br from-sky-50 to-blue-50 py-20 overflow-hidden">
        <div class="absolute top-0 right-0 w-96 h-96 bg-blue-100 rounded-full mix-blend-multiply filter blur-3xl opacity-30 -mr-20 -mt-20"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-sky-100 rounded-full mix-blend-multiply filter blur-3xl opacity-30 -ml-20 -mb-20"></div>

        <div class="container mx-auto px-4 text-center relative z-10 transition-all duration-700 ease-out"
             :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-5'">
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-6 leading-tight">
                บริการ<span class="text-blue-600">สินเชื่อ</span>
            </h1>
            <p class="text-lg md:text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                หลากหลายประเภทสินเชื่อเพื่อตอบโจทย์ทุกความต้องการของสมาชิก ด้วยเงื่อนไขที่เป็นธรรมและถูกต้องตามหลักการอิสลาม
            </p>
        </div>
    </div>

    <div class="container mx-auto px-4 py-16">

        <section class="mb-20 transition-all duration-700 ease-out" :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'" style="transition-delay: 200ms;">
            <div class="flex items-center justify-center mb-10 gap-3">
                <i class="fas fa-table text-2xl text-blue-500"></i>
                <h2 class="text-3xl font-bold text-gray-800">เปรียบเทียบสินเชื่อ</h2>
            </div>

            <div class="overflow-x-auto rounded-xl shadow-xl border border-gray-100">
                <table class="table table-zebra table-lg w-full">
                    <thead class="bg-blue-600 text-white text-base">
                        <tr>
                            <th class="rounded-tl-xl pl-6 py-4">ประเภทสินเชื่อ</th>
                            <th class="py-4">วงเงินสูงสุด</th>
                            <th class="rounded-tr-xl py-4">ผ่อนชำระสูงสุด</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 text-base font-medium">
                        @foreach ($loanProducts as $product)
                            <tr class="hover:bg-blue-50 transition-colors">
                                <td class="pl-6 py-4 font-bold text-gray-800 flex items-center gap-3">
                                    @php
                                        $colorClass = match($product['theme_color']) {
                                            'red' => 'bg-red-500',
                                            'amber' => 'bg-amber-500',
                                            'teal' => 'bg-teal-500',
                                            'indigo' => 'bg-indigo-500',
                                            'slate' => 'bg-slate-500',
                                            default => 'bg-sky-500'
                                        };
                                    @endphp
                                    <div class="w-2 h-8 rounded {{ $colorClass }}"></div>
                                    {{ $product['name'] }}
                                </td>
                                <td class="py-4">{{ $product['max_amount'] }}</td>
                                <td class="py-4">{{ $product['max_period'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>

        <section class="transition-all duration-700 ease-out" :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'" style="transition-delay: 400ms;">

            <div class="flex items-center justify-center mb-8 gap-3">
                <i class="fas fa-info-circle text-2xl text-blue-500"></i>
                <h2 class="text-3xl font-bold text-gray-800">รายละเอียดผลิตภัณฑ์</h2>
            </div>

            <div class="flex justify-center mb-8">
                <div class="tabs tabs-boxed bg-gray-100 p-2 rounded-2xl gap-2 flex-wrap justify-center">
                    @foreach ($loanProducts as $product)
                        @php
                             // กำหนดสี Active Tab ตาม theme_color
                             $activeClass = match($product['theme_color']) {
                                'red' => 'text-red-600 border-red-100',
                                'amber' => 'text-amber-600 border-amber-100',
                                'teal' => 'text-teal-600 border-teal-100',
                                'indigo' => 'text-indigo-600 border-indigo-100',
                                'slate' => 'text-slate-600 border-slate-100',
                                default => 'text-sky-600 border-sky-100'
                            };
                        @endphp
                        <a @click="activeTab = '{{ $product['id'] }}'"
                           class="tab tab-lg rounded-xl transition-all duration-300 font-bold h-auto py-3 px-6 whitespace-nowrap"
                           :class="activeTab === '{{ $product['id'] }}' ? 'tab-active bg-white shadow-md border-2 {{ $activeClass }}' : 'text-gray-500 hover:text-gray-700'">
                           {{ $product['name'] }}
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="min-h-[500px]">
                @foreach ($loanProducts as $product)
                    @php
                        // กำหนดตัวแปรสีสำหรับใช้ใน Content
                         $themeText = match($product['theme_color']) {
                                'red' => 'text-red-500',
                                'amber' => 'text-amber-500',
                                'teal' => 'text-teal-500',
                                'indigo' => 'text-indigo-500',
                                'slate' => 'text-slate-500',
                                default => 'text-sky-500'
                            };
                         $themeBorder = match($product['theme_color']) {
                                'red' => 'border-red-500',
                                'amber' => 'border-amber-500',
                                'teal' => 'border-teal-500',
                                'indigo' => 'border-indigo-500',
                                'slate' => 'border-slate-500',
                                default => 'border-sky-500'
                            };
                          $themeBadge = match($product['theme_color']) {
                                'red' => 'badge-error text-white',
                                'amber' => 'badge-warning text-white',
                                'teal' => 'badge-accent text-white', // หรือ custom class
                                'indigo' => 'bg-indigo-500 text-white border-indigo-500',
                                'slate' => 'bg-slate-500 text-white border-slate-500',
                                default => 'badge-info text-white'
                            };
                    @endphp

                    <div x-show="activeTab === '{{ $product['id'] }}'"
                         x-transition:enter="transition ease-out duration-500"
                         x-transition:enter-start="opacity-0 translate-y-4"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         style="display: none;">

                        <div class="card lg:card-side bg-white shadow-2xl border border-gray-100 overflow-hidden rounded-2xl">
                            <figure class="lg:w-2/5 relative h-64 lg:h-auto overflow-hidden group">
                                <img src="{{ asset($product['image']) }}" alt="{{ $product['name'] }}"
                                     class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                     loading="lazy"> <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-end p-8">
                                    <div class="text-white">
                                        <div class="badge {{ $themeBadge }} mb-2 font-bold p-3 border-none">แนะนำ</div>
                                        <h3 class="text-3xl font-bold">{{ $product['name'] }}</h3>
                                    </div>
                                </div>
                            </figure>

                            <div class="card-body lg:w-3/5 p-8 lg:p-10">
                                <div class="grid md:grid-cols-2 gap-8">

                                    <div class="col-span-full">
                                        <h4 class="flex items-center text-lg font-bold text-gray-800 mb-3 border-b pb-2">
                                            <i class="fas fa-user-check {{ $themeText }} mr-2"></i> คุณสมบัติผู้กู้
                                        </h4>
                                        <p class="text-gray-600 bg-gray-50 p-4 rounded-lg border-l-4 {{ $themeBorder }}">
                                            {{ $product['qualification'] }}
                                        </p>
                                    </div>

                                    <div>
                                        <h4 class="flex items-center text-lg font-bold text-gray-800 mb-3 border-b pb-2">
                                            <i class="fas fa-bullseye {{ $themeText }} mr-2"></i> วัตถุประสงค์
                                        </h4>
                                        <ul class="space-y-2">
                                            @foreach ($product['purpose'] as $item)
                                                <li class="flex items-start text-gray-600 text-sm">
                                                    <i class="fas fa-check text-green-500 mt-1 mr-2 flex-shrink-0"></i> {{ $item }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>

                                    <div>
                                        <h4 class="flex items-center text-lg font-bold text-gray-800 mb-3 border-b pb-2">
                                            <i class="fas fa-shield-alt {{ $themeText }} mr-2"></i> หลักประกัน
                                        </h4>
                                        <ul class="space-y-2">
                                            @foreach($product['collateral'] as $item)
                                                <li class="flex items-start text-gray-600 text-sm">
                                                    <i class="fas fa-check text-green-500 mt-1 mr-2 flex-shrink-0"></i> {{ $item }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>

                                    <div class="col-span-full">
                                        <h4 class="flex items-center text-lg font-bold text-gray-800 mb-3 border-b pb-2">
                                            <i class="fas fa-file-invoice-dollar {{ $themeText }} mr-2"></i> ค่าธรรมเนียม
                                        </h4>
                                        <div class="flex flex-wrap gap-3">
                                            @foreach($product['fees'] as $item)
                                                <div class="badge badge-outline p-3 text-gray-600 border-gray-300">{{ $item }}</div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <section class="mt-24 transition-all duration-700 ease-out" :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'" style="transition-delay: 600ms;">
            <div class="text-center mb-10">
                <span class="text-sm font-bold text-blue-600 tracking-wider uppercase mb-2 block">Vocabulary</span>
                <h2 class="text-3xl font-bold text-gray-800">คำนิยามศัพท์ทางการเงินอิสลาม</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($definitions as $def)
                <div class="card bg-white hover:bg-blue-50 rounded-xl shadow-lg border border-gray-100 hover:border-blue-200 transition-all duration-300 hover:-translate-y-1">
                    <div class="card-body p-6 text-center">
                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4 text-blue-600">
                            <i class="fas fa-book-open"></i>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $def['term'] }}</h3>
                        <p class="text-sm text-gray-600 leading-relaxed">{{ $def['definition'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </section>

    </div>
</div>
@endsection
