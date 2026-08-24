@extends('layouts.layout')
@section('title', 'หน้าแรก')
@section('content')
    <div data-homepage-shell class="relative isolate overflow-hidden bg-white">
        <div
            data-wave-grid-homepage-background
            class="pointer-events-none fixed inset-0 z-0 opacity-[0.42]"
            aria-hidden="true"
        ></div>

        <div data-homepage-content class="relative z-10">
            @include('components.welcomes.organization-cylinder')
            @include('components.welcomes.promotion-carousel')
            @include('components.welcomes.news-staggered')
            @include('components.welcomes.service-intel')
            @include('components.welcomes.journals-public')
            @include('components.welcomes.branch-service-network')
            @include('components.welcomes.financial-status')
            @include('components.welcomes.partners-agencies')
            @include('components.welcomes.popup')
        </div>
    </div>
@endsection
