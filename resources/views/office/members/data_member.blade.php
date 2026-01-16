@extends('layouts.admin-layout')
@section('title', 'ข้อมูลสมาชิก: ' . $data_member->FNAME . ' ' . $data_member->LNAME)

@section('header')
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h2 class="text-2xl font-semibold text-gray-800">
                <i class="fas fa-user-circle text-emerald-600 mr-2"></i> ข้อมูลสมาชิก
            </h2>

        </div>

        <a href="{{ route('member') }}"
            class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 hover:text-emerald-700 transition shadow-sm">
            <i class="fas fa-arrow-left mr-2"></i> กลับหน้าค้นหา
        </a>
    </div>
@endsection

@section('content')
    <div class="container mx-auto max-w-7xl" x-data="{ activeTab: 'profile' }">



        <div class="mb-6 overflow-x-auto">
            <div class="flex space-x-2 border-b border-gray-200 min-w-max pb-1">
                <button @click="activeTab = 'profile'"
                    :class="activeTab === 'profile' ? 'border-emerald-500 text-emerald-600 bg-emerald-50' :
                        'border-transparent text-gray-500 hover:text-gray-700 hover:bg-gray-50'"
                    class="group inline-flex items-center py-3 px-6 border-b-2 font-medium text-sm rounded-t-lg transition-all duration-200">
                    <i class="fas fa-user mr-2"
                        :class="activeTab === 'profile' ? 'text-emerald-500' : 'text-gray-400'"></i>
                    ข้อมูลส่วนตัว
                </button>

                <button @click="activeTab = 'deposit'"
                    :class="activeTab === 'deposit' ? 'border-emerald-500 text-emerald-600 bg-emerald-50' :
                        'border-transparent text-gray-500 hover:text-gray-700 hover:bg-gray-50'"
                    class="group inline-flex items-center py-3 px-6 border-b-2 font-medium text-sm rounded-t-lg transition-all duration-200">
                    <i class="fas fa-piggy-bank mr-2"
                        :class="activeTab === 'deposit' ? 'text-emerald-500' : 'text-gray-400'"></i>
                    บัญชีเงินฝาก
                </button>

                <button @click="activeTab = 'share'"
                    :class="activeTab === 'share' ? 'border-emerald-500 text-emerald-600 bg-emerald-50' :
                        'border-transparent text-gray-500 hover:text-gray-700 hover:bg-gray-50'"
                    class="group inline-flex items-center py-3 px-6 border-b-2 font-medium text-sm rounded-t-lg transition-all duration-200">
                    <i class="fas fa-chart-pie mr-2"
                        :class="activeTab === 'share' ? 'text-emerald-500' : 'text-gray-400'"></i>
                    ข้อมูลหุ้น
                </button>

                <button @click="activeTab = 'loan'"
                    :class="activeTab === 'loan' ? 'border-emerald-500 text-emerald-600 bg-emerald-50' :
                        'border-transparent text-gray-500 hover:text-gray-700 hover:bg-gray-50'"
                    class="group inline-flex items-center py-3 px-6 border-b-2 font-medium text-sm rounded-t-lg transition-all duration-200">
                    <i class="fas fa-file-invoice-dollar mr-2"
                        :class="activeTab === 'loan' ? 'text-emerald-500' : 'text-gray-400'"></i>
                    ข้อมูลสินเชื่อ
                </button>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 min-h-[400px]">

            <div x-show="activeTab === 'profile'" x-transition.opacity class="p-6">
                @include('office.members.data.profile')
            </div>

            <div x-show="activeTab === 'deposit'" x-transition.opacity class="p-6" style="display: none;">
                @include('office.members.data.deposit')
            </div>

            <div x-show="activeTab === 'share'" x-transition.opacity class="p-6" style="display: none;">
                @include('office.members.data.shared')
            </div>

            <div x-show="activeTab === 'loan'" x-transition.opacity class="p-6" style="display: none;">
                @include('office.members.data.loan')
            </div>

        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $(".stockTable").DataTable({
                "pageLength": 20,       
                "lengthChange": false,  
                "searching": false,     
                "ordering": false,       
                "info": true,           
                "language": {           
                    "paginate": {
                        "previous": "ก่อนหน้า",
                        "next": "ถัดไป"
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" />
@endpush
