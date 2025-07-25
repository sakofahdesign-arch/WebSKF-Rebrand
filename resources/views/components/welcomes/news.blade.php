<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <div x-data="{ activeTab: 'ประชาสัมพันธ์' }" class="w-full">
            <!-- Tabs -->
            <div class="mb-10 border-b border-gray-200">
                <nav class="flex flex-wrap justify-center space-x-2 sm:space-x-4 lg:space-x-6" aria-label="Tabs">
                    <button @click="activeTab = 'ประชาสัมพันธ์'"
                        :class="activeTab === 'ประชาสัมพันธ์' ? 'border-indigo-600 text-indigo-600 font-semibold' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                        class="group inline-flex items-center py-4 px-2 border-b-2 text-sm transition-all duration-200">
                        <i class="fas fa-bullhorn fa-fw mr-2"></i>
                        ข่าวประชาสัมพันธ์
                    </button>

                    <button @click="activeTab = 'สวัสดิการ'"
                        :class="activeTab === 'สวัสดิการ' ? 'border-indigo-600 text-indigo-600 font-semibold' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                        class="group inline-flex items-center py-4 px-2 border-b-2 text-sm transition-all duration-200">
                        <i class="fas fa-user-group fa-fw mr-2"></i>
                        ข่าวสวัสดิการ
                    </button>

                    <button @click="activeTab = 'มูลนิธิ'"
                        :class="activeTab === 'มูลนิธิ' ? 'border-indigo-600 text-indigo-600 font-semibold' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                        class="group inline-flex items-center py-4 px-2 border-b-2 text-sm transition-all duration-200">
                        <i class="fas fa-hand-holding-medical fa-fw mr-2"></i>
                        มูลนิธิษะกอฟะฮ
                    </button>

                    <button @click="activeTab = 'สินเชื่อ'"
                        :class="activeTab === 'สินเชื่อ' ? 'border-indigo-600 text-indigo-600 font-semibold' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                        class="group inline-flex items-center py-4 px-2 border-b-2 text-sm transition-all duration-200">
                        <i class="fas fa-credit-card fa-fw mr-2"></i>
                        ข่าวสินเชื่อ
                    </button>
                </nav>
            </div>

            <!-- Content per Tab -->
            <div>
                {{-- ข่าวประชาสัมพันธ์ --}}
                <div x-show="activeTab === 'ประชาสัมพันธ์'" x-transition>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @foreach ($information as $item)
                            <div class="bg-white rounded-xl shadow-sm group transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                                <a href="{{ route('article', $item->news_number) }}" class="block">
                                    <img src="{{ url('uploads/covers/' . $item->picture_name) }}"
                                        alt="{{ $item->title }}"
                                        class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-105 rounded-t-xl"
                                        loading="lazy">
                                    <div class="p-4">
                                        <p class="text-base text-gray-800 font-medium leading-snug line-clamp-2">
                                            {{ $item->title }}
                                        </p>
                                    </div>
                                    <div class="px-4 py-2 bg-gray-50 border-t border-gray-100">
                                        <small class="text-gray-500">{{ thaidate('j F Y', $item->dateupload) }}</small>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- ข่าวสวัสดิการ --}}
                <div x-show="activeTab === 'สวัสดิการ'" x-transition style="display: none;">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @foreach ($welfare as $item)
                            <div class="bg-white rounded-xl shadow-sm group transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                                <a href="{{ route('article', $item->news_number) }}" class="block">
                                    <img src="{{ url('uploads/covers/' . $item->picture_name) }}"
                                        alt="{{ $item->title }}"
                                        class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-105 rounded-t-xl"
                                        loading="lazy">
                                    <div class="p-4">
                                        <p class="text-base text-gray-800 font-medium leading-snug line-clamp-2">
                                            {{ $item->title }}
                                        </p>
                                    </div>
                                    <div class="px-4 py-2 bg-gray-50 border-t border-gray-100">
                                        <small class="text-gray-500">{{ thaidate('j F Y', $item->dateupload) }}</small>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- มูลนิธิษะกอฟะฮ --}}
                <div x-show="activeTab === 'มูลนิธิ'" x-transition style="display: none;">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @foreach ($foundation as $item)
                            <div class="bg-white rounded-xl shadow-sm group transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                                <a href="{{ route('article', $item->news_number) }}" class="block">
                                    <img src="{{ url('uploads/covers/' . $item->picture_name) }}"
                                        alt="{{ $item->title }}"
                                        class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-105 rounded-t-xl"
                                        loading="lazy">
                                    <div class="p-4">
                                        <p class="text-base text-gray-800 font-medium leading-snug line-clamp-2">
                                            {{ $item->title }}
                                        </p>
                                    </div>
                                    <div class="px-4 py-2 bg-gray-50 border-t border-gray-100">
                                        <small class="text-gray-500">{{ thaidate('j F Y', $item->dateupload) }}</small>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- ข่าวสินเชื่อ --}}
                <div x-show="activeTab === 'สินเชื่อ'" x-transition style="display: none;">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @foreach ($credit as $item)
                            <div class="bg-white rounded-xl shadow-sm group transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                                <a href="{{ route('article', $item->news_number) }}" class="block">
                                    <img src="{{ url('uploads/covers/' . $item->picture_name) }}"
                                        alt="{{ $item->title }}"
                                        class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-105 rounded-t-xl"
                                        loading="lazy">
                                    <div class="p-4">
                                        <p class="text-base text-gray-800 font-medium leading-snug line-clamp-2">
                                            {{ $item->title }}
                                        </p>
                                    </div>
                                    <div class="px-4 py-2 bg-gray-50 border-t border-gray-100">
                                        <small class="text-gray-500">{{ thaidate('j F Y', $item->dateupload) }}</small>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
