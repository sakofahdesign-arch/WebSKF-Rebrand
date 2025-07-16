@extends('layouts.admin-layout')

@section('title', 'รายละเอียดสินเชื่อ ' . ($loan_select->LCONT_ID ?? ''))

@section('content')
<div class="bg-gray-100 min-h-screen">
    <div class="container mx-auto px-4 py-12 space-y-8">

        <div class="flex flex-col sm:flex-row justify-between items-start">
            <div>
                <h1 class="text-3xl md:text-4xl font-bold text-gray-800">
                    รายละเอียดสินเชื่อ
                </h1>
                <p class="text-lg text-gray-500 mt-1">
                    <span class="font-semibold text-gray-700">{{ $loan_select->LSUB_NAME ?? 'N/A' }}</span>
                    <span class="font-mono text-sm">({{ $loan_select->LCONT_ID ?? 'N/A' }})</span>
                </p>
            </div>
            <a href="{{ url()->previous() }}" class="mt-4 sm:mt-0 inline-flex items-center px-4 py-2 bg-white text-gray-700 font-bold rounded-lg hover:bg-gray-200 transition duration-300 border shadow-sm">
                <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" /></svg>
                กลับ
            </a>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white p-6 rounded-2xl shadow-lg border">
                <div class="flex items-center">
                    <div class="w-12 h-12 flex items-center justify-center bg-blue-100 rounded-full mr-4 text-blue-600">
                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">ยอดอนุมัติ</p>
                        <p class="text-2xl font-bold text-gray-800">{{ number_format($loan_select->LCONT_APPROVE_SAL, 2) }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-lg border">
                 <div class="flex items-center">
                    <div class="w-12 h-12 flex items-center justify-center bg-red-100 rounded-full mr-4 text-red-600">
                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">ยอดคงเหลือ</p>
                        <p class="text-2xl font-bold text-red-600">{{ number_format($loan_select->LCONT_AMOUNT_SAL, 2) }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-lg border">
                 <div class="flex items-center">
                    <div class="w-12 h-12 flex items-center justify-center bg-gray-100 rounded-full mr-4 text-gray-600">
                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0h18" /></svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">วันที่ทำสัญญา</p>
                        <p class="text-lg font-semibold text-gray-800">{{ $loan_select->LCONT_DATE ? thaidate('j M Y', strtotime($loan_select->LCONT_DATE)) : '-' }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-lg border">
                 <div class="flex items-center">
                    <div class="w-12 h-12 flex items-center justify-center bg-gray-100 rounded-full mr-4 text-gray-600">
                         <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z" /></svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">วันที่หมดสัญญา</p>
                        <p class="text-lg font-semibold text-gray-800">{{ $loan_select->END_PAYDEPT ? thaidate('j M Y', strtotime($loan_select->END_PAYDEPT)) : '-' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-xl border border-gray-200/80">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-xl font-bold text-slate-800">ประวัติการชำระ</h3>
            </div>
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="datatable-init w-full text-sm">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">วันที่</th>
                                <th class="px-6 py-3 text-center text-xs font-semibold text-slate-500 uppercase tracking-wider">งวดที่</th>
                                <th class="px-6 py-3 text-right text-xs font-semibold text-slate-500 uppercase tracking-wider">ยอดชำระ (บาท)</th>
                                <th class="px-6 py-3 text-right text-xs font-semibold text-slate-500 uppercase tracking-wider">ยอดคงเหลือ (บาท)</th>
                            </tr>
                        </thead>
                        <tbody class="text-slate-700">
                            @forelse ($loan_detail as $item)
                            <tr class="border-b border-slate-200 last:border-b-0 hover:bg-slate-50">
                                <td class="px-6 py-4 whitespace-nowrap">{{ $item->LPD_DATE ? thaidate('j M Y', strtotime($item->LPD_DATE)) : '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span class="px-3 py-1 text-xs font-semibold leading-tight text-slate-700 bg-slate-100 rounded-full">{{ $item->LPD_NUM_INST }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right font-semibold text-green-600">
                                    {{ number_format($item->SUM_SAL, 2) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right font-bold text-slate-900">
                                    {{ number_format($item->LCONT_BAL_AMOUNT, 2) }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-16 text-gray-500">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" /></svg>
                                    <h3 class="mt-2 text-lg font-medium text-gray-800">ไม่พบประวัติการชำระ</h3>
                                    <p class="mt-1 text-sm">ยังไม่มีประวัติการชำระสำหรับสินเชื่อนี้</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@9.0.3"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const allTables = document.querySelectorAll(".datatable-init");
            if (allTables.length > 0 && typeof simpleDatatables.DataTable !== 'undefined') {
                allTables.forEach(table => {
                    new simpleDatatables.DataTable(table, {
                        searchable: false,
                        perPageSelect: false,
                        labels: {
                            placeholder: "ค้นหา...",
                            perPage: "{select} รายการต่อหน้า",
                            noRows: "ไม่พบข้อมูล",
                            info: "แสดง {start} ถึง {end} จาก {rows} รายการ",
                        }
                    });
                });
            }
        });
    </script>
@endpush
