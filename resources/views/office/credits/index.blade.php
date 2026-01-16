@extends('layouts.admin-layout')

@section('title', 'รายการสินเชื่อ')

@section('header')
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                <i class="fas fa-list-alt text-emerald-600"></i> รายการสินเชื่อที่อัปโหลด
            </h2>
            <nav class="flex text-sm text-gray-500 mt-1" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2">
                    <li class="inline-flex items-center">
                        <a href="#" class="hover:text-emerald-600">งานสินเชื่อ</a>
                    </li>
                    <li><i class="fas fa-chevron-right text-xs"></i></li>
                    <li class="text-gray-400" aria-current="page">รายการอัปโหลด</li>
                </ol>
            </nav>
        </div>
    </div>
@endsection

@section('content')
    <div class="container mx-auto max-w-7xl">

        <div class="card bg-white shadow-lg border border-gray-100 overflow-hidden">
            <div class="h-2 bg-gradient-to-r from-emerald-500 to-teal-400"></div>

            <div class="p-6 md:p-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-lg bg-emerald-100 flex items-center justify-center text-emerald-600 shadow-sm">
                        <i class="fas fa-file-invoice-dollar text-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-800">รายการสินเชื่อทั้งหมด</h3>
                        <p class="text-xs text-gray-500 mt-1">จัดการไฟล์เอกสารสินเชื่อที่เจ้าหน้าที่ได้อัปโหลดเข้าระบบ</p>
                    </div>
                </div>

                <div class="rounded-lg border border-gray-100 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table id="creditTable" class="table w-full">
                            <thead class="bg-gray-50 text-gray-500 font-bold text-sm">
                                <tr>
                                    <th class="py-4 px-6 text-left">เลขที่สัญญา</th>
                                    <th class="py-4 px-6 text-left">ชื่อ-สกุล</th>
                                    <th class="py-4 px-6 text-center">ผู้อัปโหลด</th>
                                    <th class="py-4 px-6 text-center">วันที่อัปโหลด</th>
                                    <th class="py-4 px-6 text-center">สถานะ</th>
                                    <th class="py-4 px-6 text-center">จัดการ</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-700">
                                @foreach ($credits as $credit)
                                    <tr class="hover:bg-emerald-50/40 transition-colors border-b border-gray-100 last:border-none">
                                        <td class="py-4 px-6 font-mono font-medium text-emerald-700">
                                            {{ $credit->fullcont_id }}
                                        </td>

                                        <td class="py-4 px-6 font-semibold text-gray-800">
                                            {{ $credit->fname }} {{ $credit->lname }}
                                        </td>

                                        <td class="py-4 px-6 text-center">
                                            <div class="inline-flex items-center gap-2 px-3 py-1 bg-gray-50 rounded-full text-xs text-gray-600 border border-gray-200">
                                                <i class="fas fa-user-circle"></i> {{ $credit->name_upload }}
                                            </div>
                                        </td>

                                        <td class="py-4 px-6 text-center whitespace-nowrap text-sm">
                                            {{ thaidate('j M Y', $credit->date_upload) }}
                                        </td>

                                        <td class="py-4 px-6 text-center">
                                            @if ($credit->file_exists)
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-200">
                                                    <i class="fas fa-check-circle"></i> มีไฟล์
                                                </span>
                                            @else
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-rose-50 text-rose-700 border border-rose-200">
                                                    <i class="fas fa-times-circle"></i> ไม่มีไฟล์
                                                </span>
                                            @endif
                                        </td>

                                        <td class="py-4 px-6 text-center">
                                            <div class="flex items-center justify-center gap-2">
                                                @if ($credit->file_exists)
                                                    <a href="{{ url('file/credit_folder/' . $credit->file_name) }}" target="_blank"
                                                       class="btn btn-sm bg-emerald-600 hover:bg-emerald-700 text-white border-none tooltip tooltip-top"
                                                       data-tip="ดาวน์โหลด">
                                                        <i class="fas fa-download"></i>
                                                    </a>

                                                    <form action="{{ route('credit.delete', $credit->id) }}" method="POST" class="inline-block"
                                                          onsubmit="return confirm('คุณแน่ใจว่าต้องการลบไฟล์สัญญานี้? การกระทำนี้ไม่สามารถย้อนกลับได้');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" 
                                                                class="btn btn-sm bg-rose-100 hover:bg-rose-200 text-rose-600 border-none tooltip tooltip-top"
                                                                data-tip="ลบไฟล์">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                @else
                                                    <button class="btn btn-sm btn-disabled btn-ghost opacity-20" disabled>
                                                        <i class="fas fa-ban"></i>
                                                    </button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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
            $('#creditTable').DataTable({
                "pageLength": 20,
                "lengthChange": false,
                "searching": false, // เปิดให้ค้นหาได้
                "ordering": false,
                "info": true,
                "language": {
                    "search": "ค้นหา:",
                    "paginate": {
                        "previous": "<i class='fas fa-chevron-left'></i>",
                        "next": "<i class='fas fa-chevron-right'></i>"
                    },
                    "info": "แสดง _START_ ถึง _END_ จาก _TOTAL_ รายการ",
                    "infoEmpty": "ไม่มีข้อมูล",
                    "emptyTable": "ไม่พบข้อมูลในตาราง",
                    "zeroRecords": "ไม่พบข้อมูลที่ตรงกัน"
                },
                "columnDefs": [
                    { "orderable": false, "targets": [5] } // ห้ามจัดเรียงคอลัมน์ "จัดการ"
                ]
            });
        });
    </script>
@endpush

@push('styles')
    <style>
        /* CSS ปรับแต่ง Datatable ให้สวยงามแบบ Tailwind */
        .dataTables_wrapper .dataTables_filter input {
            border: 1px solid #e5e7eb;
            border-radius: 0.5rem;
            padding: 0.4rem 0.8rem;
            margin-left: 0.5rem;
            outline: none;
            font-size: 0.875rem;
        }
        .dataTables_wrapper .dataTables_filter input:focus {
            border-color: #10B981;
            box-shadow: 0 0 0 2px rgba(16, 185, 129, 0.1);
        }
        
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