<div class="card bg-white shadow-lg border border-gray-100 overflow-hidden">
    <div class="h-2 bg-gradient-to-r from-emerald-500 to-teal-400"></div>

    <div class="p-6 md:p-8">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8 border-b border-gray-100 pb-6">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-2xl bg-emerald-100 flex items-center justify-center text-emerald-600 shadow-sm">
                    <i class="fas fa-chart-line text-2xl"></i>
                </div>
                <div>
                    <h3 class="text-2xl font-bold text-gray-800">ข้อมูลหุ้น</h3>
                    <p class="text-sm text-gray-500 mt-1">รายละเอียดและประวัติการถือครองหุ้น</p>
                </div>
            </div>
            
            <a href="#" class="btn btn-sm btn-outline btn-success hover:text-white gap-2 transition-all">
                <i class="fas fa-print"></i> พิมพ์ใบหุ้น
            </a>
        </div>

        @if (isset($stock_exists) && $stock_exists)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                
                <div class="stat bg-emerald-50/50 rounded-xl border border-emerald-100 p-4 transition-transform hover:-translate-y-1 duration-300">
                    <div class="stat-figure text-emerald-600">
                        <div class="w-10 h-10 rounded-full bg-white flex items-center justify-center shadow-sm">
                            <i class="fas fa-coins"></i>
                        </div>
                    </div>
                    <div class="stat-title text-xs font-semibold text-emerald-600 uppercase tracking-wide">มูลค่าหุ้นทั้งหมด</div>
                    <div class="stat-value text-2xl font-bold text-emerald-700 mt-1">
                        {{ number_format($stock_select->SHR_SUM_BTH, 2) }}
                    </div>
                    <div class="stat-desc text-emerald-500 font-medium">บาท</div>
                </div>

                <div class="stat bg-sky-50/50 rounded-xl border border-sky-100 p-4 transition-transform hover:-translate-y-1 duration-300">
                    <div class="stat-figure text-sky-600">
                        <div class="w-10 h-10 rounded-full bg-white flex items-center justify-center shadow-sm">
                            <i class="fas fa-user-clock"></i>
                        </div>
                    </div>
                    <div class="stat-title text-xs font-semibold text-sky-600 uppercase tracking-wide">อายุสมาชิก</div>
                    <div class="stat-value text-2xl font-bold text-sky-700 mt-1">
                        {{ $stock_select->MEM_AGE_OLD + $stock_age->total }}
                    </div>
                    <div class="stat-desc text-sky-500 font-medium">เดือน</div>
                </div>

                <div class="stat bg-amber-50/50 rounded-xl border border-amber-100 p-4 transition-transform hover:-translate-y-1 duration-300">
                    <div class="stat-figure text-amber-600">
                        <div class="w-10 h-10 rounded-full bg-white flex items-center justify-center shadow-sm">
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <div class="stat-title text-xs font-semibold text-amber-600 uppercase tracking-wide">คะแนนสะสม</div>
                    <div class="stat-value text-2xl font-bold text-amber-700 mt-1">
                        {{ number_format($stock_select->POINT_SHR, 2) }}
                    </div>
                    <div class="stat-desc text-amber-500 font-medium">คะแนน</div>
                </div>

                <div class="stat bg-pink-50/50 rounded-xl border border-pink-100 p-4 transition-transform hover:-translate-y-1 duration-300">
                    <div class="stat-figure text-pink-600">
                        <div class="w-10 h-10 rounded-full bg-white flex items-center justify-center shadow-sm">
                            <i class="fas fa-hand-holding-usd"></i>
                        </div>
                    </div>
                    <div class="stat-title text-xs font-semibold text-pink-600 uppercase tracking-wide">ปันผลปี {{ thaidate('Y', strtotime('-1 year')) }}</div>
                    <div class="stat-value text-2xl font-bold text-pink-700 mt-1">
                        {{ $dividend ? number_format($dividend->SHR_SUMUP_DIV, 2) : '-' }}
                    </div>
                    <div class="stat-desc text-pink-500 font-medium">บาท</div>
                </div>
            </div>

            <div class="border-t border-gray-100 pt-6">
                <div class="flex items-center gap-2 mb-4">
                    <i class="fas fa-list-ul text-emerald-500"></i>
                    <h4 class="text-lg font-bold text-gray-700">รายการเคลื่อนไหวหุ้น</h4>
                </div>

                <div class="rounded-lg border border-gray-100 overflow-hidden">
                    <table class="stockTable w-full text-sm">
                        <thead class="bg-gray-50 text-gray-500 font-bold">
                            <tr>
                                <th class="py-3 px-4 text-left w-32">วันที่</th>
                                <th class="py-3 px-4 text-left">เลขที่ใบเสร็จ</th>
                                <th class="py-3 px-4 text-center">ประเภท</th>
                                <th class="py-3 px-4 text-right">จำนวนหุ้น</th>
                                <th class="py-3 px-4 text-right">จำนวนเงิน (บาท)</th>
                                <th class="py-3 px-4 text-right">คงเหลือ (บาท)</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700">
                            @foreach ($stock_details as $item)
                                <tr class="hover:bg-emerald-50/40 transition-colors border-b border-gray-100">
                                    <td class="py-3 px-4 whitespace-nowrap">
                                        <div class="font-medium text-gray-600">
                                            {{ $item->TMP_DATE_TODAY ? thaidate('j M Y', $item->TMP_DATE_TODAY) : '-' }}
                                        </div>
                                    </td>
                                    
                                    <td class="py-3 px-4 font-mono text-gray-500">
                                        {{ $item->SLIP_NO }}
                                    </td>

                                    <td class="py-3 px-4 text-center">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-50 text-blue-600 border border-blue-100">
                                            {{ $item->SHR_NA }}
                                        </span>
                                    </td>

                                    <td class="py-3 px-4 text-right">
                                        {{ number_format($item->TMP_SHARE_QTY) }}
                                    </td>

                                    <td class="py-3 px-4 text-right font-bold text-emerald-600">
                                        {{ number_format($item->TMP_SHARE_BHT, 2) }}
                                    </td>

                                    <td class="py-3 px-4 text-right text-gray-800 font-semibold bg-gray-50/50">
                                        {{ number_format($item->SHR_SUM_BTH, 2) }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        @else
            <div class="py-16 text-center">
                <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-folder-open text-3xl text-gray-300"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-700">ไม่พบข้อมูลหุ้น</h3>
                <p class="text-gray-500 mt-1">สมาชิกรายนี้ยังไม่มีประวัติการถือครองหุ้น</p>
            </div>
        @endif
    </div>
</div>


