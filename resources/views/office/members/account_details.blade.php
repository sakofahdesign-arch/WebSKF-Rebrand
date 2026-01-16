@extends('layouts.admin-layout')

@section('title', 'รายละเอียดบัญชี ' . ($account_info->ACCOUNT_NO ?? ''))

@section('header')
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                <i class="fas fa-wallet text-emerald-600"></i> รายละเอียดบัญชีเงินฝาก
            </h2>
            <nav class="flex text-sm text-gray-500 mt-1" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2">
                    <li class="inline-flex items-center">
                        <a href="{{ url()->previous() }}" class="hover:text-emerald-600">ข้อมูลสมาชิก</a>
                    </li>
                    <li><i class="fas fa-chevron-right text-xs"></i></li>
                    <li class="text-gray-400" aria-current="page">{{ $account_info->ACCOUNT_NO ?? 'N/A' }}</li>
                </ol>
            </nav>
        </div>

        <a href="{{ url()->previous() }}"
            class="btn btn-sm btn-outline text-gray-600 hover:bg-gray-100 hover:text-gray-800 border-gray-300 font-normal gap-2">
            <i class="fas fa-arrow-left"></i> ย้อนกลับ
        </a>
    </div>
@endsection

@section('content')
    <div class="container mx-auto max-w-7xl space-y-6">

        <div class="card bg-white shadow-lg border border-gray-100 overflow-hidden relative">
            <div
                class="absolute top-0 right-0 w-64 h-64 bg-emerald-50 rounded-full mix-blend-multiply filter blur-3xl opacity-50 -mr-16 -mt-16">
            </div>

            <div class="card-body p-6 md:p-8 relative z-10">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                    <div class="flex items-center gap-4">
                        <div
                            class="w-16 h-16 rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-400 flex items-center justify-center text-white shadow-lg shadow-emerald-200">
                            <i class="fas fa-book text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xs font-bold text-emerald-600 uppercase tracking-wider mb-1">ชื่อบัญชี</h3>
                            <p class="text-xl md:text-2xl font-bold text-gray-800">
                                {{ $account_info->ACCOUNT_NAME ?? 'ไม่ระบุชื่อ' }}</p>
                            <div class="flex items-center gap-2 mt-1">
                                <span class="badge badge-lg bg-gray-100 text-gray-600 font-mono border-gray-200">
                                    {{ $account_info->ACCOUNT_NO ?? 'N/A' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div
                        class="w-full md:w-auto text-left md:text-right bg-emerald-50/50 p-4 rounded-xl border border-emerald-100">
                        <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">ยอดเงินคงเหลือปัจจุบัน
                        </h3>
                        <div class="flex items-baseline md:justify-end gap-2">
                            <span class="text-3xl md:text-4xl font-extrabold text-emerald-600">
                                {{ $account->first() ? number_format($account->first()->F_BALANCE, 2) : '0.00' }}
                            </span>
                            <span class="text-sm font-medium text-gray-500">บาท</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card bg-white shadow-lg border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100 flex items-center justify-between bg-gray-50/50">
                <h4 class="text-lg font-bold text-gray-700 flex items-center gap-2">
                    <i class="fas fa-list-ul text-emerald-500"></i> รายการเคลื่อนไหว (Statement)
                </h4>

                <button class="btn btn-sm btn-ghost text-gray-400 hover:text-emerald-600">
                    <i class="fas fa-print"></i>
                </button>
            </div>

            <div class="p-0">
                <div class="overflow-x-auto">
                    <table id="statementTable" class="w-full text-sm">
                        <thead class="bg-gray-50 text-gray-500 font-bold border-b border-gray-200">
                            <tr>
                                <th class="py-4 px-6 text-left w-32">วันที่</th>
                                <th class="py-4 px-6 text-left">รายการ</th>
                                <th class="py-4 px-6 text-right w-32">ฝาก</th>
                                <th class="py-4 px-6 text-right w-32">ถอน</th>
                                <th class="py-4 px-6 text-right w-32">คงเหลือ</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700 divide-y divide-gray-100">
                            @forelse ($account as $item)
                                <tr class="hover:bg-emerald-50/30 transition-colors">
                                    <td class="py-4 px-6 whitespace-nowrap">
                                        <div class="flex items-center gap-2">
                                            <i class="far fa-calendar text-gray-400 text-xs"></i>
                                            {{ $item->F_TIME ? thaidate('j M Y', strtotime($item->F_TIME)) : '-' }}
                                        </div>
                                    </td>

                                    <td class="py-4 px-6 whitespace-nowrap">
                                        @if ($item->F_DEP > 0)
                                            <span
                                                class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-700 border border-emerald-200">
                                                <i class="fas fa-arrow-down mr-1.5 text-[10px]"></i> ฝากเงิน
                                            </span>
                                        @elseif($item->F_WDL > 0)
                                            <span
                                                class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-rose-100 text-rose-700 border border-rose-200">
                                                <i class="fas fa-arrow-up mr-1.5 text-[10px]"></i> ถอนเงิน
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-600 border border-gray-200">
                                                <i class="fas fa-exchange-alt mr-1.5 text-[10px]"></i> รายการอื่นๆ
                                            </span>
                                        @endif
                                    </td>

                                    <td class="py-4 px-6 whitespace-nowrap text-right">
                                        @if ($item->F_DEP > 0)
                                            <span
                                                class="font-bold text-emerald-600">+{{ number_format($item->F_DEP, 2) }}</span>
                                        @else
                                            <span class="text-gray-300">-</span>
                                        @endif
                                    </td>

                                    <td class="py-4 px-6 whitespace-nowrap text-right">
                                        @if ($item->F_WDL > 0)
                                            <span
                                                class="font-bold text-rose-600">-{{ number_format($item->F_WDL, 2) }}</span>
                                        @else
                                            <span class="text-gray-300">-</span>
                                        @endif
                                    </td>

                                    <td class="py-4 px-6 whitespace-nowrap text-right">
                                        <span
                                            class="font-bold text-gray-800 bg-gray-50 px-2 py-1 rounded-md border border-gray-100">
                                            {{ number_format($item->F_BALANCE, 2) }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-16 text-center text-gray-400">
                                        <div class="flex flex-col items-center justify-center">
                                            <div
                                                class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-3">
                                                <i class="fas fa-history text-2xl opacity-30"></i>
                                            </div>
                                            <p>ไม่พบรายการเคลื่อนไหว</p>
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
            $('#statementTable').DataTable({
                "pageLength": 20, // แสดง 20 รายการ
                "lengthChange": false, // ปิดเมนูเลือกจำนวนหน้า
                "searching": false, // ปิดช่องค้นหา (ถ้าอยากเปิดให้แก้เป็น true)
                "ordering": false, // ปิดการจัดเรียง (เพราะ Statement มักเรียงตามเวลามาแล้ว)
                "info": true, // แสดง info ด้านล่าง
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
