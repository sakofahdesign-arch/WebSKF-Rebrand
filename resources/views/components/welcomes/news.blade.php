<section class="py-16 bg-white relative">
    <div class="container mx-auto px-4">
        <div class="text-center mb-10">
            <h2 class="text-3xl md:text-4xl font-extrabold text-green-800">ข่าวสารและกิจกรรม</h2>
            <div class="h-1 w-20 bg-green-500 mx-auto rounded-full mt-2"></div>
        </div>

        <div x-data="{ activeTab: 'ประชาสัมพันธ์' }" class="w-full">
            <div class="flex justify-center mb-10">
                <div class="bg-gray-50 p-1.5 rounded-full inline-flex flex-wrap justify-center gap-1 shadow-inner border border-gray-100">
                    <button @click="activeTab = 'ประชาสัมพันธ์'" :class="activeTab === 'ประชาสัมพันธ์' ? 'bg-white text-green-700 shadow-sm ring-1 ring-black/5' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-100'" class="flex items-center px-6 py-2.5 rounded-full text-sm font-bold transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" /></svg>
                        ประชาสัมพันธ์
                    </button>
                    <button @click="activeTab = 'สวัสดิการ'" :class="activeTab === 'สวัสดิการ' ? 'bg-white text-green-700 shadow-sm ring-1 ring-black/5' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-100'" class="flex items-center px-6 py-2.5 rounded-full text-sm font-bold transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                        สวัสดิการ
                    </button>
                    <button @click="activeTab = 'มูลนิธิ'" :class="activeTab === 'มูลนิธิ' ? 'bg-white text-green-700 shadow-sm ring-1 ring-black/5' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-100'" class="flex items-center px-6 py-2.5 rounded-full text-sm font-bold transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" /></svg>
                        มูลนิธิษะกอฟะฮ
                    </button>
                    <button @click="activeTab = 'สินเชื่อ'" :class="activeTab === 'สินเชื่อ' ? 'bg-white text-green-700 shadow-sm ring-1 ring-black/5' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-100'" class="flex items-center px-6 py-2.5 rounded-full text-sm font-bold transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" /></svg>
                        สินเชื่อ
                    </button>
                </div>
            </div>

            <div class="relative min-h-[400px]">
                @php
                    $tabs = [
                        'ประชาสัมพันธ์' => $information,
                        'สวัสดิการ' => $welfare,
                        'มูลนิธิ' => $foundation,
                        'สินเชื่อ' => $credit
                    ];
                @endphp

                @foreach($tabs as $key => $newsList)
                    <div x-show="activeTab === '{{ $key }}'"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 translate-y-4"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6"
                         style="display: none;"
                         x-show.important="activeTab === '{{ $key }}'">

                        @foreach ($newsList as $item)
                            {{--
                                แก้ไขตรงนี้: เปลี่ยน bg-base-100 เป็น bg-white
                                และเพิ่ม text-gray-800 เพื่อให้มั่นใจว่าตัวหนังสือสีเข้ม
                            --}}
                            <a href="{{ route('article', $item->news_number) }}" class="card bg-white shadow-sm hover:shadow-xl transition-all duration-300 group border border-gray-200 h-full">

                                <figure class="relative overflow-hidden h-48 bg-gray-100">
                                    <img src="{{ url('uploads/covers/' . $item->picture_name) }}"
                                         alt="{{ $item->title }}"
                                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                                         loading="lazy" />
                                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors duration-300"></div>
                                </figure>

                                <div class="card-body p-5">
                                    <h3 class="card-title text-base font-bold text-gray-800 line-clamp-2 leading-relaxed group-hover:text-green-700 transition-colors">
                                        {{ $item->title }}
                                    </h3>

                                    <div class="flex-grow"></div>

                                    <div class="card-actions justify-between items-center mt-4 pt-3 border-t border-gray-100 text-xs text-gray-500">
                                        <div class="flex items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                            {{ thaidate('j F Y', $item->dateupload) }}
                                        </div>
                                        <span class="text-green-600 font-medium group-hover:translate-x-1 transition-transform">อ่านต่อ →</span>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
