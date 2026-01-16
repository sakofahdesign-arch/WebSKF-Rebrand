@extends('layouts.admin-layout')

@section('title', 'จัดการข่าวสาร')

@section('header')
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                <i class="fas fa-newspaper text-emerald-600"></i> จัดการข่าวสารและประกาศ
            </h2>
            <nav class="flex text-sm text-gray-500 mt-1" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2">
                    <li class="inline-flex items-center">
                        <a href="#" class="hover:text-emerald-600">Admin</a>
                    </li>
                    <li><i class="fas fa-chevron-right text-xs"></i></li>
                    <li class="text-gray-400" aria-current="page">รายการข่าวสาร</li>
                </ol>
            </nav>
        </div>

        <a href="{{ route('news.create') }}"
            class="btn bg-emerald-600 hover:bg-emerald-700 text-white border-none shadow-md gap-2">
            <i class="fas fa-plus"></i> เพิ่มข่าวสารใหม่
        </a>
    </div>
@endsection

@section('content')
    <div class="container mx-auto max-w-7xl">

        <div class="card bg-white shadow-lg border border-gray-100 overflow-hidden">
            <div class="h-2 bg-gradient-to-r from-emerald-500 to-teal-400"></div>

            <div class="p-6 md:p-8">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-10 h-10 rounded-lg bg-emerald-100 flex items-center justify-center text-emerald-600 shadow-sm">
                            <i class="fas fa-list-ul text-lg"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-800">รายการข่าวสารทั้งหมด</h3>
                            <p class="text-xs text-gray-500 mt-1">จัดการ แก้ไข หรือลบข่าวประชาสัมพันธ์</p>
                        </div>
                    </div>

                    {{-- แสดงจำนวนรายการ --}}
                    @if (isset($data))
                        <div class="text-sm text-gray-500">
                            ทั้งหมด {{ $data->total() }} รายการ
                        </div>
                    @endif
                </div>

                <div class="rounded-lg border border-gray-100 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="table w-full">
                            <thead class="bg-gray-50 text-gray-500 font-bold text-sm">
                                <tr>
                                    <th class="py-4 px-6 text-left">หัวข้อข่าว</th>
                                    <th class="py-4 px-6 text-center w-40">ประเภท</th>
                                    <th class="py-4 px-6 text-center w-40">วันที่เผยแพร่</th>
                                    <th class="py-4 px-6 text-center w-32">จัดการ</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-700">
                                @forelse ($data as $item)
                                    <tr
                                        class="hover:bg-emerald-50/40 transition-colors border-b border-gray-100 last:border-none group">
                                        <td class="py-4 px-6 align-top">
                                            <div class="font-semibold text-gray-800 text-base mb-1 group-hover:text-emerald-700 transition-colors"
                                                title="{{ $item->title }}">
                                                {{ Str::limit($item->title, 60) }} {{-- จำกัดความยาวหัวข้อข่าว --}}
                                            </div>
                                        </td>

                                        <td class="py-4 px-6 text-center align-middle whitespace-nowrap">
                                            <span class="badge badge-ghost bg-gray-100 text-gray-600 border-gray-200">
                                                {{ $item->news_typename ?? 'ทั่วไป' }}
                                            </span>
                                        </td>

                                        <td class="py-4 px-6 text-center align-middle whitespace-nowrap text-sm">
                                            <div class="inline-flex items-center gap-2 text-gray-500">
                                                <i class="far fa-calendar-alt text-emerald-500"></i>
                                                {{ $item->dateupload ? thaidate('j M Y', strtotime($item->dateupload)) : '-' }}
                                            </div>
                                        </td>

                                        <td class="py-4 px-6 text-center align-middle">
                                            <div class="flex items-center justify-center gap-2">
                                                <a href="{{ route('news.edit', $item->news_number) }}"
                                                    class="btn btn-sm btn-circle btn-ghost text-amber-500 hover:bg-amber-100 tooltip tooltip-top"
                                                    data-tip="แก้ไข">
                                                    <i class="fas fa-pen"></i>
                                                </a>

                                                <form id="delete-form-{{ $item->news_number }}"
                                                    action="{{ route('news.destroy', $item->news_number) }}" method="POST"
                                                    class="inline-block">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="button"
                                                        onclick="confirmDelete('{{ $item->news_number }}')"
                                                        class="btn btn-sm btn-circle btn-ghost text-rose-500 hover:bg-rose-100 tooltip tooltip-top"
                                                        data-tip="ลบ">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="py-16 text-center text-gray-400">
                                            <div class="flex flex-col items-center justify-center">
                                                <div
                                                    class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                                                    <i class="fas fa-inbox text-3xl opacity-30"></i>
                                                </div>
                                                <p>ไม่พบข้อมูลข่าวสาร</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                @if (isset($data) && $data->hasPages())
                    <div class="mt-6 pt-4 border-t border-gray-100 flex justify-end">
                        {{ $data->links('vendor.pagination.daisyui') }}
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'ยืนยันการลบ?',
                text: "ข้อมูลข่าวสารนี้จะถูกลบถาวร ไม่สามารถกู้คืนได้",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444', 
                cancelButtonColor: '#6b7280', 
                confirmButtonText: 'ใช่, ลบเลย!',
                cancelButtonText: 'ยกเลิก',
                background: '#fff',
                customClass: {
                    popup: 'rounded-xl shadow-xl border border-gray-100',
                    confirmButton: 'btn btn-error text-white px-6',
                    cancelButton: 'btn btn-ghost text-gray-500 px-6'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            })
        }
    </script>
@endpush
