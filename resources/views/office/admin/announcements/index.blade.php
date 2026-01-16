@extends('layouts.admin-layout')

@section('title', 'จัดการประกาศสำหรับเจ้าหน้าที่')

@section('header')
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                <i class="fas fa-bullhorn text-emerald-600"></i> จัดการประกาศเจ้าหน้าที่
            </h2>
            <nav class="flex text-sm text-gray-500 mt-1" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2">
                    <li class="inline-flex items-center">
                        <a href="#" class="hover:text-emerald-600">Admin</a>
                    </li>
                    <li><i class="fas fa-chevron-right text-xs"></i></li>
                    <li class="text-gray-400" aria-current="page">รายการประกาศ</li>
                </ol>
            </nav>
        </div>
        
        <a href="{{ route('announcements.create') }}" 
           class="btn bg-emerald-600 hover:bg-emerald-700 text-white border-none shadow-md gap-2">
            <i class="fas fa-plus"></i> เพิ่มประกาศใหม่
        </a>
    </div>
@endsection

@section('content')
    <div class="container mx-auto max-w-7xl">

        <div class="card bg-white shadow-lg border border-gray-100 overflow-hidden">
            <div class="h-2 bg-gradient-to-r from-emerald-500 to-teal-400"></div>

            <div class="p-6 md:p-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-lg bg-emerald-100 flex items-center justify-center text-emerald-600 shadow-sm">
                        <i class="fas fa-clipboard-list text-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-800">รายการประกาศทั้งหมด</h3>
                        <p class="text-xs text-gray-500 mt-1">เพิ่ม ลบ แก้ไข ประกาศและแบบฟอร์มภายในองค์กร</p>
                    </div>
                </div>

                <div class="rounded-lg border border-gray-100 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="table w-full">
                            <thead class="bg-gray-50 text-gray-500 font-bold text-sm">
                                <tr>
                                    <th class="py-4 px-6 text-center w-32">ประเภท</th>
                                    <th class="py-4 px-6 text-left">หัวข้อประกาศ</th>
                                    <th class="py-4 px-6 text-center w-40">วันที่อัปโหลด</th>
                                    <th class="py-4 px-6 text-center w-32">ไฟล์แนบ</th>
                                    <th class="py-4 px-6 text-center w-32">จัดการ</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-700">
                                @forelse ($announcements as $item)
                                    <tr class="hover:bg-emerald-50/40 transition-colors border-b border-gray-100 last:border-none group">
                                        <td class="py-4 px-6 text-center">
                                            @php
                                                $badgeClass = match ($item->type_announcement) {
                                                    'ทั่วไป' => 'badge-info bg-blue-100 text-blue-700 border-blue-200',
                                                    'แบบฟอร์ม' => 'badge-success bg-emerald-100 text-emerald-700 border-emerald-200',
                                                    default => 'badge-ghost bg-gray-100 text-gray-600 border-gray-200',
                                                };
                                            @endphp
                                            <span class="badge {{ $badgeClass }} border font-medium">
                                                {{ $item->type_announcement }}
                                            </span>
                                        </td>

                                        <td class="py-4 px-6">
                                            <div class="font-bold text-gray-800 text-base mb-1 group-hover:text-emerald-700 transition-colors">
                                                {{ $item->title }}
                                            </div>
                                        </td>

                                        <td class="py-4 px-6 text-center whitespace-nowrap text-sm">
                                            <div class="inline-flex items-center gap-2 text-gray-500">
                                                <i class="far fa-calendar-alt text-emerald-500"></i>
                                                {{ thaidate('j M Y', $item->date) }}
                                            </div>
                                        </td>

                                        <td class="py-4 px-6 text-center">
                                            @if ($item->file_exists)
                                                <a href="{{ asset('file/inside_publish/' . $item->uploadfile) }}" target="_blank"
                                                   class="btn btn-sm btn-ghost text-emerald-600 hover:bg-emerald-100 hover:text-emerald-700 tooltip tooltip-top"
                                                   data-tip="ดาวน์โหลดไฟล์">
                                                    <i class="fas fa-file-download text-lg"></i>
                                                </a>
                                            @else
                                                <span class="text-gray-300 tooltip tooltip-top cursor-not-allowed" data-tip="ไม่มีไฟล์">
                                                    <i class="fas fa-ban text-lg"></i>
                                                </span>
                                            @endif
                                        </td>

                                        <td class="py-4 px-6 text-center">
                                            <div class="flex items-center justify-center gap-2">
                                                <a href="{{ route('announcements.edit', $item->id) }}" 
                                                   class="btn btn-sm btn-circle btn-ghost text-amber-500 hover:bg-amber-100 tooltip tooltip-top" 
                                                   data-tip="แก้ไข">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                <form id="delete-form-{{ $item->id }}" 
                                                      action="{{ route('announcements.destroy', $item->id) }}" 
                                                      method="POST" class="inline-block">
                                                    @csrf
                                                    {{-- ถ้า route destroy ใช้ method DELETE --}}
                                                    {{-- @method('DELETE') --}} 
                                                    <button type="button" 
                                                            onclick="confirmDelete('{{ $item->id }}')"
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
                                        <td colspan="5" class="py-16 text-center text-gray-400">
                                            <div class="flex flex-col items-center justify-center">
                                                <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                                                    <i class="fas fa-inbox text-3xl opacity-30"></i>
                                                </div>
                                                <p>ไม่พบข้อมูลประกาศ</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                @if($announcements->hasPages())
                    <div class="mt-6 border-t border-gray-100 pt-4 flex justify-end">
                        {{ $announcements->links('vendor.pagination.daisyui') }}
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{-- SweetAlert2 --}}
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'ยืนยันการลบ?',
                text: "ข้อมูลประกาศและไฟล์แนบจะถูกลบถาวร!",
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