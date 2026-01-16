@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex justify-center">
        <div class="join">
            {{-- ปุ่มย้อนกลับ (Previous) --}}
            @if ($paginator->onFirstPage())
                <button class="join-item btn btn-sm btn-disabled bg-gray-100 text-gray-400 border border-gray-300" aria-label="@lang('pagination.previous')">
                    <i class="fas fa-chevron-left"></i>
                </button>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="join-item btn btn-sm bg-white text-gray-900 font-bold border border-gray-300 hover:bg-gray-200" rel="prev" aria-label="@lang('pagination.previous')">
                    <i class="fas fa-chevron-left"></i>
                </a>
            @endif

            {{-- รายการเลขหน้า --}}
            @foreach ($elements as $element)
                {{-- กรณีเป็น "..." (Three Dots) --}}
                @if (is_string($element))
                    <button class="join-item btn btn-sm btn-disabled bg-white text-gray-800 font-bold border border-gray-300">{{ $element }}</button>
                @endif

                {{-- กรณีเป็นลิงก์เลขหน้า --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            {{-- หน้าปัจจุบัน: สีเขียวเข้ม ตัวหนังสือขาว --}}
                            <button class="join-item btn btn-sm bg-emerald-700 text-white font-bold border border-emerald-700 hover:bg-emerald-800" aria-current="page">{{ $page }}</button>
                        @else
                            {{-- หน้าปกติ: พื้นขาว ตัวหนังสือดำเข้ม --}}
                            <a href="{{ $url }}" class="join-item btn btn-sm bg-white text-gray-900 font-bold border border-gray-300 hover:bg-gray-200">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- ปุ่มถัดไป (Next) --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="join-item btn btn-sm bg-white text-gray-900 font-bold border border-gray-300 hover:bg-gray-200" rel="next" aria-label="@lang('pagination.next')">
                    <i class="fas fa-chevron-right"></i>
                </a>
            @else
                <button class="join-item btn btn-sm btn-disabled bg-gray-100 text-gray-400 border border-gray-300" aria-label="@lang('pagination.next')">
                    <i class="fas fa-chevron-right"></i>
                </button>
            @endif
        </div>
    </nav>
@endif