@extends('layouts.admin-layout')

@section('title', 'ค้นหาสินเชื่อ')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-6">ค้นหาสินเชื่อ</h1>

    <!-- Search Form Card -->
    <div class="bg-white p-6 rounded-xl shadow-lg mb-8">
        <form action="{{ route('searchcredit') }}" method="GET">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Year Select -->
                <div>
                    <label for="year" class="block text-sm font-medium text-gray-700">ปีที่ทำสัญญา</label>
                    <select id="year" name="year" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
                        <option value="">-- เลือกปี --</option>
                        <option value="2568" {{ request('year') == 2568 ? 'selected' : '' }}>{{ 2568 }}</option>
                        <option value="2567" {{ request('year') == 2567 ? 'selected' : '' }}>{{ 2567 }}</option>
                        <option value="2566" {{ request('year') == 2566 ? 'selected' : '' }}>{{ 2566 }}</option>
                        <option value="2565" {{ request('year') == 2565 ? 'selected' : '' }}>{{ 2565 }}</option>
                        <option value="2564" {{ request('year') == 2564 ? 'selected' : '' }}>{{ 2564 }}</option>
                    </select>
                </div>

                <!-- Branch Select -->
                <div>
                    <label for="branch_id" class="block text-sm font-medium text-gray-700">สาขา</label>
                    <select id="branch_id" name="branch_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
                        <option value="">-- ทุกสาขา --</option>
                        <option value="000" {{ request('branch_id') == '000' ? 'selected' : '' }}>สำนักงานใหญ่</option>
                        <option value="001" {{ request('branch_id') == '001' ? 'selected' : '' }}>กระบี่</option>
                        <option value="002" {{ request('branch_id') == '002' ? 'selected' : '' }}>คลองยาง</option>
                        <option value="003" {{ request('branch_id') == '003' ? 'selected' : '' }}>อ่าวลึก</option>
                        <option value="004" {{ request('branch_id') == '004' ? 'selected' : '' }}>กาญจนดิษฐ์</option>
                        <option value="005" {{ request('branch_id') == '005' ? 'selected' : '' }}>คลองท่อม</option>
                        <option value="006" {{ request('branch_id') == '006' ? 'selected' : '' }}>อ่าวนาง</option>
                        <option value="007" {{ request('branch_id') == '007' ? 'selected' : '' }}>ห้วยลึก</option>
                        <option value="008" {{ request('branch_id') == '008' ? 'selected' : '' }}>เกาะลันตา</option>
                        <option value="009" {{ request('branch_id') == '009' ? 'selected' : '' }}>สาขาเหนือคลอง</option>
                    </select>
                </div>

                <!-- Credit Type Select -->
                <div>
                    <label for="credit_id" class="block text-sm font-medium text-gray-700">ประเภทสัญญา</label>
                    <select id="credit_id" name="credit_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
                        <option value="">-- ทุกประเภท --</option>
                        <option value="1" {{ request('credit_id') == '1' ? 'selected' : '' }}>ฉุกเฉิน</option>
                        <option value="2" {{ request('credit_id') == '2' ? 'selected' : '' }}>สามัญฉุกเฉิน</option>
                        <option value="3" {{ request('credit_id') == '3' ? 'selected' : '' }}>สามัญ</option>
                        <option value="4" {{ request('credit_id') == '4' ? 'selected' : '' }}>พิเศษ</option>
                        <option value="5" {{ request('credit_id') == '5' ? 'selected' : '' }}>พิเศษโครงการ</option>
                        <option value="6" {{ request('credit_id') == '6' ? 'selected' : '' }}>โครงการสินทรัพย์</option>
                        <option value="7" {{ request('credit_id') == '7' ? 'selected' : '' }}>สวัสดิการเจ้าหน้าที่</option>
                    </select>
                </div>

                 <!-- Member ID Input -->
                <div>
                    <label for="mem_id" class="block text-sm font-medium text-gray-700">เลขสมาชิก</label>
                    <input type="text" id="mem_id" name="mem_id" value="{{ request('mem_id') }}" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md focus:ring-green-500 focus:border-green-500" placeholder="ระบุเลขสมาชิก (ถ้ามี)">
                </div>

            </div>

            <!-- Form Actions -->
            <div class="mt-6 pt-6 border-t border-gray-200 flex items-center justify-end gap-4">
                <a href="{{ route('searchcredit') }}" class="bg-gray-200 text-gray-700 font-bold py-2 px-4 rounded-lg hover:bg-gray-300 transition duration-300">
                    <i class="fas fa-eraser mr-2"></i>
                    ล้างข้อมูล
                </a>
                <button type="submit" class="bg-green-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-green-700 transition duration-300">
                    <i class="fas fa-search mr-2"></i>
                    ค้นหาสินเชื่อ
                </button>
            </div>
        </form>
    </div>

    <!-- Search Results Section -->
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="p-6 border-b flex justify-between items-center">
            <h3 class="text-xl font-semibold text-gray-800">ผลการค้นหา</h3>
            @if(isset($data))
                <span class="text-sm text-gray-500">พบ {{ $data->total() }} รายการ</span>
            @endif
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="text-center bg-gray-50">
                    <tr>
                        <th class="p-4 font-semibold text-gray-600 uppercase tracking-wider">เลขที่สัญญา</th>
                        <th class="p-4 font-semibold text-gray-600 uppercase tracking-wider text-left">ชื่อ</th>
                        <th class="p-4 font-semibold text-gray-600 uppercase tracking-wider">ผู้อัปโหลด</th>
                        <th class="p-4 font-semibold text-gray-600 uppercase tracking-wider">วันที่อัปโหลด</th>
                        <th class="p-4 font-semibold text-gray-600 uppercase tracking-wider">ดาวน์โหลด</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    @forelse ($data as $item)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="p-4 text-center">
                            <p class="font-semibold text-gray-800">{{ $item->fullcont_id }}</p>
                            <p class="text-xs text-gray-500">{{ $item->name_branch }}</p>
                            <p class="text-xs text-gray-500">{{ $item->credit_name }} ({{ $item->year }})</p>
                        </td>
                        <td class="p-4 text-left">{{ $item->fname . '  ' . $item->lname }}</td>
                        <td class="p-4 text-center">{{ $item->name_upload }}</td>
                        <td class="p-4 text-center">{{ thaidate('j M Y', strtotime($item->date_upload)) }}</td>
                        <td class="p-4 text-center">
                            <a href="{{ asset('file/credit_folder/' . $item->file_name) }}" target="_blank" class="inline-flex items-center justify-center w-10 h-10 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition-colors duration-200" aria-label="ดาวน์โหลด">
                                <i class="fas fa-download"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-10 text-gray-500">
                                <i class="fas fa-inbox fa-2x mb-2 text-gray-400"></i>
                                <p>ไม่พบข้อมูลสินเชื่อที่ตรงกับเงื่อนไข</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if(isset($data) && $data->hasPages())
            <div class="p-4 bg-gray-50 border-t">
                {{ $data->links() }}
            </div>
        @endif
    </div>
</div>
@endsection

@include('components.sweetalert2')