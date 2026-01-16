@extends('layouts.admin-layout')

@section('title', 'ผลการดำเนินงานประจำปี')

@section('header')
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                <i class="fas fa-chart-line text-emerald-600"></i> ผลการดำเนินงานประจำปี
            </h2>
            <nav class="flex text-sm text-gray-500 mt-1" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2">
                    <li class="inline-flex items-center">
                        <a href="#" class="hover:text-emerald-600">เอกสารภายใน</a>
                    </li>
                    <li><i class="fas fa-chevron-right text-xs"></i></li>
                    <li class="text-gray-400" aria-current="page">ผลการดำเนินงาน</li>
                </ol>
            </nav>
        </div>
    </div>
@endsection

@php
    // จัดกลุ่มข้อมูลตามปี พ.ศ.
    $dataByYear = $data->groupBy(function($item) {
        return date('Y', strtotime($item->date)) + 543;
    });
@endphp

@section('content')
    <div class="container mx-auto max-w-5xl space-y-10 pb-12">

        <div class="card bg-gradient-to-r from-emerald-600 to-teal-600 text-white shadow-lg overflow-hidden relative">
            <div class="absolute right-0 top-0 h-full w-1/2 bg-white/5 skew-x-12 transform origin-bottom-right"></div>
            <div class="card-body p-8 relative z-10">
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-white/20 rounded-full backdrop-blur-sm">
                        <i class="fas fa-chart-pie text-3xl"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold">รายงานผลการดำเนินงาน</h2>
                        <p class="opacity-90 mt-1">สรุปงบการเงินและผลประกอบการของสหกรณ์ แยกตามปีบัญชี</p>
                    </div>
                </div>
            </div>
        </div>

        @forelse ($dataByYear as $year => $documents)
            <div class="relative">
                <div class="flex items-center gap-4 mb-4">
                    <div class="bg-emerald-100 text-emerald-700 font-bold px-4 py-1.5 rounded-full shadow-sm text-lg border border-emerald-200">
                        <i class="far fa-calendar-check mr-2"></i> ประจำปี {{ $year }}
                    </div>
                    <div class="h-px bg-gray-200 flex-grow"></div>
                </div>

                <div class="card bg-white shadow-md border border-gray-100 overflow-hidden">
                    <div class="divide-y divide-gray-100">
                        @foreach ($documents as $item)
                            <div class="group p-5 hover:bg-emerald-50/30 transition-all duration-200 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                                
                                <div class="flex items-start gap-4 flex-grow">
                                    <div class="flex-shrink-0 mt-1 sm:mt-0">
                                        <div class="w-12 h-12 rounded-xl bg-red-50 text-red-500 flex items-center justify-center border border-red-100 shadow-sm group-hover:scale-105 transition-transform duration-300">
                                            <i class="fas fa-file-pdf text-xl"></i>
                                        </div>
                                    </div>

                                    <div>
                                        <h4 class="text-base font-bold text-gray-800 group-hover:text-emerald-700 transition-colors leading-snug">
                                            {{ $item->document_name }}
                                        </h4>
                                        <div class="flex flex-wrap items-center gap-3 mt-1.5">
                                            <span class="text-xs text-gray-500 flex items-center gap-1">
                                                <i class="far fa-clock text-emerald-500"></i> 
                                                {{ thaidate('j M Y', strtotime($item->date)) }}
                                            </span>
                                            <span class="badge badge-xs badge-ghost text-[10px] uppercase tracking-wider text-gray-400 border-gray-200">
                                                PDF FILE
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex-shrink-0 w-full sm:w-auto mt-2 sm:mt-0">
                                    <a href="{{ url('file/performance/' . $item->file_name) }}" target="_blank"
                                       class="btn btn-sm btn-ghost bg-emerald-50 text-emerald-600 hover:bg-emerald-600 hover:text-white border-emerald-100 w-full sm:w-auto gap-2 group-hover:shadow-md transition-all">
                                        <i class="fas fa-download"></i>
                                        <span class="sm:hidden lg:inline">ดาวน์โหลดเอกสาร</span>
                                        <span class="hidden sm:inline lg:hidden">โหลด</span>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @empty
            <div class="card bg-white shadow-sm border border-gray-100 p-12 text-center">
                <div class="flex flex-col items-center justify-center">
                    <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-folder-open text-4xl text-gray-300"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-600">ไม่พบข้อมูล</h3>
                    <p class="text-gray-400 mt-2">ยังไม่มีรายงานผลการดำเนินงานในระบบ</p>
                </div>
            </div>
        @endforelse

    </div>
@endsection