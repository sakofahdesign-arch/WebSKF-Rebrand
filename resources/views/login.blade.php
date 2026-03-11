@extends('layouts.layout')

@section('title', 'เข้าสู่ระบบสำหรับเจ้าหน้าที่')

@section('content')

<div class="min-h-screen bg-white flex items-center justify-center p-4">

    <div class="card w-full max-w-5xl bg-white shadow-2xl border border-gray-100 overflow-hidden grid md:grid-cols-2 rounded-2xl">

        <div class="relative hidden md:flex flex-col items-center justify-center bg-green-900 text-white p-12 overflow-hidden">
            <div class="absolute inset-0 z-0">
                <img src="https://images.unsplash.com/photo-1556761175-5973dc0f32e7?ixlib=rb-4.0.3&auto=format&fit=crop&w=1632&q=80"
                     alt="Office Background"
                     class="w-full h-full object-cover opacity-10 mix-blend-overlay">
            </div>

            <div class="relative z-10 text-center">
                <div class="mb-6 inline-block bg-white p-4 rounded-full shadow-lg">
                    <img src="{{ asset('images/sakofah-logo.png') }}" alt="Sakofah Logo" class="h-20 w-auto">
                </div>

                <h1 class="text-2xl font-bold mb-2 tracking-wide">ระบบสารสนเทศเพื่อการบริหาร</h1>
                <p class="text-green-100 text-base font-light mb-6">สหกรณ์อิสลามษะกอฟะฮ จำกัด</p>

                <div class="border-t border-green-700/50 pt-6 w-full max-w-xs mx-auto">
                    <p class="text-sm text-green-200 leading-relaxed opacity-90">
                        ระบบสำหรับการปฏิบัติงานของเจ้าหน้าที่ เพื่อการจัดการข้อมูลสมาชิกและธุรกรรมทางการเงินอย่างมีประสิทธิภาพและปลอดภัย
                    </p>
                </div>
            </div>
        </div>

        <div class="p-8 sm:p-12 lg:p-16 flex flex-col justify-center bg-white">

            <div class="mb-8 text-center md:text-left">
                <h2 class="text-3xl font-bold text-gray-800 mb-2">ลงชื่อเข้าใช้งาน</h2>
                <p class="text-gray-500 text-sm">กรุณาระบุบัญชีผู้ใช้และรหัสผ่านเพื่อยืนยันตัวตน</p>
            </div>

            {{-- ส่วนแสดง Error --}}
            @if ($errors->any())
                <div class="alert alert-error bg-red-50 text-red-800 border-red-100 mb-6 flex gap-3 text-sm rounded-lg">
                    <i class="fas fa-exclamation-triangle mt-0.5 text-red-600"></i>
                    <div>
                        <span class="font-bold block">การเข้าสู่ระบบไม่สำเร็จ</span>
                        <ul class="list-disc list-inside mt-1 text-xs opacity-90">
                             @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="space-y-6">
                @csrf

                <div class="form-control w-full">
                    <label class="label pb-1">
                        <span class="label-text font-bold text-gray-700 text-xs uppercase tracking-wider">บัญชีผู้ใช้ / รหัสพนักงาน</span>
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400 z-10">
                            <i class="fas fa-user-circle"></i>
                        </span>
                        <input type="text" name="user_id"
                               placeholder="กรอกบัญชีผู้ใช้"
                               class="input input-bordered w-full pl-10 bg-white text-gray-800 border-gray-300 focus:border-green-600 focus:ring-1 focus:ring-green-600 transition-all"
                               required autofocus>
                    </div>
                </div>

                <div class="form-control w-full">
                    <label class="label pb-1">
                        <span class="label-text font-bold text-gray-700 text-xs uppercase tracking-wider">รหัสผ่าน</span>
                    </label>
                    <div class="relative" x-data="{ show: false }">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400 z-10">
                            <i class="fas fa-key"></i>
                        </span>

                        <input :type="show ? 'text' : 'password'"
                               name="password"
                               class="input input-bordered w-full pl-10 pr-10 bg-white text-gray-800 border-gray-300 focus:border-green-600 focus:ring-1 focus:ring-green-600 transition-all"
                               placeholder="กรอกรหัสผ่านเพื่อเข้าใช้งาน"
                               required>

                        <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-green-700 cursor-pointer focus:outline-none z-10 transition-colors" tabindex="-1">
                             <i class="fas" :class="show ? 'fa-eye-slash' : 'fa-eye'"></i>
                        </button>
                    </div>

                    @if (Route::has('password.request'))
                        <label class="label justify-end pt-1">
                            <a href="#" class="label-text-alt link link-hover text-green-700 font-medium text-xs">ลืมรหัสผ่าน?</a>
                        </label>
                    @endif
                </div>

                <div class="form-control">
                    <label class="label cursor-pointer justify-start gap-3 p-0">
                        <input type="checkbox" name="remember" class="checkbox checkbox-xs checkbox-success rounded bg-white border-gray-400" />
                        <span class="label-text text-gray-600 text-sm">จำการเข้าสู่ระบบไว้ในเครื่องนี้</span>
                    </label>
                </div>

                <button type="submit" class="btn w-full bg-green-700 hover:bg-green-800 border-none text-white text-base font-bold shadow-md hover:shadow-lg transition-all h-12 rounded-lg tracking-wide">
                    <i class="fas fa-sign-in-alt mr-2"></i> เข้าสู่ระบบ
                </button>

            </form>

            <div class="mt-8 text-center border-t border-gray-100 pt-6">
                <p class="text-xs text-gray-400 mb-2">&copy; {{ date('Y') }} สหกรณ์อิสลามษะกอฟะฮ จำกัด. สงวนลิขสิทธิ์.</p>
                <a href="/" class="inline-flex items-center text-sm font-medium text-green-700 hover:text-green-900 transition-colors">
                    <i class="fas fa-arrow-left mr-2 text-xs"></i> กลับสู่หน้าเว็บไซต์หลัก
                </a>
            </div>
        </div>
    </div>
</div>

@endsection
