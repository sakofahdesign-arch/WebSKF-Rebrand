@extends('layouts.admin-layout')

@section('title', 'ค้นหาสินเชื่อ')

@section('header')
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                <i class="fas fa-search-dollar text-emerald-600"></i> ค้นหาสินเชื่อ
            </h2>
            <nav class="flex text-sm text-gray-500 mt-1" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2">
                    <li class="inline-flex items-center">
                        <a href="#" class="hover:text-emerald-600">งานสินเชื่อ</a>
                    </li>
                    <li><i class="fas fa-chevron-right text-xs"></i></li>
                    <li class="text-gray-400" aria-current="page">ค้นหาข้อมูล</li>
                </ol>
            </nav>
        </div>
    </div>
@endsection

@section('content')
    <div class="container mx-auto max-w-7xl space-y-8">

        <div class="card bg-white shadow-lg border border-gray-100 overflow-hidden">
    <div class="h-2 bg-gradient-to-r from-emerald-500 to-teal-400"></div>

    <div class="card-body p-6">
        <h3 class="text-lg font-bold text-gray-700 flex items-center gap-2 mb-4">
            <i class="fas fa-filter text-emerald-500"></i> ตัวกรองการค้นหา
        </h3>

        <form action="{{ route('searchcredit') }}" method="GET">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text font-semibold text-gray-700">ปีที่ทำสัญญา</span>
                    </label>
                    {{-- เพิ่ม bg-white และ text-gray-900 เพื่อบังคับสีขาว --}}
                    <select name="year" class="select select-bordered w-full bg-white text-gray-900 focus:select-emerald-500 focus:outline-none">
                        <option value="">-- เลือกปี --</option>
                        @foreach([2568, 2567, 2566, 2565, 2564] as $y)
                            <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>{{ $y }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text font-semibold text-gray-700">สาขา</span>
                    </label>
                    <select name="branch_id" class="select select-bordered w-full bg-white text-gray-900 focus:select-emerald-500 focus:outline-none">
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

                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text font-semibold text-gray-700">ประเภทสัญญา</span>
                    </label>
                    <select name="credit_id" class="select select-bordered w-full bg-white text-gray-900 focus:select-emerald-500 focus:outline-none">
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

                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text font-semibold text-gray-700">เลขสมาชิก</span>
                    </label>
                    <div class="relative">
                        {{-- เพิ่ม bg-white และ text-gray-900 --}}
                        <input type="text" name="mem_id" value="{{ request('mem_id') }}" 
                            class="input input-bordered w-full pl-10 bg-white text-gray-900 focus:input-emerald-500 focus:outline-none placeholder-gray-400" 
                            placeholder="ระบุเลขสมาชิก">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-id-card text-gray-400"></i>
                        </div>
                    </div>
                </div>

            </div>

            <div class="flex items-center justify-end gap-3 mt-8 pt-5 border-t border-gray-100">
                <a href="{{ route('searchcredit') }}" class="btn btn-ghost text-gray-500 hover:bg-gray-100">
                    <i class="fas fa-eraser mr-2"></i> ล้างค่า
                </a>
                <button type="submit" class="btn bg-emerald-600 hover:bg-emerald-700 text-white border-none shadow-md gap-2">
                    <i class="fas fa-search"></i> ค้นหาสินเชื่อ
                </button>
            </div>
        </form>
    </div>
</div>

        <div class="card bg-white shadow-lg border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                <h3 class="text-lg font-bold text-gray-700 flex items-center gap-2">
                    <i class="fas fa-list-ul text-emerald-500"></i> ผลการค้นหา
                </h3>
                @if(isset($data))
                    <span class="badge badge-success text-white">พบ {{ number_format($data->total()) }} รายการ</span>
                @endif
            </div>

            <div class="overflow-x-auto">
                <table class="table w-full">
                    <thead class="bg-gray-50 text-gray-500 font-bold text-sm uppercase">
                        <tr>
                            <th class="py-4 px-6 text-left">รายละเอียดสัญญา</th>
                            <th class="py-4 px-6 text-left">ชื่อ-สกุล</th>
                            <th class="py-4 px-6 text-center">ผู้อัปโหลด</th>
                            <th class="py-4 px-6 text-center">วันที่อัปโหลด</th>
                            <th class="py-4 px-6 text-center">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 divide-y divide-gray-100">
                        @forelse ($data as $item)
                            <tr class="hover:bg-emerald-50/30 transition-colors group">
                                <td class="py-4 px-6">
                                    <div class="flex flex-col">
                                        <span class="font-bold text-emerald-700 text-base">{{ $item->fullcont_id }}</span>
                                        <div class="flex flex-wrap gap-2 mt-1">
                                            <span class="badge badge-sm badge-ghost text-xs border-gray-200">
                                                {{ $item->name_branch }}
                                            </span>
                                            <span class="text-xs text-gray-500 flex items-center">
                                                {{ $item->credit_name }} ({{ $item->year }})
                                            </span>
                                        </div>
                                    </div>
                                </td>

                                <td class="py-4 px-6">
                                    <div class="font-semibold text-gray-800">
                                        {{ $item->fname . '  ' . $item->lname }}
                                    </div>
                                </td>

                                <td class="py-4 px-6 text-center">
                                    <div class="flex items-center justify-center gap-2 text-xs text-gray-500 bg-gray-100 px-3 py-1 rounded-full w-fit mx-auto">
                                        <i class="fas fa-user-circle"></i> {{ $item->name_upload }}
                                    </div>
                                </td>

                                <td class="py-4 px-6 text-center whitespace-nowrap">
                                    <span class="text-sm text-gray-600">
                                        {{ thaidate('j M Y', strtotime($item->date_upload)) }}
                                    </span>
                                </td>

                                <td class="py-4 px-6 text-center">
                                    <a href="{{ asset('file/credit_folder/' . $item->file_name) }}" target="_blank" 
                                       class="btn btn-sm btn-circle btn-ghost text-emerald-600 hover:bg-emerald-100 hover:text-emerald-700 tooltip tooltip-left" 
                                       data-tip="ดาวน์โหลดไฟล์">
                                        <i class="fas fa-cloud-download-alt text-lg"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-16 text-center text-gray-400">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                                            <i class="fas fa-search text-3xl opacity-30"></i>
                                        </div>
                                        <h3 class="text-lg font-medium text-gray-600">ไม่พบข้อมูล</h3>
                                        <p class="text-sm text-gray-400 mt-1">ลองเปลี่ยนเงื่อนไขการค้นหาใหม่</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if(isset($data) && $data->hasPages())
                <div class="p-6 border-t border-gray-100 bg-gray-50 flex justify-end">
                    {{-- ใช้ Pagination สไตล์ Tailwind ที่ Laravel มีให้ หรือตัว Custom DaisyUI ที่ทำไว้ --}}
                    {{ $data->links('pagination::tailwind') }}
                </div>
            @endif
        </div>

    </div>
@endsection