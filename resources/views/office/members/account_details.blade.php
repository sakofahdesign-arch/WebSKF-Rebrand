@extends('layouts.admin-layout')

@section('title', 'รายละเอียดบัญชี ' . ($account_info->ACCOUNT_NO ?? ''))

@section('content')
<div class="bg-gray-100 min-h-screen">
    <div class="container mx-auto px-4 py-12">

        <div class="flex flex-col sm:flex-row justify-between items-start mb-8">
            <div>
                <h1 class="text-3xl md:text-4xl font-bold text-gray-800">
                    รายละเอียดบัญชี
                </h1>
                <p class="text-lg text-gray-500 mt-1">
                    ภาพรวมและรายการเคลื่อนไหวบัญชีของ: <span class="font-semibold text-gray-700">{{ $account_info->ACCOUNT_NAME ?? 'N/A' }}</span>
                </p>
            </div>
            <a href="{{ url()->previous() }}" class="mt-4 sm:mt-0 inline-flex items-center px-4 py-2 bg-white text-gray-700 font-bold rounded-lg hover:bg-gray-200 transition duration-300 border shadow-sm">
                <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" /></svg>
                กลับ
            </a>
        </div>
        
        <div class="bg-white rounded-2xl shadow-xl border border-gray-200/80">
            <div class="p-6 flex flex-col md:flex-row justify-between items-start gap-6 border-b border-gray-200">
                <div>
                    <h3 class="text-sm font-semibold text-gray-400 uppercase tracking-wider">บัญชี</h3>
                    <p class="text-2xl font-bold text-gray-800">{{ $account_info->ACCOUNT_NAME ?? 'N/A' }}</p>
                    <p class="text-base text-gray-600 font-mono">{{ $account_info->ACCOUNT_NO ?? 'N/A' }}</p>
                </div>
                 <div class="w-full md:w-auto text-left md:text-right">
                    <h3 class="text-sm font-semibold text-gray-400 uppercase tracking-wider">ยอดเงินคงเหลือปัจจุบัน</h3>
                    <p class="text-4xl font-bold text-green-600">
                        {{ $account->first() ? number_format($account->first()->F_BALANCE, 2) : '0.00' }}
                        <span class="text-2xl font-medium text-gray-500">บาท</span>
                    </p>
                </div>
            </div>

            <div class="p-6">
                <h4 class="text-lg font-bold text-slate-700 mb-4">รายการเคลื่อนไหวในบัญชี</h4>
                <div class="overflow-x-auto">
                    <table class="datatable-init w-full text-sm">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">วันที่</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">รายการ</th>
                                <th class="px-6 py-3 text-right text-xs font-semibold text-slate-500 uppercase tracking-wider">เงินฝาก</th>
                                <th class="px-6 py-3 text-right text-xs font-semibold text-slate-500 uppercase tracking-wider">เงินถอน</th>
                                <th class="px-6 py-3 text-right text-xs font-semibold text-slate-500 uppercase tracking-wider">ยอดคงเหลือ</th>
                            </tr>
                        </thead>
                        <tbody class="text-slate-700">
                            @forelse ($account as $item)
                            <tr class="border-b border-slate-200 last:border-b-0 hover:bg-slate-50">
                                <td class="px-6 py-4 whitespace-nowrap text-slate-600">
                                    {{ $item->F_TIME ? thaidate('j M Y', strtotime($item->F_TIME)) : '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap font-semibold">
                                    @if($item->F_DEP > 0)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <svg class="w-3 h-3 mr-1.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd"></path></svg>
                                            รายการฝาก
                                        </span>
                                    @elseif($item->F_WDL > 0)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            <svg class="w-3 h-3 mr-1.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 000 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path></svg>
                                            รายการถอน
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-800">
                                            <svg class="w-3 h-3 mr-1.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM18.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" /></svg>
                                            รายการอื่นๆ
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right font-medium text-green-600">
                                    {{ $item->F_DEP > 0 ? '+ ' . number_format($item->F_DEP, 2) : '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right font-medium text-red-600">
                                    {{ $item->F_WDL > 0 ? '- ' . number_format($item->F_WDL, 2) : '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right font-bold text-slate-900">
                                    {{ number_format($item->F_BALANCE, 2) }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-16 text-gray-500">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" /></svg>
                                    <h3 class="mt-2 text-lg font-medium text-gray-800">ไม่พบรายการเคลื่อนไหว</h3>
                                    <p class="mt-1 text-sm">ยังไม่มีรายการเคลื่อนไหวในบัญชีนี้</p>
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