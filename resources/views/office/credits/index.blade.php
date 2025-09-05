@extends('layouts.admin-layout')

@section('title', 'รายการสินเชื่อ')

@section('content')
    <section class="p-6 bg-white rounded-xl shadow-sm">
        <div class="mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">รายการสินเชื่อที่อัปโหลด</h2>
            <p class="text-sm text-gray-500">รวมรายการสินเชื่อที่เจ้าหน้าที่ได้อัปโหลดเข้าระบบ</p>
        </div>

        <div class="overflow-x-auto">
            <table class="datatable-init min-w-full border border-gray-200 text-gray-700 text-sm">
                <thead class="bg-indigo-100 text-indigo-700 uppercase text-xs font-semibold">
                    <tr>
                        <th class="px-5 py-3 border-b border-indigo-200 text-left">เลขที่สัญญา</th>
                        <th class="px-5 py-3 border-b border-indigo-200 text-left">ชื่อ</th>
                        <th class="px-5 py-3 border-b border-indigo-200 text-left">ผู้อัปโหลด</th>
                        <th class="px-5 py-3 border-b border-indigo-200 text-left">วันที่อัปโหลด</th>
                        <th class="px-5 py-3 border-b border-indigo-200 text-center">สถานะ</th>
                        <th class="px-5 py-3 border-b border-indigo-200 text-center">จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($credits as $credit)
                        <tr class="border-b border-gray-200 hover:bg-indigo-50 transition-colors duration-200">
                            <td class="px-5 py-3 whitespace-nowrap font-mono">{{ $credit->fullcont_id }}</td>
                            <td class="px-5 py-3 whitespace-nowrap font-medium">{{ $credit->fname }} {{ $credit->lname }}</td>
                            <td class="px-5 py-3 whitespace-nowrap">{{ $credit->name_upload }}</td>
                            <td class="px-5 py-3 whitespace-nowrap">{{ thaidate('j M Y', $credit->date_upload) }}</td>
                            <td class="px-5 py-3 text-center">
                                @if ($credit->file_exists)
                                    <span
                                        class="inline-block px-3 py-1 text-green-800 bg-green-100 rounded-full font-semibold text-xs">มีไฟล์</span>
                                @else
                                    <span
                                        class="inline-block px-3 py-1 text-red-700 bg-red-100 rounded-full font-semibold text-xs">ไม่มีไฟล์</span>
                                @endif
                            </td>
                            <td class="px-5 py-3 text-center space-x-2">
                                @if ($credit->file_exists)
                                    <a href="{{ url('file/credit_folder/' . $credit->file_name) }}" target="_blank"
                                        class="inline-block px-4 py-1 bg-blue-600 text-white rounded shadow hover:bg-blue-700 transition">
                                        ดาวน์โหลด
                                    </a>

                                    <form action="{{ route('credit.delete', $credit->id) }}" method="POST" class="inline-block"
                                        onsubmit="return confirm('คุณแน่ใจว่าต้องการลบไฟล์นี้?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="inline-block px-4 py-1 bg-red-600 text-white rounded shadow hover:bg-red-700 transition">
                                            ลบ
                                        </button>
                                    </form>
                                @else
                                    <span class="text-gray-400 italic">ไม่มีไฟล์</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
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

