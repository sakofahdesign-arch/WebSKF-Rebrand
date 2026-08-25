@extends('layouts.admin-layout')

@section('title', 'Admin จัดการสินทรัพย์')

@section('header')
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                <i class="fas fa-boxes text-emerald-600"></i> จัดการสินทรัพย์
            </h2>
            <nav class="flex text-sm text-gray-500 mt-1" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2">
                    <li class="inline-flex items-center">
                        <a href="#" class="hover:text-emerald-600">Admin</a>
                    </li>
                    <li><i class="fas fa-chevron-right text-xs"></i></li>
                    <li class="text-gray-400" aria-current="page">รายการสินทรัพย์</li>
                </ol>
            </nav>
        </div>
        
        <a href="{{ route('asset.create') }}" 
           class="btn bg-emerald-600 hover:bg-emerald-700 text-white border-none shadow-md gap-2">
            <i class="fas fa-plus"></i> เพิ่มสินทรัพย์ใหม่
        </a>
    </div>
@endsection

@section('content')
    @php
        $assetMapItems = isset($mapAssets) ? $mapAssets : collect();
    @endphp

    <div class="container mx-auto max-w-7xl">
        <div class="card bg-white shadow-lg border border-gray-100 overflow-hidden mb-8">
            <div class="flex flex-col gap-2 border-b border-gray-100 px-6 py-5 md:flex-row md:items-center md:justify-between">
                <div>
                    <h3 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                        <i class="fas fa-map-location-dot text-emerald-600"></i> ภาพรวมตำแหน่งทรัพย์สิน
                    </h3>
                    <p class="text-sm text-gray-500 mt-1">กดหมุดหรือเลือกรายการเพื่อดูรูป รายละเอียด และนำทางด้วย GPS</p>
                </div>
                <span class="badge badge-lg bg-emerald-50 text-emerald-700 border-emerald-100">
                    {{ $assetMapItems->count() }} รายการมีพิกัด
                </span>
            </div>

            <div
                data-asset-sales-map
                data-assets='@json($assetMapItems)'
                class="h-[560px] min-h-[480px] w-full"
            >
                <div class="grid h-full place-items-center bg-slate-950 text-sm font-semibold text-white/70">
                    กำลังโหลดแผนที่ขายทรัพย์สิน
                </div>
            </div>
        </div>

        <div class="card bg-white shadow-lg border border-gray-100 overflow-hidden">
            <div class="h-2 bg-gradient-to-r from-emerald-500 to-teal-400"></div>

            <div class="p-6 md:p-8">
                
                <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-6">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-emerald-100 flex items-center justify-center text-emerald-600 shadow-sm">
                            <i class="fas fa-search text-lg"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800">ค้นหารายการ</h3>
                    </div>

                    <form action="{{ route('asset.index') }}" method="GET" class="w-full md:w-auto">
                        <div class="relative">
                            <input type="text" name="search" value="{{ request('search') }}" 
                                placeholder="ค้นหาจากชื่อ หรือ ประเภท..." 
                                class="input input-bordered w-full md:w-80 pl-10 focus:input-emerald-500 focus:outline-none bg-gray-50 focus:bg-white transition-colors">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="rounded-lg border border-gray-100 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="table w-full">
                            <thead class="bg-gray-50 text-gray-500 font-bold text-sm">
                                <tr>
                                    <th class="py-4 px-6 text-center w-20">ID</th>
                                    <th class="py-4 px-6 text-center w-32">ภาพตัวอย่าง</th>
                                    <th class="py-4 px-6 text-left">รายละเอียดสินทรัพย์</th>
                                    <th class="py-4 px-6 text-left">คำอธิบาย</th>
                                    <th class="py-4 px-6 text-center w-40">วันที่บันทึก</th>
                                    <th class="py-4 px-6 text-center w-32">จัดการ</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-700">
                                @forelse ($assets as $item)
                                    <tr class="hover:bg-emerald-50/40 transition-colors border-b border-gray-100 last:border-none group">
                                        <td class="py-4 px-6 text-center font-mono text-gray-500">
                                            #{{ $item->id }}
                                        </td>

                                        <td class="py-4 px-6 text-center">
                                            <div class="avatar">
                                                <div class="w-20 h-14 rounded-lg shadow-sm border border-gray-100 bg-gray-50">
                                                    @if($item->picture_name)
                                                        <img src="{{ asset('assets/' . $item->picture_name) }}" alt="{{ $item->title }}" class="object-cover" loading="lazy" />
                                                    @else
                                                        <div class="flex items-center justify-center h-full text-gray-300">
                                                            <i class="fas fa-image text-2xl"></i>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>

                                        <td class="py-4 px-6 align-top">
                                            <div class="font-bold text-gray-800 text-base mb-1 group-hover:text-emerald-700 transition-colors">
                                                {{ $item->title }}
                                            </div>
                                            <span class="badge badge-sm badge-ghost bg-emerald-50 text-emerald-700 border-emerald-100">
                                                {{ $item->asset_name ?? 'N/A' }}
                                            </span>
                                            @php
                                                $listingType = $item->listing_type ?? 'sale';
                                                $listingLabel = match ($listingType) {
                                                    'rent' => 'เช่า',
                                                    'inactive' => 'ไม่ขาย',
                                                    default => 'ขาย',
                                                };
                                                $listingClass = match ($listingType) {
                                                    'rent' => 'bg-yellow-50 text-yellow-700 border-yellow-100',
                                                    'inactive' => 'bg-slate-100 text-slate-500 border-slate-200',
                                                    default => 'bg-emerald-50 text-emerald-700 border-emerald-100',
                                                };
                                            @endphp
                                            <span class="badge badge-sm badge-ghost border {{ $listingClass }}">
                                                {{ $listingLabel }}
                                            </span>
                                            @if (!empty($item->latitude) && !empty($item->longitude))
                                                <div class="mt-2 inline-flex items-center gap-1.5 rounded-full bg-slate-50 px-2.5 py-1 text-xs font-semibold text-slate-500">
                                                    <i class="fas fa-location-dot text-emerald-500"></i>
                                                    {{ $item->latitude }}, {{ $item->longitude }}
                                                </div>
                                            @endif
                                            @if (!empty($item->deed_file))
                                                <a href="{{ asset('assets/deeds/' . $item->deed_file) }}" target="_blank"
                                                    class="mt-2 inline-flex items-center gap-1.5 rounded-full bg-amber-50 px-2.5 py-1 text-xs font-semibold text-amber-700 hover:bg-amber-100">
                                                    <i class="fas fa-file-contract"></i> โฉนดที่ดิน
                                                </a>
                                            @endif
                                        </td>

                                        <td class="py-4 px-6 align-top text-sm text-gray-500 max-w-xs truncate">
                                            {{ Str::limit($item->description1, 60) }}
                                        </td>

                                        <td class="py-4 px-6 text-center whitespace-nowrap text-sm">
                                            <div class="inline-flex items-center gap-2 text-gray-500">
                                                <i class="far fa-calendar-alt text-emerald-500"></i>
                                                {{ !empty($item->date) ? thaidate('j M Y', strtotime($item->date)) : '-' }}
                                            </div>
                                        </td>

                                        <td class="py-4 px-6 text-center">
                                            <div class="flex items-center justify-center gap-2">
                                                <a href="{{ route('asset.edit', ['manage_asset' => $item->id]) }}" 
                                                   class="btn btn-sm btn-circle btn-ghost text-amber-500 hover:bg-amber-100 tooltip tooltip-top" 
                                                   data-tip="แก้ไข">
                                                    <i class="fas fa-pen"></i>
                                                </a>

                                                <form id="delete-form-{{ $item->id }}" 
                                                      action="{{ route('asset.destroy', ['manage_asset' => $item->id]) }}" 
                                                      method="POST" class="inline-block">
                                                    @csrf
                                                    @method('DELETE')
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
                                        <td colspan="6" class="py-16 text-center text-gray-400">
                                            <div class="flex flex-col items-center justify-center">
                                                <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                                                    <i class="fas fa-boxes text-3xl opacity-30"></i>
                                                </div>
                                                <h3 class="text-lg font-medium text-gray-600">ไม่พบข้อมูลสินทรัพย์</h3>
                                                <p class="text-sm text-gray-400 mt-1">ลองเปลี่ยนคำค้นหา หรือเพิ่มรายการใหม่</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                @if ($assets->hasPages())
                    <div class="mt-6 border-t border-gray-100 pt-4 flex justify-end">
                        {{ $assets->appends(request()->input())->links('vendor.pagination.daisyui') }}
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{-- SweetAlert2 Script --}}
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'ยืนยันการลบ?',
                text: "ข้อมูลสินทรัพย์และรูปภาพทั้งหมดจะถูกลบถาวร!",
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
