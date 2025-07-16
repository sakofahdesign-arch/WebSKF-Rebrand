<div class="bg-white rounded-2xl shadow-xl border border-gray-200/80">
    
    <div class="p-6 border-b border-gray-200 flex justify-between items-center">
        <div class="flex items-center">
            <div class="w-12 h-12 flex items-center justify-center bg-blue-100 rounded-full mr-4">
                <svg class="w-6 h-6 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a2.25 2.25 0 00-2.25-2.25H15a3 3 0 11-6 0H5.25A2.25 2.25 0 003 12m18 0v6a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 18v-6m18 0V9M3 12V9m18 3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-slate-800">บัญชีเงินฝาก</h3>
        </div>
        <a href="#" class="text-sm font-semibold text-blue-600 hover:underline">ดูทั้งหมด</a>
    </div>
    
    <div class="p-6">
        <div class="overflow-x-auto">
            <table class="datatable-init w-full text-sm">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">ชื่อบัญชี / เลขบัญชี</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-slate-500 uppercase tracking-wider">ยอดคงเหลือ (บาท)</th>
                        <th class="px-6 py-3"></th>
                    </tr>
                </thead>
                <tbody class="text-slate-700">
                    @forelse ($deposit_member as $item)
                        <tr class="border-t border-slate-200 hover:bg-slate-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-base font-semibold text-slate-900">{{ $item->ACCOUNT_NAME }}</div>
                                <div class="text-xs text-slate-500 font-mono">{{ $item->ACCOUNT_NO }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <div class="text-base font-bold text-emerald-600">{{ number_format($item->BALANCE, 2) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                 <form action="/account_details" method="POST">
                                    @csrf
                                    <input type="hidden" name="account_number" value="{{ $item->ACCOUNT_NO }}">
                                    <button type="submit" class="px-4 py-2 bg-blue-100 text-blue-700 hover:bg-blue-200 text-xs font-bold rounded-full transition-colors duration-200">
                                        ดูรายการ
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center py-12 text-gray-500">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" /></svg>
                                <h3 class="mt-2 text-lg font-medium text-gray-800">ไม่พบข้อมูลบัญชีเงินฝาก</h3>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>