@extends('layouts.layout')
@section('title', 'บริการสินเชื่อ')

@section('content')
<div class="bg-gray-50" x-data="{ loaded: false, activeTab: '{{ $loanProducts[0]['id'] }}' }" x-init="() => { setTimeout(() => loaded = true, 50) }">
    <div class="container mx-auto px-4 py-16">

        <div class="text-center mb-16 transition-all duration-700 ease-out" :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-5'">
            <h1 class="text-4xl md:text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-sky-500 to-blue-700 mb-4">
                บริการสินเชื่อ
            </h1>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                หลากหลายประเภทสินเชื่อเพื่อตอบโจทย์ทุกความต้องการของสมาชิก ด้วยเงื่อนไขที่เป็นธรรมตามหลักการอิสลาม
            </p>
        </div>

        <section class="mb-16 transition-all duration-700 ease-out" :class="loaded ? 'opacity-100' : 'opacity-0'" style="transition-delay: 200ms;">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">เปรียบเทียบสินเชื่อประเภทต่างๆ</h2>
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-100 text-gray-700 uppercase">
                            <tr>
                                <th class="px-6 py-4 font-bold">ประเภทสินเชื่อ</th>
                                <th class="px-6 py-4 font-bold">วงเงินสูงสุด</th>
                                <th class="px-6 py-4 font-bold">ผ่อนชำระสูงสุด</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700">
                            @foreach ($loanProducts as $product)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-6 py-4 font-bold text-{{ $product['theme_color'] }}-600">{{ $product['name'] }}</td>
                                    <td class="px-6 py-4">{{ $product['max_amount'] }}</td>
                                    <td class="px-6 py-4">{{ $product['max_period'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <section class="transition-all duration-700 ease-out" :class="loaded ? 'opacity-100' : 'opacity-0'" style="transition-delay: 400ms;">
            <div class="border-b border-gray-300 mb-8">
                <nav class="-mb-px flex flex-wrap justify-center gap-4" aria-label="Tabs">
                    @foreach ($loanProducts as $product)
                        <button @click="activeTab = '{{ $product['id'] }}'" :class="activeTab === '{{ $product['id'] }}' ? 'border-{{ $product['theme_color'] }}-500 text-{{ $product['theme_color'] }}-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'" class="whitespace-nowrap py-4 px-3 border-b-4 font-bold text-base transition-colors">
                            {{ $product['name'] }}
                        </button>
                    @endforeach
                </nav>
            </div>
            <div class="bg-white rounded-2xl shadow-2xl p-6 md:p-10 min-h-[500px]">
                @foreach ($loanProducts as $product)
                    <div x-show="activeTab === '{{ $product['id'] }}'"
                         x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
                         x-transition:enter-end="opacity-100" style="display: none;">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12">
                            <div>
                                <img src="{{ asset($product['image']) }}" alt="{{ $product['name'] }}"
                                     class="rounded-xl shadow-lg w-full h-auto object-cover" loading="lazy">
                            </div>
                            <div class="space-y-6">
                                <div>
                                    <h3 class="font-bold text-lg text-gray-500">คุณสมบัติผู้กู้</h3>
                                    <p class="text-gray-800">{{ $product['qualification'] }}</p>
                                </div>
                                <div>
                                    <h3 class="font-bold text-lg text-gray-500">วัตถุประสงค์</h3>
                                    <ul class="list-disc list-inside text-gray-800 space-y-1">
                                        @foreach ($product['purpose'] as $item)<li>{{ $item }}</li>@endforeach
                                    </ul>
                                </div>
                                <div>
                                    <h3 class="font-bold text-lg text-gray-500">หลักประกันสินเชื่อ</h3>
                                    <ul class="list-disc list-inside text-gray-800 space-y-1">
                                       @foreach($product['collateral'] as $item)<li>{{ $item }}</li>@endforeach
                                    </ul>
                                </div>
                                <div>
                                    <h3 class="font-bold text-lg text-gray-500">ค่าธรรมเนียมและบริการ</h3>
                                    <ul class="list-disc list-inside text-gray-800 space-y-1">
                                        @foreach($product['fees'] as $item)<li>{{ $item }}</li>@endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
        
        <section class="mt-16 transition-all duration-700 ease-out" :class="loaded ? 'opacity-100' : 'opacity-0'"
                 style="transition-delay: 600ms;">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">คำนิยามเพิ่มเติม</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-4xl mx-auto">
                @foreach($definitions as $def)
                <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $def['term'] }}</h3>
                    <p class="text-gray-700">{{ $def['definition'] }}</p>
                </div>
                @endforeach
            </div>
        </section>
    </div>
</div>
@endsection

@push('scripts')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endpush