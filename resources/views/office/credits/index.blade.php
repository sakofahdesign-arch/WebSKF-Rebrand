@extends('layouts.admin-layout')

@section('title', 'asdasdfsdf')

@section('content')
    <section class="p-6 bg-white rounded-xl shadow-sm">
        <div class="mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">รายการสินเชื่อที่อัปโหลด</h2>
            <p class="text-sm text-gray-500">รวมรายการสินเชื่อที่เจ้าหน้าที่ได้อัปโหลดเข้าระบบ</p>
        </div>

        <div class="overflow-x-auto">
            <table class="datatable-init min-w-full bg-white border border-gray-200 text-sm text-left text-gray-700">
                <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                    <tr>
                        <th class="px-4 py-3 border-b">เลขที่สัญญา</th>
                        <th class="px-4 py-3 border-b">ชื่อ</th>
                        <th class="px-4 py-3 border-b">ผู้อัปโหลด</th>
                        <th class="px-4 py-3 border-b">วันที่อัปโหลด</th>
                        <th class="px-4 py-3 border-b text-center">สถานะ</th>
                        <th class="px-4 py-3 border-b text-center"></th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($credits as $credit)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-2 whitespace-nowrap">{{ $credit->fullcont_id }}</td>
                            <td class="px-4 py-2 whitespace-nowrap">{{ $credit->fname }} {{ $credit->lname }}</td>
                            <td class="px-4 py-2 whitespace-nowrap">{{ $credit->name_upload }}</td>
                            <td class="px-4 py-2 whitespace-nowrap">{{ thaidate('j M Y', $credit->date_upload) }}</td>
                            <td class="text-center">
                                @if ($credit->file_exists)
                                    <span class="text-green-600 font-semibold">มีไฟล์</span>
                                @else
                                    <span class="text-red-500">ไม่มีไฟล์</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if ($credit->file_exists)
                                    <a href="{{ url('file/credit_folder/' . $credit->file_name) }}"
                                        class="inline-flex items-center px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 transition"
                                        target="_blank">
                                        ดาวน์โหลด
                                    </a>

                                    <form action="{{ route('credit.delete', $credit->id) }}" method="POST" class="inline-block" onsubmit="return confirm('คุณแน่ใจว่าต้องการลบไฟล์นี้?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition">
                                            ลบ
                                        </button>
                                    </form>
                                @else
                                    <span class="text-gray-400">ไม่มีไฟล์</span>
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
        document.addEventListener('DOMContentLoaded', function() {
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

@include('components.sweetalert2')