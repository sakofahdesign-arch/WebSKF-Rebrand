@extends('layouts.layout')

@section('title', 'โครงสร้างองค์กร')

@section('content')
<div class="bg-gray-50 min-h-screen pb-20">

    <div class="bg-white py-12 text-center shadow-sm border-b border-gray-200">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-green-700 to-teal-600 mb-2">
                แผนภูมิโครงสร้างองค์กร
            </h1>
            <p class="text-gray-500 font-medium">สหกรณ์อิสลามษะกอฟะฮ จำกัด</p>
        </div>
    </div>

    <div class="container mx-auto px-4 max-w-5xl mt-8">

        <div class="divider divider-success text-green-700 font-bold text-lg mb-8">ระดับสมาชิกและนโยบายสูงสุด</div>

        <div class="flex flex-col md:flex-row justify-center gap-6 mb-8">
            <div class="card w-full md:w-64 bg-green-600 text-white shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
                <div class="card-body p-5 text-center items-center">
                    <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center mb-2">
                        <i class="fas fa-users text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold">สมาชิก</h3>
                </div>
            </div>

            <div class="card w-full md:w-72 bg-green-800 text-white shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
                <div class="card-body p-5 text-center items-center">
                    <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center mb-2">
                        <i class="fas fa-handshake text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold">ที่ประชุมใหญ่</h3>
                </div>
            </div>
        </div>

        <div class="divider divider-warning text-yellow-700 font-bold text-lg mb-8">การกำกับดูแลและตรวจสอบ</div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <div class="card bg-white border-b-4 border-orange-400 shadow-md hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                <div class="card-body p-4 text-center">
                    <h4 class="font-bold text-gray-700">ผู้สอบบัญชี</h4>
                </div>
            </div>
            <div class="card bg-white border-b-4 border-green-500 shadow-md hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                <div class="card-body p-4 text-center">
                    <h4 class="font-bold text-gray-700 text-sm">คกก. ก่อตั้งและที่ปรึกษา</h4>
                </div>
            </div>
            <div class="card bg-white border-b-4 border-teal-500 shadow-md hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                <div class="card-body p-4 text-center">
                    <h4 class="font-bold text-gray-700 text-sm">คกก. มูลนิธิษะกอฟะฮ</h4>
                </div>
            </div>
            <div class="card bg-white border-b-4 border-blue-400 shadow-md hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                <div class="card-body p-4 text-center">
                    <h4 class="font-bold text-gray-700">ผู้ตรวจสอบกิจการ</h4>
                </div>
            </div>
        </div>

        <div class="divider divider-primary text-blue-700 font-bold text-lg mb-8">คณะกรรมการและผู้บริหารระดับสูง</div>

        <div class="flex flex-col items-center gap-8 mb-4">

            <div class="card w-full max-w-md bg-gradient-to-r from-green-900 to-green-800 text-white shadow-2xl hover:scale-105 transition-transform duration-300 z-10">
                <div class="card-body p-6 text-center">
                    <i class="fas fa-users-cog text-3xl mb-1 text-green-200"></i>
                    <h2 class="text-2xl font-extrabold">คณะกรรมการดำเนินการ</h2>
                </div>
            </div>

            <div class="flex flex-wrap justify-center gap-6 w-full">

                <div class="card bg-emerald-600 text-white shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all duration-300 min-w-[200px]">
                    <div class="card-body p-4 text-center">
                        <i class="fas fa-school text-xl mb-1 opacity-80"></i>
                        <h3 class="font-bold">โรงเรียนษะกอฟะฮฯ</h3>
                    </div>
                </div>

                <div class="flex flex-col items-center">
                    <div class="card bg-yellow-400 text-yellow-900 shadow-xl hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 min-w-[220px] border-2 border-yellow-200">
                        <div class="card-body p-4 text-center">
                            <i class="fas fa-user-tie text-2xl mb-1"></i>
                            <h3 class="text-xl font-extrabold">ผู้จัดการใหญ่</h3>
                        </div>
                    </div>
                    <div class="h-4 w-0.5 bg-gray-300"></div>
                    <div class="badge badge-lg bg-yellow-100 text-yellow-800 border-yellow-300 p-4 font-bold shadow-sm">
                        ส่วนงานธุรกิจ
                    </div>
                </div>

            </div>
        </div>

        <div class="divider divider-secondary text-purple-700 font-bold text-lg my-10">สายงานปฏิบัติการ</div>

        <div class="space-y-4 max-w-4xl mx-auto">

            <div class="collapse collapse-plus bg-white border-l-8 border-pink-500 shadow-md hover:shadow-xl transition-all duration-300">
                <input type="radio" name="org-accordion" checked="checked" />
                <div class="collapse-title text-lg font-bold text-pink-700 bg-pink-50 flex items-center gap-4 py-4 pr-12">
                    <div class="w-12 h-12 rounded-full bg-white shadow-sm flex items-center justify-center text-pink-500 shrink-0">
                        <i class="fas fa-hand-holding-usd text-xl"></i>
                    </div>
                    <div>
                        <span class="block text-gray-800 text-xl">รองผู้จัดการใหญ่</span>
                        <span class="text-sm font-normal text-pink-600">สายงานสินเชื่อและบริหารหนี้</span>
                    </div>
                </div>
                <div class="collapse-content bg-white pt-4">
                    <div class="grid md:grid-cols-2 gap-4 pb-2">
                        <div class="p-4 rounded-xl bg-pink-50/50 border border-pink-100 hover:bg-pink-50 transition-colors">
                            <h4 class="font-bold text-pink-800 mb-2 flex items-center gap-2">
                                <i class="fas fa-user-check"></i> ผช. ผจก. สินเชื่อฯ
                            </h4>
                            <div class="flex flex-wrap gap-2">
                                <span class="badge bg-white border-pink-200 text-gray-600">บริหารสินเชื่อ</span>
                                <span class="badge bg-white border-pink-200 text-gray-600">บริหารหนี้</span>
                                <span class="badge bg-white border-pink-200 text-gray-600">งานประเมิน</span>
                            </div>
                        </div>
                        <div class="p-4 rounded-xl bg-pink-50/50 border border-pink-100 hover:bg-pink-50 transition-colors">
                            <h4 class="font-bold text-pink-800 mb-2 flex items-center gap-2">
                                <i class="fas fa-file-contract"></i> ผช. ผจก. พิธีการฯ
                            </h4>
                            <div class="flex flex-wrap gap-2">
                                <span class="badge bg-white border-pink-200 text-gray-600">งานพิธีการ</span>
                                <span class="badge bg-white border-pink-200 text-gray-600">กฎหมาย/ชะรีอะฮ</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="collapse collapse-plus bg-white border-l-8 border-purple-600 shadow-md hover:shadow-xl transition-all duration-300">
                <input type="radio" name="org-accordion" />
                <div class="collapse-title text-lg font-bold text-purple-700 bg-purple-50 flex items-center gap-4 py-4 pr-12">
                    <div class="w-12 h-12 rounded-full bg-white shadow-sm flex items-center justify-center text-purple-600 shrink-0">
                        <i class="fas fa-building text-xl"></i>
                    </div>
                    <div>
                        <span class="block text-gray-800 text-xl">รองผู้จัดการใหญ่</span>
                        <span class="text-sm font-normal text-purple-600">สายงานบริหารทั่วไป</span>
                    </div>
                </div>
                <div class="collapse-content bg-white pt-4">
                    <div class="grid md:grid-cols-3 gap-4 pb-2">
                        <div class="p-4 rounded-xl bg-purple-50/50 border border-purple-100 hover:bg-purple-50 transition-colors">
                            <h4 class="font-bold text-purple-800 mb-2 text-sm flex items-center gap-2">
                                <i class="fas fa-calculator"></i> บัญชี/การเงิน
                            </h4>
                            <div class="flex flex-wrap gap-1">
                                <span class="badge badge-sm bg-white border-purple-200">งานบัญชี</span>
                                <span class="badge badge-sm bg-white border-purple-200">งานการเงิน</span>
                            </div>
                        </div>
                        <div class="p-4 rounded-xl bg-purple-50/50 border border-purple-100 hover:bg-purple-50 transition-colors">
                            <h4 class="font-bold text-purple-800 mb-2 text-sm flex items-center gap-2">
                                <i class="fas fa-bullhorn"></i> บริหารทั่วไป
                            </h4>
                            <div class="flex flex-wrap gap-1">
                                <span class="badge badge-sm bg-white border-purple-200">การตลาด</span>
                                <span class="badge badge-sm bg-white border-purple-200">สื่อสารองค์กร</span>
                                <span class="badge badge-sm bg-white border-purple-200">สวัสดิการ</span>
                            </div>
                        </div>
                        <div class="p-4 rounded-xl bg-purple-50/50 border border-purple-100 hover:bg-purple-50 transition-colors">
                            <h4 class="font-bold text-purple-800 mb-2 text-sm flex items-center gap-2">
                                <i class="fas fa-users"></i> บริหารบุคคล
                            </h4>
                            <div class="flex flex-wrap gap-1">
                                <span class="badge badge-sm bg-white border-purple-200">บุคคล</span>
                                <span class="badge badge-sm bg-white border-purple-200">ระเบียบ</span>
                                <span class="badge badge-sm bg-white border-purple-200">จัดซื้อ</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="collapse collapse-plus bg-white border-l-8 border-cyan-500 shadow-md hover:shadow-xl transition-all duration-300">
                <input type="radio" name="org-accordion" />
                <div class="collapse-title text-lg font-bold text-cyan-700 bg-cyan-50 flex items-center gap-4 py-4 pr-12">
                    <div class="w-12 h-12 rounded-full bg-white shadow-sm flex items-center justify-center text-cyan-600 shrink-0">
                        <i class="fas fa-network-wired text-xl"></i>
                    </div>
                    <div>
                        <span class="block text-gray-800 text-xl">รองผู้จัดการใหญ่</span>
                        <span class="text-sm font-normal text-cyan-600">สายงานบริหารสาขาและ IT</span>
                    </div>
                </div>
                <div class="collapse-content bg-white pt-4">
                    <div class="grid md:grid-cols-2 gap-4 pb-2">
                        <div class="p-4 rounded-xl bg-cyan-50/50 border border-cyan-100 hover:bg-cyan-50 transition-colors">
                            <h4 class="font-bold text-cyan-800 mb-2 flex items-center gap-2">
                                <i class="fas fa-store"></i> ผช. ผจก. สาขา
                            </h4>
                            <div class="flex flex-wrap gap-2">
                                <span class="badge bg-white border-cyan-200 text-gray-600">บริหารสาขา</span>
                                <span class="badge bg-white border-cyan-200 text-gray-600">รถโมบาย</span>
                                <span class="badge bg-white border-cyan-200 text-gray-600">สินเชื่อสาขา</span>
                            </div>
                        </div>
                        <div class="p-4 rounded-xl bg-cyan-50/50 border border-cyan-100 hover:bg-cyan-50 transition-colors">
                            <h4 class="font-bold text-cyan-800 mb-2 flex items-center gap-2">
                                <i class="fas fa-laptop-code"></i> ผช. ผจก. IT
                            </h4>
                            <div class="flex flex-wrap gap-2">
                                <span class="badge bg-white border-cyan-200 text-gray-600">งาน IT</span>
                                <span class="badge bg-white border-cyan-200 text-gray-600">ประกันตะกาฟุล</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection
