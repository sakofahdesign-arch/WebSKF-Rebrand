@extends('layouts.admin-layout')

@section('title', 'รายละเอียดสินเชื่อ ' . ($loan_select->LCONT_ID ?? ''))

@section('header')
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                <i class="fas fa-file-invoice-dollar text-emerald-600"></i> รายละเอียดสินเชื่อ
            </h2>
            <nav class="flex text-sm text-gray-500 mt-1" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2">
                    <li class="inline-flex items-center">
                        <a href="#" onclick="window.history.back();" class="hover:text-emerald-600">ข้อมูลสมาชิก</a>
                    </li>
                    <li><i class="fas fa-chevron-right text-xs"></i></li>
                    <li class="text-gray-400" aria-current="page">{{ $loan_select->LCONT_ID ?? 'N/A' }}</li>
                </ol>
            </nav>
        </div>
        
        <a href="#" onclick="window.history.back();"
           class="btn btn-sm btn-outline text-gray-600 hover:bg-gray-100 hover:text-gray-800 border-gray-300 font-normal gap-2">
            <i class="fas fa-arrow-left"></i> ย้อนกลับ
        </a>
    </div>
@endsection

@section('content')
    <div class="container mx-auto max-w-7xl space-y-6">

        <div class="card bg-white shadow-lg border border-gray-100 overflow-hidden">
            <div class="h-2 bg-gradient-to-r from-emerald-500 to-teal-400"></div>
            
            <div class="card-body p-6 md:p-8">
                <div class="flex flex-col md:flex-row justify-between items-start gap-6 mb-6">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 rounded-2xl bg-emerald-100 flex items-center justify-center text-emerald-600 shadow-sm">
                            <i class="fas fa-hand-holding-usd text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl md:text-2xl font-bold text-gray-800">{{ $loan_select->LSUB_NAME ?? 'ไม่ระบุประเภท' }}</h3>
                            <div class="flex items-center gap-2 mt-1">
                                <span class="badge badge-lg bg-gray-100 text-gray-600 font-mono border-gray-200">
                                    {{ $loan_select->LCONT_ID ?? 'N/A' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    
                    <div class="stat bg-blue-50/50 rounded-xl border border-blue-100 p-4">
                        <div class="stat-figure text-blue-500">
                            <div class="w-8 h-8 rounded-full bg-white flex items-center justify-center shadow-sm">
                                <i class="fas fa-check-circle"></i>
                            </div>
                        </div>
                        <div class="stat-title text-xs font-bold text-blue-600 uppercase tracking-wide">ยอดอนุมัติ</div>
                        <div class="stat-value text-xl font-bold text-blue-700 mt-1">
                            {{ number_format($loan_select->LCONT_APPROVE_SAL, 2) }}
                        </div>
                    </div>

                    <div class="stat bg-rose-50/50 rounded-xl border border-rose-100 p-4">
                        <div class="stat-figure text-rose-500">
                            <div class="w-8 h-8 rounded-full bg-white flex items-center justify-center shadow-sm">
                                <i class="fas fa-exclamation-circle"></i>
                            </div>
                        </div>
                        <div class="stat-title text-xs font-bold text-rose-600 uppercase tracking-wide">ยอดคงเหลือ</div>
                        <div class="stat-value text-xl font-bold text-rose-700 mt-1">
                            {{ number_format($loan_select->LCONT_AMOUNT_SAL, 2) }}
                        </div>
                    </div>

                    <div class="stat bg-gray-50/50 rounded-xl border border-gray-200 p-4">
                        <div class="stat-figure text-gray-400">
                            <div class="w-8 h-8 rounded-full bg-white flex items-center justify-center shadow-sm">
                                <i class="far fa-calendar-alt"></i>
                            </div>
                        </div>
                        <div class="stat-title text-xs font-bold text-gray-500 uppercase tracking-wide">วันที่ทำสัญญา</div>
                        <div class="stat-value text-lg font-semibold text-gray-700 mt-1">
                            {{ $loan_select->LCONT_DATE ? thaidate('j M Y', strtotime($loan_select->LCONT_DATE)) : '-' }}
                        </div>
                    </div>

                    <div class="stat bg-gray-50/50 rounded-xl border border-gray-200 p-4">
                        <div class="stat-figure text-gray-400">
                            <div class="w-8 h-8 rounded-full bg-white flex items-center justify-center shadow-sm">
                                <i class="far fa-calendar-check"></i>
                            </div>
                        </div>
                        <div class="stat-title text-xs font-bold text-gray-500 uppercase tracking-wide">วันที่หมดสัญญา</div>
                        <div class="stat-value text-lg font-semibold text-gray-700 mt-1">
                            {{ $loan_select->END_PAYDEPT ? thaidate('j M Y', strtotime($loan_select->END_PAYDEPT)) : '-' }}
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="card bg-white shadow-lg border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100 flex items-center justify-between bg-gray-50/50">
                <h4 class="text-lg font-bold text-gray-700 flex items-center gap-2">
                    <i class="fas fa-history text-emerald-500"></i> ประวัติการชำระ
                </h4>
            </div>

            <div class="p-0">
                <div class="overflow-x-auto">
                    <table id="loanTable" class="w-full text-sm">
                        <thead class="bg-gray-50 text-gray-500 font-bold border-b border-gray-200">
                            <tr>
                                <th class="py-4 px-6 text-left w-32">วันที่</th>
                                <th class="py-4 px-6 text-center w-24">งวดที่</th>
                                <th class="py-4 px-6 text-right w-40">ยอดชำระ (บาท)</th>
                                <th class="py-4 px-6 text-right w-40">คงเหลือ (บาท)</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700 divide-y divide-gray-100">
                            @forelse ($loan_detail as $item)
                            <tr class="hover:bg-emerald-50/30 transition-colors">
                                <td class="py-4 px-6 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <i class="far fa-clock text-gray-400 text-xs"></i>
                                        {{ $item->LPD_DATE ? thaidate('j M Y', strtotime($item->LPD_DATE)) : '-' }}
                                    </div>
                                </td>

                                <td class="py-4 px-6 text-center">
                                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-gray-100 text-gray-600 text-xs font-bold border border-gray-200">
                                        {{ $item->LPD_NUM_INST }}
                                    </span>
                                </td>

                                <td class="py-4 px-6 text-right">
                                    <span class="font-bold text-emerald-600">+{{ number_format($item->SUM_SAL, 2) }}</span>
                                </td>

                                <td class="py-4 px-6 text-right">
                                    <span class="font-bold text-gray-800 bg-gray-50 px-2 py-1 rounded-md border border-gray-100">
                                        {{ number_format($item->LCONT_BAL_AMOUNT, 2) }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="py-16 text-center text-gray-400">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-3">
                                            <i class="fas fa-file-invoice text-2xl opacity-30"></i>
                                        </div>
                                        <p>ยังไม่มีประวัติการชำระ</p>
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
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" />
    <script>
        $(document).ready(function() {
            $('#loanTable').DataTable({
                "pageLength": 20,
                "lengthChange": false,
                "searching": false,
                "ordering": false,
                "info": true,
                "language": {
                    "paginate": {
                        "previous": "<i class='fas fa-chevron-left'></i>",
                        "next": "<i class='fas fa-chevron-right'></i>"
                    },
                    "info": "แสดง _START_ ถึง _END_ จาก _TOTAL_ รายการ",
                    "infoEmpty": "ไม่มีข้อมูล",
                    "emptyTable": "ไม่พบข้อมูลในตาราง"
                }
            });
        });
    </script>
@endpush

@push('styles')
    <style>
        /* CSS ปรับแต่ง Datatable ให้สวยงามแบบ Tailwind */
        .dataTables_wrapper .dataTables_paginate {
            display: flex;
            justify-content: flex-end;
            gap: 0.25rem;
            padding-top: 1rem;
            padding-bottom: 1rem;
            padding-right: 1.5rem;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            border-radius: 0.5rem;
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
            color: #4B5563;
            cursor: pointer;
            transition: all 0.2s;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover:not(.disabled) {
            background: #ECFDF5;
            color: #047857;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: #10B981;
            color: white;
            font-weight: 600;
        }

        .dataTables_wrapper .dataTables_info {
            padding-top: 1.25rem;
            padding-left: 1.5rem;
            font-size: 0.875rem;
            color: #6B7280;
        }
    </style>
@endpush