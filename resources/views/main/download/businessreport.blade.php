@extends('layouts.layout')
@section('title', 'รายงานกิจการ')

@section('content')
<div class="bg-gray-50 min-h-screen text-gray-800 font-sans" data-theme="light" x-data="{ loaded: false }" x-init="() => { setTimeout(() => loaded = true, 50) }">

    <div class="relative bg-gradient-to-r from-emerald-700 to-teal-600 text-white py-20 shadow-lg overflow-hidden">
        <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
        <div class="absolute top-0 right-0 w-96 h-96 bg-white rounded-full mix-blend-overlay filter blur-3xl opacity-20 -mr-20 -mt-20"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-teal-300 rounded-full mix-blend-overlay filter blur-3xl opacity-20 -ml-20 -mb-20"></div>

        <div class="container mx-auto px-4 text-center relative z-10 transition-all duration-700 ease-out"
             :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-5'">
            <div class="inline-block px-4 py-2 rounded-full bg-white/20 backdrop-blur-md border border-white/30 text-white font-bold text-sm mb-6 shadow-sm">
                <i class="fas fa-chart-line mr-2"></i> ความโปร่งใสและการเติบโต
            </div>
            <h1 class="text-4xl md:text-5xl font-extrabold mb-4 drop-shadow-md">รายงานกิจการประจำปี</h1>
            <p class="text-lg md:text-xl font-light max-w-2xl mx-auto opacity-95">
                รายงานผลการดำเนินงานและสถานะทางการเงินของสหกรณ์ฯ เพื่อความโปร่งใสและตรวจสอบได้
            </p>
        </div>
    </div>

    <div class="container mx-auto px-4 py-16 max-w-7xl relative z-20 -mt-10">

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ([
                ["year" => "2563", "name" => "รายงานกิจการ 2563 (ฉบับสมบูรณ์)", "path" => "file/report/รายงานกิจการ_2563_(สมบูรณ์_online2).pdf"],
                ["year" => "2562", "name" => "รายงานกิจการ 2562", "path" => "file/report/รายงานกิจการ_2562.pdf"],
                ["year" => "2561", "name" => "รายงานกิจการ 2561", "path" => "file/report/รายงานกิจการ_2561.pdf"],
                ["year" => "2560", "name" => "รายงานกิจการ 2560", "path" => "file/report/รายงานกิจการ_2560.pdf"],
                ["year" => "2559", "name" => "รายงานกิจการ 2559", "path" => "file/report/รายงานกิจการ_2559.pdf"],
                ["year" => "2558", "name" => "รายงานกิจการ 2558", "path" => "file/report/รายงานกิจการ_2558.pdf"],
                ["year" => "2557", "name" => "รายงานกิจการ 2557", "path" => "file/report/รายงานกิจการ_2557.pdf"]
            ] as $index => $report)

                <a href="{{ url($report['path']) }}" target="_blank" rel="noopener noreferrer"
                   class="group h-full block transform transition-all duration-300 hover:-translate-y-2">

                    <div class="card bg-white shadow-lg border border-gray-100 h-full hover:shadow-2xl transition-shadow duration-300 opacity-0 translate-y-10"
                         :class="loaded ? '!opacity-100 !translate-y-0' : ''"
                         style="transition-delay: {{ $index * 50 + 200 }}ms">

                        <div class="card-body p-5 flex flex-row items-center gap-4">
                            <div class="flex-shrink-0">
                                <div class="w-20 h-24 bg-emerald-50 rounded-xl border border-emerald-100 flex flex-col items-center justify-center text-emerald-600 shadow-sm group-hover:bg-emerald-600 group-hover:text-white transition-colors duration-300 relative overflow-hidden">
                                     <div class="absolute top-1 right-1">
                                        <i class="fas fa-file-pdf text-[10px] opacity-40"></i>
                                     </div>
                                     <span class="text-[10px] font-bold uppercase tracking-wider mb-1 opacity-70">YEAR</span>
                                     <span class="text-xl font-extrabold">{{ $report['year'] }}</span>
                                </div>
                            </div>

                            <div class="flex-grow min-w-0">
                                <h3 class="card-title text-base font-bold text-gray-800 group-hover:text-emerald-700 transition-colors mb-1 truncate">
                                    {{ $report['name'] }}
                                </h3>
                                <div class="badge badge-sm badge-ghost text-xs text-gray-400 mb-3 font-normal">PDF File</div>

                                <div class="text-sm font-semibold text-emerald-500 group-hover:text-emerald-700 flex items-center gap-1 transition-colors">
                                    ดาวน์โหลด <i class="fas fa-arrow-right text-xs transform group-hover:translate-x-1 transition-transform"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>

            @endforeach
        </div>
    </div>
</div>
@endsection