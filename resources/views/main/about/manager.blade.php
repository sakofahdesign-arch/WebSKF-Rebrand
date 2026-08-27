@extends('layouts.layout')
@section('title', 'คณะกรรมการและบุคลากร')

@section('content')
    <main class="relative min-h-screen overflow-hidden bg-white">
        <div class="pointer-events-none absolute inset-0 -z-10 opacity-70">
            <div class="absolute right-[-10rem] top-[-10rem] h-96 w-96 rounded-full bg-emerald-50 blur-3xl"></div>
            <div class="absolute bottom-[-10rem] left-[-10rem] h-96 w-96 rounded-full bg-sky-50 blur-3xl"></div>
        </div>

        <section class="mx-auto max-w-[1180px] px-4 py-8 sm:px-6 lg:px-8 lg:py-10">
            <div x-data="{ activeTab: 'directors', loaded: false }" x-init="setTimeout(() => loaded = true, 100)">
                <header
                    class="mx-auto mb-5 max-w-3xl text-center transition-all duration-700 ease-out"
                    :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'"
                >
                    <h1 class="text-2xl font-extrabold tracking-tight text-emerald-900 md:text-3xl">
                        โครงสร้างการบริหารงาน
                    </h1>
                    <div class="mx-auto mt-2.5 h-1 w-16 rounded-full bg-emerald-500"></div>
                    <p class="mx-auto mt-3 max-w-2xl text-xs leading-relaxed text-slate-600 md:text-sm">
                        คณะกรรมการและบุคลากรผู้ทรงคุณวุฒิ ผู้อยู่เบื้องหลังความสำเร็จและการขับเคลื่อนสหกรณ์สู่ความมั่นคง
                    </p>
                </header>

                <nav
                    class="mx-auto mb-5 grid max-w-5xl grid-cols-2 gap-2 rounded-2xl border border-emerald-900/10 bg-white/85 p-2 shadow-[0_18px_46px_rgba(4,60,50,0.08)] backdrop-blur md:grid-cols-5"
                    :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'"
                    style="transition-delay: 120ms"
                    aria-label="หมวดโครงสร้างการบริหารงาน"
                >
                    <button
                        type="button"
                        @click="activeTab = 'directors'"
                        :class="activeTab === 'directors' ? 'bg-emerald-700 text-white shadow-[0_10px_22px_rgba(4,120,87,0.22)]' : 'bg-transparent text-slate-600 hover:bg-emerald-50 hover:text-emerald-900'"
                        class="min-h-10 rounded-xl px-3 py-2 text-xs font-extrabold leading-tight transition md:text-sm"
                    >
                        คณะกรรมการดำเนินการ
                    </button>
                    <button
                        type="button"
                        @click="activeTab = 'executives'"
                        :class="activeTab === 'executives' ? 'bg-emerald-700 text-white shadow-[0_10px_22px_rgba(4,120,87,0.22)]' : 'bg-transparent text-slate-600 hover:bg-emerald-50 hover:text-emerald-900'"
                        class="min-h-10 rounded-xl px-3 py-2 text-xs font-extrabold leading-tight transition md:text-sm"
                    >
                        ผู้บริหาร
                    </button>
                    <button
                        type="button"
                        @click="activeTab = 'branchExecutives'"
                        :class="activeTab === 'branchExecutives' ? 'bg-emerald-700 text-white shadow-[0_10px_22px_rgba(4,120,87,0.22)]' : 'bg-transparent text-slate-600 hover:bg-emerald-50 hover:text-emerald-900'"
                        class="min-h-10 rounded-xl px-3 py-2 text-xs font-extrabold leading-tight transition md:text-sm"
                    >
                        ผู้บริหารสาขา
                    </button>
                    <button
                        type="button"
                        @click="activeTab = 'advisors'"
                        :class="activeTab === 'advisors' ? 'bg-emerald-700 text-white shadow-[0_10px_22px_rgba(4,120,87,0.22)]' : 'bg-transparent text-slate-600 hover:bg-emerald-50 hover:text-emerald-900'"
                        class="min-h-10 rounded-xl px-3 py-2 text-xs font-extrabold leading-tight transition md:text-sm"
                    >
                        คณะที่ปรึกษา
                    </button>
                    <button
                        type="button"
                        @click="activeTab = 'founders'"
                        :class="activeTab === 'founders' ? 'bg-emerald-700 text-white shadow-[0_10px_22px_rgba(4,120,87,0.22)]' : 'bg-transparent text-slate-600 hover:bg-emerald-50 hover:text-emerald-900'"
                        class="min-h-10 rounded-xl px-3 py-2 text-xs font-extrabold leading-tight transition md:text-sm"
                    >
                        ทำเนียบผู้ก่อตั้ง
                    </button>
                </nav>

                <div
                    class="mx-auto max-w-4xl transition-all duration-700 ease-out"
                    :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'"
                    style="transition-delay: 220ms"
                >
                    <div class="overflow-hidden rounded-[1.35rem] border border-emerald-900/10 bg-white p-1.5 shadow-[0_18px_52px_rgba(4,60,50,0.09)]">
                        <div class="rounded-[1rem] bg-slate-50/75 p-2.5 md:p-4">
                            <figure x-show="activeTab === 'directors'" x-transition.opacity.duration.250ms>
                                <img
                                    src="{{ asset('images/board/committee-28-current.jpg') }}"
                                    alt="คณะกรรมการดำเนินการ ชุดที่ 28"
                                    class="mx-auto max-h-[68vh] w-auto max-w-full rounded-xl object-contain shadow-sm"
                                    loading="lazy"
                                >
                            </figure>

                            <figure x-show="activeTab === 'executives'" x-transition.opacity.duration.250ms style="display: none;">
                                <img
                                    src="{{ asset('images/board/executives-current.jpg') }}"
                                    alt="ผู้บริหาร"
                                    class="mx-auto max-h-[68vh] w-auto max-w-full rounded-xl object-contain shadow-sm"
                                    loading="lazy"
                                >
                            </figure>

                            <figure x-show="activeTab === 'branchExecutives'" x-transition.opacity.duration.250ms style="display: none;">
                                <img
                                    src="{{ asset('images/board/branch-executives-current.jpg') }}"
                                    alt="ผู้บริหารสาขา"
                                    class="mx-auto max-h-[68vh] w-auto max-w-full rounded-xl object-contain shadow-sm"
                                    loading="lazy"
                                >
                            </figure>

                            <figure x-show="activeTab === 'advisors'" x-transition.opacity.duration.250ms style="display: none;">
                                <img
                                    src="{{ asset('images/board/คณะที่ปรึกษา.jpg') }}"
                                    alt="คณะที่ปรึกษา"
                                    class="mx-auto max-h-[68vh] w-auto max-w-full rounded-xl object-contain shadow-sm"
                                    loading="lazy"
                                >
                            </figure>

                            <figure x-show="activeTab === 'founders'" x-transition.opacity.duration.250ms style="display: none;">
                                <img
                                    src="{{ asset('images/board/บอร์ดก่อตั้ง.jpg') }}"
                                    alt="ทำเนียบผู้ก่อตั้ง"
                                    class="mx-auto max-h-[68vh] w-auto max-w-full rounded-xl object-contain shadow-sm"
                                    loading="lazy"
                                >
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
