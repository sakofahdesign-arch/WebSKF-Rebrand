<div x-data="{ activeTab: 'opened' }" class="bg-white rounded-2xl shadow-xl border border-gray-200/80">
    
    <div class="p-2 bg-gray-50 border-b border-gray-200">
        <nav class="flex space-x-2" aria-label="Tabs">
            <button @click="activeTab = 'opened'"
                    :class="{ 
                        'bg-white text-green-600 shadow-sm': activeTab === 'opened', 
                        'text-gray-500 hover:text-gray-700 hover:bg-gray-100': activeTab !== 'opened' 
                    }"
                    class="px-4 py-2 font-bold rounded-lg transition-all duration-200 flex items-center gap-2">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12c0-1.232-.046-2.453-.138-3.662a4.5 4.5 0 00-4.5-4.5H9.75a4.5 4.5 0 00-4.5 4.5v.005c-.091 1.209-.138 2.43-.138 3.662a4.5 4.5 0 004.5 4.5h3.75a4.5 4.5 0 004.5-4.5z" /></svg>
                สินเชื่อที่ยังเคลื่อนไหว
            </button>
            <button @click="activeTab = 'closed'"
                    :class="{ 
                        'bg-white text-gray-600 shadow-sm': activeTab === 'closed', 
                        'text-gray-500 hover:text-gray-700 hover:bg-gray-100': activeTab !== 'closed' 
                    }"
                    class="px-4 py-2 font-bold rounded-lg transition-all duration-200 flex items-center gap-2">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                สินเชื่อที่ปิดบัญชีแล้ว
            </button>
        </nav>
    </div>

    <div class="p-6">
        <div class="overflow-x-auto">
            <div x-show="activeTab === 'opened'" x-transition>
                <table class="datatable-init w-full text-sm">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">เลขที่/ชื่อสัญญา</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">วันที่ทำสัญญา</th>
                            <th class="px-6 py-3 text-right text-xs font-semibold text-slate-500 uppercase tracking-wider">ยอดอนุมัติ</th>
                            <th class="px-6 py-3 text-right text-xs font-semibold text-slate-500 uppercase tracking-wider">ยอดคงเหลือ</th>
                            <th class="px-6 py-3"></th>
                        </tr>
                    </thead>
                    <tbody class="text-slate-700">
                        @forelse($opened_credit_member as $item)
                            <tr class="border-b border-slate-200 last:border-b-0 hover:bg-slate-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="font-semibold text-slate-900">{{ $item->LSUB_NAME }}</div>
                                    <div class="text-xs text-slate-500 font-mono">{{ $item->LCONT_ID }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $item->LCONT_DATE ? thaidate('j M Y', strtotime($item->LCONT_DATE)) : '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-slate-600">{{ number_format($item->LCONT_APPROVE_SAL, 2) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right font-bold text-red-600">{{ number_format($item->LCONT_AMOUNT_SAL, 2) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <form action="/loan_details" method="POST"> @csrf
                                        <input type="hidden" name="code" value="{{ $item->CODE }}"><input type="hidden" name="br_no" value="{{ $item->BR_NO }}">
                                        <button type="submit" class="px-4 py-2 bg-blue-100 text-blue-700 hover:bg-blue-200 text-xs font-bold rounded-full transition-colors">ดูรายการ</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-center py-12 text-gray-500">ไม่พบข้อมูลสินเชื่อที่ยังเคลื่อนไหว</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div x-show="activeTab === 'closed'" x-transition style="display: none;">
                <table class="datatable-init w-full text-sm">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">เลขที่/ชื่อสัญญา</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">วันที่ทำสัญญา</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">วันที่ปิดสัญญา</th>
                            <th class="px-6 py-3 text-right text-xs font-semibold text-slate-500 uppercase tracking-wider">ยอดอนุมัติ</th>
                            <th class="px-6 py-3"></th>
                        </tr>
                    </thead>
                    <tbody class="text-slate-700">
                        @forelse($closed_credit_member as $item)
                            <tr class="border-b border-slate-200 last:border-b-0 hover:bg-slate-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="font-semibold text-slate-900">{{ $item->LSUB_NAME }}</div>
                                    <div class="text-xs text-slate-500 font-mono">{{ $item->LCONT_ID }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $item->LCONT_DATE ? thaidate('j M Y', strtotime($item->LCONT_DATE)) : '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-green-600 font-semibold">{{ $item->END_PAYDEPT ? thaidate('j M Y', strtotime($item->END_PAYDEPT)) : '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-slate-600">{{ number_format($item->LCONT_APPROVE_SAL, 2) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <form action="/loan_details" method="POST"> @csrf
                                        <input type="hidden" name="code" value="{{ $item->CODE }}"><input type="hidden" name="br_no" value="{{ $item->BR_NO }}">
                                        <button type="submit" class="px-4 py-2 bg-blue-100 text-blue-700 hover:bg-blue-200 text-xs font-bold rounded-full transition-colors">ดูรายการ</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-center py-12 text-gray-500">ไม่พบข้อมูลสินเชื่อที่ปิดบัญชีแล้ว</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
