<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <div x-data="{ activeTab: 'ประชาสัมพันธ์' }" class="w-full">
            <div class="mb-8 border-b border-gray-200">
                <nav class="-mb-px flex flex-wrap justify-center space-x-2 sm:space-x-4 lg:space-x-6" aria-label="Tabs">

                    <button @click="activeTab = 'ประชาสัมพันธ์'" :class="activeTab === 'ประชาสัมพันธ์' ? 'border-indigo-500 text-indigo-600' :
                            'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                        class="group inline-flex items-center py-4 px-1 border-b-2 font-medium text-sm transition-colors duration-200">
                        <i class="fas fa-bullhorn fa-fw mr-2"></i>
                        <span>ข่าวประชาสัมพันธ์</span>
                    </button>

                    <button @click="activeTab = 'สวัสดิการ'" :class="activeTab === 'สวัสดิการ' ? 'border-indigo-500 text-indigo-600' :
                            'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                        class="group inline-flex items-center py-4 px-1 border-b-2 font-medium text-sm transition-colors duration-200">
                        <i class="fas fa-user-group fa-fw mr-2"></i>
                        <span>ข่าวสวัสดิการ</span>
                    </button>

                    <button @click="activeTab = 'มูลนิธิ'" :class="activeTab === 'มูลนิธิ' ? 'border-indigo-500 text-indigo-600' :
                            'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                        class="group inline-flex items-center py-4 px-1 border-b-2 font-medium text-sm transition-colors duration-200">
                        <i class="fas fa-hand-holding-medical fa-fw mr-2"></i>
                        <span>มูลนิธิษะกอฟะฮ</span>
                    </button>

                    <button @click="activeTab = 'สินเชื่อ'" :class="activeTab === 'สินเชื่อ' ? 'border-indigo-500 text-indigo-600' :
                            'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                        class="group inline-flex items-center py-4 px-1 border-b-2 font-medium text-sm transition-colors duration-200">
                        <i class="fas fa-credit-card fa-fw mr-2"></i>
                        <span>ข่าวสินเชื่อ</span>
                    </button>
                </nav>
            </div>

            <div>
                <div x-show="activeTab === 'ประชาสัมพันธ์'" x-transition>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @foreach ($information as $item)
                            <div
                                class="bg-white rounded-lg shadow-md overflow-hidden group transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                                <a href="{{ route('article', $item->news_number) }}" class="block">
                                    <img src="{{ url('uploads/covers/' . $item->picture_name) }}"
                                        class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-105"
                                        alt="{{ $item->title }}" loading="lazy">
                                    <div class="p-4">
                                        <p
                                            class="h-16 text-gray-800 font-semibold leading-tight text-ellipsis overflow-hidden">
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

                <div x-show="activeTab === 'สวัสดิการ'" x-transition style="display: none;">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @foreach ($welfare as $item)
                            <div
                                class="bg-white rounded-lg shadow-md overflow-hidden group transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                                <a href="{{ route('article', $item->news_number) }}" class="block">
                                    <img src="{{ url('uploads/covers/' . $item->picture_name) }}"
                                        class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-105"
                                        alt="{{ $item->title }}" loading="lazy">
                                    <div class="p-4">
                                        <p
                                            class="h-16 text-gray-800 font-semibold leading-tight text-ellipsis overflow-hidden">
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

                <div x-show="activeTab === 'มูลนิธิ'" x-transition style="display: none;">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @foreach ($foundation as $item)
                            <div
                                class="bg-white rounded-lg shadow-md overflow-hidden group transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                                <a href="{{ route('article', $item->news_number) }}" class="block">
                                    <img src="{{ url('uploads/covers/' . $item->picture_name) }}"
                                        class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-105"
                                        alt="{{ $item->title }}" loading="lazy">
                                    <div class="p-4">
                                        <p
                                            class="h-16 text-gray-800 font-semibold leading-tight text-ellipsis overflow-hidden">
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

                <div x-show="activeTab === 'สินเชื่อ'" x-transition style="display: none;">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @foreach ($credit as $item)
                            <div
                                class="bg-white rounded-lg shadow-md overflow-hidden group transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                                <a href="{{ route('article', $item->news_number) }}" class="block">
                                    <img src="{{ url('uploads/covers/' . $item->picture_name) }}"
                                        class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-105"
                                        alt="{{ $item->title }}" loading="lazy">
                                    <div class="p-4">
                                        <p
                                            class="h-16 text-gray-800 font-semibold leading-tight text-ellipsis overflow-hidden">
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