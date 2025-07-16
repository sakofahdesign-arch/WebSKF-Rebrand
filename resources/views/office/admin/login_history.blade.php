@extends('layouts.admin-layout')
@section('title', 'ประวัติการเข้าสู่ระบบ')

@section('content')
<div class="p-4 md:p-8 bg-gray-100 min-h-screen">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">ประวัติการเข้าสู่ระบบ</h1>
        <p class="text-gray-500 mt-1">ตรวจสอบและติดตามการเข้าใช้งานระบบทั้งหมด</p>
    </div>

    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-700">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                    <tr>
                        <th scope="col" class="px-6 py-4">ผู้ใช้งาน</th>
                        <th scope="col" class="px-6 py-4">สาขา</th>
                        <th scope="col" class="px-6 py-4">เวลาเข้าระบบ</th>
                        <th scope="col" class="px-6 py-4">IP Address</th>
                        <th scope="col" class="px-6 py-4">อุปกรณ์ / Browser</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($login_history as $log)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div class="font-bold text-gray-900">{{ $log->user_name }}</div>
                                <div class="text-xs text-gray-500">ID: {{ $log->user_id }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 text-xs font-semibold text-purple-800 bg-purple-100 rounded-full">
                                    {{ $log->name_branch }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                {{ thaidate('j M Y H:i:s', strtotime($log->login_time)) }}
                            </td>
                            <td class="px-6 py-4 font-mono">{{ $log->ip_address }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    @if(Str::contains(strtolower($log->platform), 'windows'))
                                        <svg class="h-5 w-5 text-blue-500" fill="currentColor" viewBox="0 0 24 24"><path d="M3,12V6.75L9,5.43V11.91L3,12M21,12V6.75L15,5.43V11.91L21,12M3,13L9,13.09V19.57L3,18.25V13M21,13L15,13.09V19.57L21,18.25V13Z" /></svg>
                                    @elseif(Str::contains(strtolower($log->platform), ['mac', 'iphone', 'ipad']))
                                         <svg class="h-5 w-5 text-gray-600" fill="currentColor" viewBox="0 0 24 24"><path d="M19.43 12.98c.04-.32.07-.64.07-.98s-.03-.66-.07-.98l2.11-1.65c.19-.15.24-.42.12-.64l-2-3.46c-.12-.22-.39-.3-.61-.22l-2.49 1c-.52-.4-1.08-.73-1.69-.98l-.38-2.65C14.46 2.18 14.25 2 14 2h-4c-.25 0-.46.18-.49.42l-.38 2.65c-.61.25-1.17.59-1.69-.98l-2.49-1c-.23-.09-.49 0-.61.22l-2 3.46c-.13.22-.07.49.12.64l2.11 1.65c-.04.32-.07.65-.07.98s.03.66.07.98l-2.11 1.65c-.19.15-.24.42-.12.64l2 3.46c.12.22.39.3.61.22l2.49-1c.52.4 1.08.73 1.69.98l.38 2.65c.03.24.24.42.49.42h4c.25 0 .46-.18.49-.42l.38-2.65c.61-.25 1.17-.59 1.69-.98l2.49 1c.23.09.49 0 .61-.22l2-3.46c.12-.22.07.49-.12-.64l-2.11-1.65zM12 15.5c-1.93 0-3.5-1.57-3.5-3.5s1.57-3.5 3.5-3.5 3.5 1.57 3.5 3.5-1.57 3.5-3.5 3.5z"/></svg>
                                    @endif
                                    <span>{{ $log->platform }} v.{{ $log->version }} / {{ $log->browser }}</span>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-12 text-gray-500">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" /></svg>
                                <h3 class="mt-2 text-lg font-medium text-gray-800">ไม่พบข้อมูล</h3>
                                <p class="mt-1 text-sm text-gray-500">ยังไม่มีประวัติการเข้าสู่ระบบในตอนนี้</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 md:p-6 bg-white border-t">
            {{ $login_history->links() }}
        </div>
    </div>
</div>
@endsection