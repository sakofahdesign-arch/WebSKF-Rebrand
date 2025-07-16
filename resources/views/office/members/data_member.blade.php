@extends('layouts.admin-layout')
@section('title', 'ข้อมูลสมาชิก: ' . $data_member->FNAME . ' ' . $data_member->LNAME)





@section('content')
    <div class="container mx-auto space-y-8">
        <div class="flex flex-col sm:flex-row justify-between items-start">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800">
                    ข้อมูลสมาชิก
                </h1>
                <p class="text-lg text-gray-600">{{ $data_member->FNAME . ' ' . $data_member->LNAME }}</p>
            </div>
            <a href="{{ route('member') }}"
                class="mt-4 sm:mt-0 inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 font-bold rounded-lg hover:bg-gray-300 transition duration-300">
                <i class="fas fa-arrow-left mr-2"></i>
                กลับไปหน้าค้นหา
            </a>
        </div>
        @include('office.members.data.profile')
        @include('office.members.data.deposit')
        @include('office.members.data.shared')
        @include('office.members.data.loan')
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
@push('styles')
    <style>
        .datatable-wrapper .dataTable-bottom {
            padding: 1.5rem !important;
            border-top: 1px solid #e5e7eb !important;
            background-color: #f9fafb !important;
        }

        .datatable-wrapper .dataTable-info {
            font-size: 0.875rem !important;
            color: #6b7280 !important;
        }

        .datatable-wrapper .dataTable-pagination ul {
            gap: 0.25rem !important;
        }

        .datatable-wrapper .dataTable-pagination li a,
        .datatable-wrapper .dataTable-pagination li span {
            border-radius: 0.5rem !important;
            transition: all 0.2s ease-in-out !important;
        }

        .datatable-wrapper .dataTable-pagination .active a,
        .datatable-wrapper .dataTable-pagination .active a:hover {
            background-color: #2563eb !important;
            color: white !important;
            border-color: #2563eb !important;
        }
    </style>
@endpush