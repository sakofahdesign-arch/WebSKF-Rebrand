@extends('layouts.layout')

@php
    $articleTitle = $news->title ?? 'ข่าวสารสหกรณ์';
    $articleDescription = $news->description ?? null;
    $coverImage = !empty($news?->picture_name) ? asset('uploads/covers/' . $news->picture_name) : asset('images/sakofah-logo.png');
    $publishedDate = !empty($news?->dateupload) ? thaidate('j F Y', $news->dateupload) : null;
@endphp

@section('title', $articleTitle)
@section('og_title', $articleTitle)
@section('og_description', \Illuminate\Support\Str::limit(strip_tags($articleDescription ?? 'ข่าวสารจากสหกรณ์อิสลามษะกอฟะฮ จำกัด'), 155))
@section('og_image', $coverImage)

@push('styles')
    <style>
        .news-content ul {
            list-style: disc;
            margin-left: 1.5rem;
            padding-left: 1rem;
        }

        .news-content ol {
            list-style: decimal;
            margin-left: 1.5rem;
            padding-left: 1rem;
        }

        .news-content li {
            margin-bottom: 0.5rem;
        }

        .news-content img {
            border-radius: 1rem;
            margin: 1.5rem auto;
        }
    </style>
@endpush

@section('content')
    <main class="min-h-screen bg-[#f5f8f5] text-slate-900">
        <section class="relative overflow-hidden border-b border-emerald-900/10 bg-white">
            <div class="absolute inset-0 pointer-events-none opacity-70">
                <div class="absolute inset-x-0 top-0 h-72 bg-[radial-gradient(circle_at_50%_0%,rgba(0,104,71,0.16),transparent_62%)]"></div>
                <div class="absolute inset-0 bg-[linear-gradient(90deg,rgba(0,104,71,0.05)_1px,transparent_1px),linear-gradient(0deg,rgba(0,104,71,0.04)_1px,transparent_1px)] bg-[size:88px_88px]"></div>
            </div>

            <div class="relative mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8 lg:py-12">
                <a href="{{ route('activity') }}" class="inline-flex items-center gap-2 rounded-full border border-emerald-900/15 bg-white/80 px-4 py-2 text-sm font-semibold text-emerald-900 shadow-sm shadow-emerald-950/5 transition hover:-translate-y-0.5 hover:border-emerald-700/30 hover:bg-emerald-50 focus:outline-none focus:ring-2 focus:ring-emerald-700/30">
                    <i class="fas fa-arrow-left text-xs"></i>
                    กลับหน้าข่าวสาร
                </a>

                <div class="mt-8 grid gap-8 lg:grid-cols-[minmax(0,1fr)_380px] lg:items-end">
                    <div>
                        <p class="text-sm font-semibold text-emerald-700">ข่าวสารและกิจกรรม</p>
                        <h1 class="mt-3 max-w-4xl text-3xl font-extrabold leading-tight text-emerald-950 sm:text-4xl lg:text-5xl">
                            {{ $articleTitle }}
                        </h1>

                        <div class="mt-5 flex flex-wrap items-center gap-3 text-sm text-slate-600">
                            @if ($publishedDate)
                                <span class="inline-flex items-center gap-2 rounded-full bg-emerald-900 px-4 py-2 font-semibold text-white">
                                    <i class="far fa-calendar-alt"></i>
                                    {{ $publishedDate }}
                                </span>
                            @endif

                            @if (isset($news->views))
                                <span class="inline-flex items-center gap-2 rounded-full border border-emerald-900/10 bg-white px-4 py-2 font-semibold text-slate-700">
                                    <i class="far fa-eye text-emerald-700"></i>
                                    {{ number_format((int) $news->views) }} ครั้ง
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="overflow-hidden rounded-[1.75rem] bg-emerald-950 shadow-2xl shadow-emerald-950/15">
                        <img src="{{ $coverImage }}"
                             alt="{{ $articleTitle }}"
                             class="aspect-[4/3] w-full object-cover"
                             loading="eager">
                    </div>
                </div>
            </div>
        </section>

        <section class="mx-auto grid max-w-7xl gap-8 px-4 py-10 sm:px-6 lg:grid-cols-[minmax(0,1fr)_340px] lg:px-8 lg:py-14">
            <article class="min-w-0">
                <div class="rounded-[1.5rem] bg-white p-6 shadow-xl shadow-emerald-950/[0.06] ring-1 ring-emerald-900/10 sm:p-8 lg:p-10">
                    @if ($news)
                        <div class="news-content prose prose-lg max-w-none prose-headings:text-emerald-950 prose-a:text-emerald-700 prose-strong:text-emerald-950 text-slate-700">
                            {!! $articleDescription !!}
                        </div>

                        @if ($image_news && $image_news->isNotEmpty())
                            <div class="mt-10 border-t border-emerald-900/10 pt-8">
                                <div class="mb-5 flex items-center justify-between gap-4">
                                    <h2 class="text-xl font-bold text-emerald-950">รูปภาพประกอบ</h2>
                                    <span class="text-sm font-medium text-slate-500">{{ $image_news->count() }} รูป</span>
                                </div>

                                <div class="grid grid-cols-2 gap-3 sm:grid-cols-3 lg:grid-cols-4">
                                    @foreach ($image_news as $image)
                                        <a href="{{ asset('uploads/galleries/' . $image->picture_name) }}" target="_blank" rel="noopener" class="group block overflow-hidden rounded-2xl bg-emerald-50 ring-1 ring-emerald-900/10 focus:outline-none focus:ring-2 focus:ring-emerald-700/40">
                                            <img src="{{ asset('uploads/galleries/' . $image->picture_name) }}"
                                                 alt="รูปภาพประกอบ {{ $articleTitle }}"
                                                 class="aspect-square w-full object-cover transition duration-300 group-hover:scale-105"
                                                 loading="lazy">
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <div class="mt-10 flex flex-wrap items-center justify-between gap-4 border-t border-emerald-900/10 pt-6">
                            <span class="text-sm font-semibold text-slate-500">แชร์ข่าวนี้</span>
                            <div class="flex items-center gap-2">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" rel="noopener" class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-blue-600 text-white transition hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-blue-500/40" aria-label="แชร์ไปยัง Facebook">
                                    <i class="fa-brands fa-facebook-f"></i>
                                </a>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}" target="_blank" rel="noopener" class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-slate-950 text-white transition hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-slate-700/40" aria-label="แชร์ไปยัง X">
                                    <i class="fa-brands fa-x-twitter"></i>
                                </a>
                                <a href="https://lineit.line.me/share/ui?url={{ urlencode(url()->current()) }}" target="_blank" rel="noopener" class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-green-500 text-white transition hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-green-500/40" aria-label="แชร์ไปยัง Line">
                                    <i class="fa-brands fa-line"></i>
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="mx-auto max-w-2xl py-16 text-center">
                            <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-emerald-50 text-2xl text-emerald-800">
                                <i class="far fa-newspaper"></i>
                            </div>
                            <h2 class="mt-6 text-2xl font-extrabold text-emerald-950">กำลังเตรียมข้อมูลข่าวนี้</h2>
                            <p class="mt-3 text-base leading-7 text-slate-600">
                                ลิงก์นี้ถูกจัดให้อยู่ในเว็บใหม่แล้ว แต่ยังต้องนำเข้าข้อมูลข่าวและรูปภาพจากฐานข้อมูลเดิมก่อนจึงจะแสดงเนื้อหาเต็มได้
                            </p>
                            <a href="{{ route('activity') }}" class="mt-7 inline-flex items-center justify-center rounded-full bg-emerald-900 px-5 py-3 text-sm font-bold text-white shadow-lg shadow-emerald-950/15 transition hover:-translate-y-0.5 hover:bg-emerald-800 focus:outline-none focus:ring-2 focus:ring-emerald-700/40">
                                ดูข่าวสารทั้งหมด
                            </a>
                        </div>
                    @endif
                </div>
            </article>

            <aside class="lg:pt-2">
                <div class="sticky top-8 rounded-[1.5rem] bg-white p-5 shadow-xl shadow-emerald-950/[0.05] ring-1 ring-emerald-900/10">
                    <div class="flex items-center justify-between gap-4 border-b border-emerald-900/10 pb-4">
                        <h2 class="text-lg font-extrabold text-emerald-950">ข่าวสารอื่น ๆ</h2>
                        <i class="fas fa-rss text-emerald-700"></i>
                    </div>

                    @if (! $side_news || $side_news->isEmpty())
                        <p class="py-8 text-center text-sm leading-6 text-slate-500">ยังไม่มีข่าวสารอื่นให้แสดง</p>
                    @else
                        <div class="mt-5 space-y-4">
                            @foreach ($side_news as $side_item)
                                <a href="{{ route('article', $side_item->news_number) }}" class="group grid grid-cols-[84px_minmax(0,1fr)] gap-3 rounded-2xl p-2 transition hover:bg-emerald-50 focus:outline-none focus:ring-2 focus:ring-emerald-700/30">
                                    <img src="{{ asset('uploads/covers/' . $side_item->picture_name) }}"
                                         alt="{{ $side_item->title }}"
                                         class="aspect-square w-full rounded-xl object-cover"
                                         loading="lazy"
                                         onerror="this.src='{{ asset('images/sakofah-logo.png') }}'">
                                    <span class="min-w-0">
                                        <span class="line-clamp-2 text-sm font-bold leading-6 text-slate-800 transition group-hover:text-emerald-800">{{ $side_item->title }}</span>
                                        <span class="mt-2 inline-flex items-center gap-1 text-xs font-medium text-slate-500">
                                            <i class="far fa-clock"></i>
                                            {{ !empty($side_item->dateupload) ? thaidate('j M Y', $side_item->dateupload) : 'ไม่ระบุวันที่' }}
                                        </span>
                                    </span>
                                </a>
                            @endforeach
                        </div>

                        <a href="{{ route('activity') }}" class="mt-5 inline-flex w-full items-center justify-center rounded-full border border-emerald-900/15 px-4 py-3 text-sm font-bold text-emerald-900 transition hover:bg-emerald-50 focus:outline-none focus:ring-2 focus:ring-emerald-700/30">
                            ดูข่าวสารทั้งหมด
                        </a>
                    @endif
                </div>
            </aside>
        </section>
    </main>
@endsection
