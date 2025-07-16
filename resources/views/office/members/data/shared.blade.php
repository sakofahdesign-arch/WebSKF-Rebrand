<div class="bg-white rounded-2xl shadow-xl border border-gray-200/80">

    <div class="p-6 border-b border-gray-200 flex justify-between items-center">
        <div class="flex items-center">
            <div class="w-12 h-12 flex items-center justify-center bg-green-100 rounded-full mr-4">
                <svg class="w-6 h-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-3.75-2.25M21 18l-3.75-2.25m0 0l-3.75 2.25M15 15.75l-3.75 2.25" />
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-slate-800">ข้อมูลหุ้น</h3>
        </div>
        <a href="#" class="text-sm font-semibold text-blue-600 hover:underline">พิมพ์ใบหุ้น</a>
    </div>

    @if ($stock_exists)
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 p-6 bg-slate-50 border-b border-gray-200">
            <div class="bg-white p-4 rounded-xl shadow-sm border flex items-center gap-4">
                <div class="w-10 h-10 flex-shrink-0 flex items-center justify-center bg-green-100 rounded-full text-green-600">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21 12a2.25 2.25 0 00-2.25-2.25H15a3 3 0 11-6 0H5.25A2.25 2.25 0 003 12m18 0v6a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 18v-6m18 0V9M3 12V9m18 3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
                <div>
                    <span class="text-2xl font-bold text-green-600">{{ number_format($stock_select->SHR_SUM_BTH, 2) }}</span>
                    <strong class="block text-xs text-slate-500">มูลค่าหุ้นทั้งหมด</strong>
                </div>
            </div>
            <div class="bg-white p-4 rounded-xl shadow-sm border flex items-center gap-4">
                <div class="w-10 h-10 flex-shrink-0 flex items-center justify-center bg-sky-100 rounded-full text-sky-600">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0h18" /></svg>
                </div>
                <div>
                    <span class="text-2xl font-bold text-slate-800">{{ $stock_select->MEM_AGE_OLD + $stock_age->total }}</span>
                    <strong class="block text-xs text-slate-500">อายุสมาชิก (เดือน)</strong>
                </div>
            </div>
            <div class="bg-white p-4 rounded-xl shadow-sm border flex items-center gap-4">
                <div class="w-10 h-10 flex-shrink-0 flex items-center justify-center bg-amber-100 rounded-full text-amber-600">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" /></svg>
                </div>
                <div>
                    <span class="text-2xl font-bold text-slate-800">{{ number_format($stock_select->POINT_SHR, 2) }}</span>
                    <strong class="block text-xs text-slate-500">คะแนนสะสม</strong>
                </div>
            </div>
            <div class="bg-white p-4 rounded-xl shadow-sm border flex items-center gap-4">
                <div class="w-10 h-10 flex-shrink-0 flex items-center justify-center bg-pink-100 rounded-full text-pink-600">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21 11.25v8.25a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 19.5v-8.25M12 4.875A2.625 2.625 0 1014.625 7.5H9.375A2.625 2.625 0 1012 4.875z" /></svg>
                </div>
                <div>
                    <span class="text-2xl font-bold text-slate-800">{{ $dividend ? number_format($dividend->SHR_SUMUP_DIV, 2) : 'N/A' }}</span>
                    <strong class="block text-xs text-slate-500">ปันผลปี 2566</strong>
                </div>
            </div>
        </div>

        <div class="p-6">
            <h4 class="text-lg font-bold text-slate-700 mb-4">รายการเคลื่อนไหวหุ้น</h4>
            <div class="overflow-x-auto">
                <table class="datatable-init w-full text-sm">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">วันที่</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">เลขที่ใบเสร็จ</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">ประเภท</th>
                            <th class="px-6 py-3 text-right text-xs font-semibold text-slate-500 uppercase tracking-wider">จำนวนหุ้น</th>
                            <th class="px-6 py-3 text-right text-xs font-semibold text-slate-500 uppercase tracking-wider">จำนวนเงิน (บาท)</th>
                            <th class="px-6 py-3 text-right text-xs font-semibold text-slate-500 uppercase tracking-wider">มูลค่าคงเหลือ (บาท)</th>
                        </tr>
                    </thead>
                    <tbody class="text-slate-700">
                        @foreach ($stock_details as $item)
                            <tr class="border-b border-slate-200 last:border-b-0 hover:bg-slate-50">
                                <td class="px-6 py-4 whitespace-nowrap">{{ $item->TMP_DATE_TODAY ? thaidate('j M Y', $item->TMP_DATE_TODAY) : '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap font-mono">{{ $item->SLIP_NO }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2.5 py-1 text-xs font-semibold leading-tight text-blue-700 bg-blue-100 rounded-full">{{ $item->SHR_NA }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right">{{ $item->TMP_SHARE_QTY }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right">{{ number_format($item->TMP_SHARE_BHT, 2) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right font-bold text-slate-900">{{ number_format($item->SHR_SUM_BTH, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="text-center py-16 text-gray-500">
             <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" /></svg>
             <h3 class="mt-2 text-lg font-medium text-gray-800">ไม่พบข้อมูลหุ้น</h3>
             <p class="mt-1 text-sm">ไม่พบข้อมูลหุ้นของสมาชิกรายนี้ในระบบ</p>
        </div>
    @endif
</div>