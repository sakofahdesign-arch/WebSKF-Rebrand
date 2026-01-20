@extends('layouts.admin-layout')

@section('title', 'System Logs (Daily)')

@section('header')
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                <i class="fas fa-terminal text-emerald-600"></i> System Logs
            </h2>
            <p class="text-sm text-gray-500 mt-1">ตรวจสอบบันทึกการทำงานของระบบแบบรายวัน</p>
        </div>
        
        <div class="flex flex-wrap gap-2 items-center">
            <form action="{{ route('admin.logs') }}" method="GET" class="flex items-center gap-2">
                <div class="form-control w-full max-w-xs">
                    <select name="date" onchange="this.form.submit()" 
                            class="select select-bordered select-sm bg-white text-gray-800 border-gray-300 focus:border-emerald-500 focus:outline-none w-full shadow-sm">
                        @if(empty($fileList))
                            <option class="text-gray-500">ไม่พบไฟล์ Log</option>
                        @else
                            @foreach($fileList as $date => $filename)
                                <option value="{{ $date }}" {{ $currentDate == $date ? 'selected' : '' }} class="text-gray-800">
                                    {{ thaidate('j F Y', $date) }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </form>

            @if($currentFile)
                <a href="{{ route('admin.logs.download', ['file' => $currentFile]) }}" 
                   class="btn btn-sm bg-white hover:bg-gray-50 text-gray-700 border border-gray-300 hover:border-emerald-400 gap-2 shadow-sm font-normal">
                    <i class="fas fa-download text-emerald-600"></i>
                    <span class="hidden sm:inline">โหลด</span>
                </a>
                
                <form action="{{ route('admin.logs.delete') }}" method="POST" onsubmit="return confirm('คุณแน่ใจหรือไม่ที่จะลบไฟล์ {{ $currentFile }}?');">
                    @csrf
                    <input type="hidden" name="file" value="{{ $currentFile }}">
                    <button type="submit" class="btn btn-sm bg-white hover:bg-red-50 text-red-600 border border-gray-300 hover:border-red-400 gap-2 shadow-sm font-normal">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </form>
            @endif

            <button onclick="window.location.reload();" class="btn btn-sm bg-emerald-600 hover:bg-emerald-700 text-white border-none gap-2 shadow-md">
                <i class="fas fa-sync-alt {{ $currentFile ? '' : 'fa-spin' }}"></i>
            </button>
        </div>
    </div>
@endsection

@section('content')
    <div class="container mx-auto max-w-7xl mt-4">
        <div class="card bg-[#1e1e1e] shadow-xl border border-gray-700 overflow-hidden rounded-xl">
            <div class="bg-[#2d2d2d] px-4 py-2 flex justify-between items-center border-b border-gray-700">
                <div class="flex gap-2">
                    <div class="w-3 h-3 rounded-full bg-[#ff5f56]"></div>
                    <div class="w-3 h-3 rounded-full bg-[#ffbd2e]"></div>
                    <div class="w-3 h-3 rounded-full bg-[#27c93f]"></div>
                </div>
                <div class="text-xs text-gray-400 font-mono opacity-70">
                    <i class="fas fa-file-code mr-1"></i> {{ $currentFile ?? 'no-file-selected' }}
                </div>
            </div>

            <div class="p-0 relative group">
                <pre class="text-xs md:text-sm font-mono leading-relaxed h-[70vh] overflow-y-auto p-4 text-gray-300 scrollbar-thin scrollbar-thumb-gray-600 scrollbar-track-[#1e1e1e] selection:bg-emerald-500 selection:text-white" id="logContainer">
                    @if(empty(trim($logs)))
                        <span class="text-gray-500 italic flex items-center gap-2">
                            <i class="fas fa-check-circle text-emerald-500"></i> No errors found or file is empty.
                        </span>
                    @else
                        {!! \Illuminate\Support\Str::markdown($logs) !!} 
                    @endif
                </pre>
                
                <button onclick="scrollToBottom()" class="absolute bottom-4 right-4 bg-emerald-600/80 hover:bg-emerald-600 text-white p-2 rounded-full shadow-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <i class="fas fa-arrow-down"></i>
                </button>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        const logContainer = document.getElementById('logContainer');

        function scrollToBottom() {
            if(logContainer) {
                logContainer.scrollTop = logContainer.scrollHeight;
            }
        }

        // Auto scroll on load
        scrollToBottom();

        // Syntax Highlighting
        if(logContainer) {
            const rawContent = logContainer.innerHTML;
            let styledContent = rawContent
                .replace(/ERROR/g, '<span class="inline-block bg-red-500/20 text-red-400 font-bold px-1 rounded border border-red-500/30">ERROR</span>')
                .replace(/WARNING/g, '<span class="text-yellow-400 font-bold">WARNING</span>')
                .replace(/INFO/g, '<span class="text-blue-400 font-bold">INFO</span>')
                .replace(/stacktrace/gi, '<span class="text-gray-600 italic">stacktrace</span>')
                .replace(/\[(\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})\]/g, '<span class="text-emerald-500">[$1]</span>'); // สีเขียว Emerald

            logContainer.innerHTML = styledContent;
        }
    </script>
    @endpush
@endsection