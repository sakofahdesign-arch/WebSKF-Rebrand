@extends('layouts.layout')
@section('title', 'รายการขายทรัพย์สิน')

@php
    $mapAssets = collect($mapAssets ?? [])->values();
@endphp

@section('content')
    <main data-asset-sales-preview-page class="bg-slate-950">
        <div
            data-asset-sales-map
            data-map-variant="fullscreen"
            data-assets='@json($mapAssets)'
            aria-label="แผนที่รายการขายทรัพย์สิน"
        >
            <div class="grid h-[100dvh] min-h-[704px] place-items-center bg-slate-950 text-sm font-semibold text-white/70">
                กำลังโหลดแผนที่รายการขายทรัพย์สิน
            </div>
        </div>
    </main>
@endsection
