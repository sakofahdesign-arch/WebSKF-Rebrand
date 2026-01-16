@extends('layouts.admin-layout')

@section('title', 'ประวัติการเข้าสู่ระบบ')

@section('header')
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                <i class="fas fa-history text-emerald-600"></i> ประวัติการเข้าสู่ระบบ
            </h2>
            <nav class="flex text-sm text-gray-500 mt-1" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2">
                    <li class="inline-flex items-center">
                        <a href="#" class="hover:text-emerald-600">Admin</a>
                    </li>
                    <li><i class="fas fa-chevron-right text-xs"></i></li>
                    <li class="text-gray-400" aria-current="page">Login History</li>
                </ol>
            </nav>
        </div>
    </div>
@endsection

@section('content')
    <div class="container mx-auto max-w-7xl">

        <div class="card bg-white shadow-lg border border-gray-100 overflow-hidden">
            <div class="h-2 bg-gradient-to-r from-emerald-500 to-teal-400"></div>

            <div class="p-6 md:p-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-lg bg-emerald-100 flex items-center justify-center text-emerald-600 shadow-sm">
                        <i class="fas fa-user-clock text-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-800">บันทึกการเข้าใช้งาน</h3>
                        <p class="text-xs text-gray-500 mt-1">ตรวจสอบกิจกรรมการเข้าสู่ระบบของเจ้าหน้าที่</p>
                    </div>
                </div>

                <div class="rounded-lg border border-gray-100 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="table w-full">
                            <thead class="bg-gray-50 text-gray-500 font-bold text-sm">
                                <tr>
                                    <th class="py-4 px-6 text-left">ผู้ใช้งาน</th>
                                    <th class="py-4 px-6 text-center">สาขา</th>
                                    <th class="py-4 px-6 text-center">เวลาเข้าสู่ระบบ</th>
                                    <th class="py-4 px-6 text-left">อุปกรณ์ / Browser</th>
                                    <th class="py-4 px-6 text-right">IP Address</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-700">
                                @forelse ($login_history as $log)
                                    <tr class="hover:bg-emerald-50/40 transition-colors border-b border-gray-100 last:border-none">
                                        <td class="py-4 px-6">
                                            <div class="flex items-center gap-3">
                                                
                                                <div>
                                                    <div class="font-bold text-gray-800">{{ $log->user_name }}</div>
                                                    <div class="text-xs text-gray-400">ID: {{ $log->user_id }}</div>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="py-4 px-6 text-center">
                                            <span class="badge badge-outline border-emerald-200 text-emerald-700 bg-emerald-50">
                                                {{ $log->name_branch }}
                                            </span>
                                        </td>

                                        <td class="py-4 px-6 text-center whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-700">
                                                {{ thaidate('j M Y', strtotime($log->login_time)) }}
                                            </div>
                                            <div class="text-xs text-gray-400">
                                                {{ date('H:i:s', strtotime($log->login_time)) }} น.
                                            </div>
                                        </td>

                                        <td class="py-4 px-6">
                                            <div class="flex items-center gap-2 text-sm text-gray-600">
                                                @php
                                                    $platform = strtolower($log->platform);
                                                @endphp
                                                
                                                @if(Str::contains($platform, 'windows'))
                                                    <i class="fab fa-windows text-blue-500 text-lg"></i>
                                                @elseif(Str::contains($platform, ['mac', 'ios', 'iphone', 'ipad']))
                                                    <i class="fab fa-apple text-gray-800 text-lg"></i>
                                                @elseif(Str::contains($platform, 'android'))
                                                    <i class="fab fa-android text-green-500 text-lg"></i>
                                                @else
                                                    <i class="fas fa-desktop text-gray-400 text-lg"></i>
                                                @endif

                                                <div class="flex flex-col">
                                                    <span class="font-medium">{{ $log->platform }}</span>
                                                    <span class="text-xs text-gray-400">{{ $log->browser }} (v.{{ $log->version }})</span>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="py-4 px-6 text-right font-mono text-sm text-gray-500">
                                            {{ $log->ip_address }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="py-16 text-center text-gray-400">
                                            <div class="flex flex-col items-center justify-center">
                                                <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                                                    <i class="fas fa-history text-3xl opacity-30"></i>
                                                </div>
                                                <p>ยังไม่มีประวัติการเข้าใช้งาน</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                @if($login_history->hasPages())
                    <div class="mt-6 border-t border-gray-100 pt-4 flex justify-end">
                        {{ $login_history->links('vendor.pagination.daisyui') }}
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection