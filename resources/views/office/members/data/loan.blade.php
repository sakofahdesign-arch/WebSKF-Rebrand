<div x-data="{ activeTab: 'opened' }" class="card bg-white shadow-lg border border-gray-100 overflow-hidden">
    <div class="h-2 bg-gradient-to-r from-emerald-500 to-teal-400"></div>
    
    <div class="p-6 border-b border-gray-100">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-emerald-100 flex items-center justify-center text-emerald-600 shadow-sm">
                    <i class="fas fa-file-invoice-dollar text-lg"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800">ข้อมูลสินเชื่อ</h3>
            </div>
        </div>

        <div class="tabs tabs-boxed bg-gray-100 p-1 rounded-lg inline-flex">
            <a @click="activeTab = 'opened'" 
               :class="activeTab === 'opened' ? 'tab-active bg-white shadow-sm text-emerald-600' : 'text-gray-500 hover:text-gray-700'"
               class="tab h-10 px-6 rounded-md transition-all duration-200 font-medium gap-2">
                <i class="fas fa-hourglass-half" :class="activeTab === 'opened' ? 'text-emerald-500' : 'text-gray-400'"></i>
                สินเชื่อคงเหลือ
            </a>
            <a @click="activeTab = 'closed'" 
               :class="activeTab === 'closed' ? 'tab-active bg-white shadow-sm text-emerald-600' : 'text-gray-500 hover:text-gray-700'"
               class="tab h-10 px-6 rounded-md transition-all duration-200 font-medium gap-2">
                <i class="fas fa-check-circle" :class="activeTab === 'closed' ? 'text-emerald-500' : 'text-gray-400'"></i>
                ปิดบัญชีแล้ว
            </a>
        </div>
    </div>

    <div class="p-0">
        
        <div x-show="activeTab === 'opened'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
            <div class="overflow-x-auto">
                <table class="stockTable w-full">
                    <thead class="bg-gray-50 text-gray-500 font-medium border-b border-gray-100">
                        <tr>
                            <th class="py-4 px-6 text-left">เลขที่/ชื่อสัญญา</th>
                            <th class="py-4 px-6 text-center">วันที่ทำสัญญา</th>
                            <th class="py-4 px-6 text-right">ยอดอนุมัติ</th>
                            <th class="py-4 px-6 text-right">ยอดคงเหลือ</th>
                            <th class="py-4 px-6 text-center">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 divide-y divide-gray-100">
                        @forelse($opened_credit_member as $item)
                            <tr class="hover:bg-emerald-50/30 transition-colors group">
                                <td class="py-4 px-6">
                                    <div class="font-bold text-gray-800 group-hover:text-emerald-700 transition-colors">{{ $item->LSUB_NAME }}</div>
                                    <div class="text-xs text-gray-400 font-mono bg-gray-100 px-2 py-0.5 rounded inline-block mt-1">{{ $item->LCONT_ID }}</div>
                                </td>
                                <td class="py-4 px-6 text-center whitespace-nowrap">
                                    {{ $item->LCONT_DATE ? thaidate('j M Y', strtotime($item->LCONT_DATE)) : '-' }}
                                </td>
                                <td class="py-4 px-6 text-right font-medium text-gray-500">
                                    {{ number_format($item->LCONT_APPROVE_SAL, 2) }}
                                </td>
                                <td class="py-4 px-6 text-right">
                                    <span class="text-rose-600 font-bold bg-rose-50 px-2 py-1 rounded-md border border-rose-100">
                                        {{ number_format($item->LCONT_AMOUNT_SAL, 2) }}
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <form action="/loan_details" method="POST">
                                        @csrf
                                        <input type="hidden" name="code" value="{{ $item->CODE }}">
                                        <input type="hidden" name="br_no" value="{{ $item->BR_NO }}">
                                        <button type="submit" class="btn btn-sm btn-ghost text-emerald-600 hover:bg-emerald-50 hover:text-emerald-700 w-full md:w-auto">
                                            <i class="fas fa-search mr-1"></i> รายละเอียด
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-12 text-center text-gray-400">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-3">
                                            <i class="fas fa-file-invoice text-2xl opacity-30"></i>
                                        </div>
                                        <p>ไม่พบรายการสินเชื่อคงเหลือ</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div x-show="activeTab === 'closed'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" style="display: none;">
            <div class="overflow-x-auto">
                <table class="stockTable w-full">
                    <thead class="bg-gray-50 text-gray-500 font-medium border-b border-gray-100">
                        <tr>
                            <th class="py-4 px-6 text-left">เลขที่/ชื่อสัญญา</th>
                            <th class="py-4 px-6 text-center">วันที่ทำสัญญา</th>
                            <th class="py-4 px-6 text-center">วันที่ปิดสัญญา</th>
                            <th class="py-4 px-6 text-right">ยอดอนุมัติ</th>
                            <th class="py-4 px-6 text-center">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 divide-y divide-gray-100">
                        @forelse($closed_credit_member as $item)
                            <tr class="hover:bg-gray-50 transition-colors group opacity-75 hover:opacity-100">
                                <td class="py-4 px-6">
                                    <div class="font-bold text-gray-700">{{ $item->LSUB_NAME }}</div>
                                    <div class="text-xs text-gray-400 font-mono bg-gray-100 px-2 py-0.5 rounded inline-block mt-1">{{ $item->LCONT_ID }}</div>
                                </td>
                                <td class="py-4 px-6 text-center whitespace-nowrap text-gray-500">
                                    {{ $item->LCONT_DATE ? thaidate('j M Y', strtotime($item->LCONT_DATE)) : '-' }}
                                </td>
                                <td class="py-4 px-6 text-center whitespace-nowrap">
                                    <span class="text-emerald-600 font-medium flex items-center justify-center gap-1">
                                        <i class="fas fa-check-circle text-xs"></i>
                                        {{ $item->END_PAYDEPT ? thaidate('j M Y', strtotime($item->END_PAYDEPT)) : '-' }}
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-right font-medium text-gray-600">
                                    {{ number_format($item->LCONT_APPROVE_SAL, 2) }}
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <form action="/loan_details" method="POST">
                                        @csrf
                                        <input type="hidden" name="code" value="{{ $item->CODE }}">
                                        <input type="hidden" name="br_no" value="{{ $item->BR_NO }}">
                                        <button type="submit" class="btn btn-sm btn-ghost text-gray-500 hover:bg-gray-100 hover:text-gray-700 w-full md:w-auto">
                                            <i class="fas fa-search mr-1"></i> รายละเอียด
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-12 text-center text-gray-400">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-3">
                                            <i class="fas fa-check-double text-2xl opacity-30"></i>
                                        </div>
                                        <p>ไม่พบประวัติการปิดบัญชี</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>