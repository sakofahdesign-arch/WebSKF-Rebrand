@extends('layouts.admin-layout')
@section('title', 'ผลการดำเนินงานประจำปี')

@php
    // ✨ จัดกลุ่มข้อมูลตามปี พ.ศ. ที่นี่ แทนการทำใน Controller
    $dataByYear = $data->groupBy(function($item) {
        return date('Y', strtotime($item->date)) + 543;
    });
@endphp

@section('content')
<div class="bg-gray-100 min-h-screen" x-data="{ loaded: false }" x-init="() => { setTimeout(() => loaded = true, 100) }">
    <div class="container mx-auto px-4 py-16">

        <div class="text-center mb-16 transition-all duration-700 ease-out" :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-5'">
            <h1 class="text-4xl md:text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-700 to-sky-500 mb-4">
                ผลการดำเนินงานประจำปี
            </h1>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                รายงานสรุปผลการดำเนินงานและงบการเงินประจำปีของสหกรณ์
            </p>
        </div>

        <div class="space-y-12">
            @forelse ($dataByYear as $year => $documents)
                <section class="transition-all duration-500 ease-out opacity-0"
                         :class="{ 'opacity-100 translate-y-0': loaded }"
                         style="transition-delay: {{ ($loop->index * 200) + 300 }}ms">

                    <div class="flex items-center mb-6">
                        <h2 class="text-3xl font-bold text-gray-800">ประจำปี {{ $year }}</h2>
                        <div class="flex-grow h-px bg-gray-300 ml-4"></div>
                    </div>

                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                        <ul class="divide-y divide-gray-200">
                            @foreach ($documents as $item)
                                <li class="p-4 md:p-6 hover:bg-gray-50 transition-colors duration-200">
                                    <div class="flex items-center justify-between space-x-4">
                                        <div class="flex items-center min-w-0">
                                            <div class="flex-shrink-0">
                                                <svg class="h-10 w-10 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m.75 12 3 3m0 0 3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                                </svg>
                                            </div>
                                            <div class="ml-4 min-w-0">
                                                <p class="text-lg font-semibold text-gray-800 truncate">{{ $item->document_name }}</p>
                                                <p class="text-sm text-gray-500">วันที่: {{ thaidate('j M Y', strtotime($item->date)) }}</p>
                                            </div>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <a href="{{ url('file/performance/' . $item->file_name) }}" target="_blank"
                                               class="inline-flex items-center px-4 py-2 bg-green-600 text-white font-semibold rounded-lg shadow-md hover:bg-green-700 hover:scale-105 transform transition-all duration-200">
                                                <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                                </svg>
                                                <span>ดาวน์โหลด</span>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </section>
            @empty
                <div class="text-center py-16">
                    <svg class="mx-auto h-16 w-16 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m-5.25 9v6.75a2.25 2.25 0 0 0 2.25 2.25h13.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H5.25a2.25 2.25 0 0 0-2.25 2.25Z" />
                    </svg>
                    <h3 class="mt-4 text-xl font-semibold text-gray-700">ยังไม่มีข้อมูลผลการดำเนินงาน</h3>
                    <p class="mt-2 text-gray-500">โปรดกลับมาตรวจสอบอีกครั้งในภายหลัง</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection

@include('components.sweetalert2')