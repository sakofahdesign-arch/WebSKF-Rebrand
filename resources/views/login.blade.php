{{-- This page extends the main layout --}}
@extends('layouts.layout')

{{-- Set the title for this page --}}
@section('title', 'เข้าสู่ระบบสำหรับเจ้าหน้าที่')

{{-- Main content section --}}
@section('content')

<div class="min-h-[calc(100vh-128px)] flex bg-gray-50"> {{-- 128px is approx height of header + footer --}}
    <div class="flex flex-col md:flex-row w-full">

        <!-- Left Side: Image and Welcome Text -->
        <div class="relative hidden md:flex md:w-1/2 items-center justify-center bg-green-800 text-white p-12">
            <div class="absolute inset-0 bg-cover bg-center opacity-20" style="background-image: url('https://images.unsplash.com/photo-1554224155-6726b3ff858f?q=80&w=1911&auto=format&fit=crop');"></div>
            <div class="relative z-10 text-center">
                <a href="/" class="inline-block mb-8">
                     <img class="mx-auto h-16 w-auto" src="{{ asset('images/sakofah-logo.png') }}" alt="Logo" onerror="this.onerror=null;this.src='https://placehold.co/120x120/FFFFFF/FFFFFF?text=S';">
                </a>
                <h1 class="text-4xl font-bold mb-3">ยินดีต้อนรับสู่ระบบจัดการ</h1>
                <p class="text-green-200 text-lg">สหกรณ์อิสลามษะกอฟะฮ จำกัด</p>
                <p class="mt-6 border-t border-green-700 pt-6 text-green-300">
                    กรุณาเข้าสู่ระบบเพื่อเข้าถึงแดชบอร์ดและจัดการข้อมูลของสหกรณ์
                </p>
            </div>
        </div>

        <!-- Right Side: Login Form -->
        <div class="w-full md:w-1/2 flex items-center justify-center p-6 sm:p-12">
            <div class="w-full max-w-md">
                <div class="text-center md:hidden mb-8">
                     <img class="mx-auto h-12 w-auto" src="{{ asset('images/sakofah-logo.png') }}" alt="Logo" onerror="this.onerror=null;this.src='https://placehold.co/100x100/34D399/FFFFFF?text=S';">
                </div>
                <h2 class="text-3xl font-bold text-gray-800 text-center">
                    เข้าสู่ระบบเจ้าหน้าที่
                </h2>
                 <p class="mt-2 text-center text-sm text-gray-600 mb-8">
                    หากคุณไม่ใช่เจ้าหน้าที่ <a href="/" class="font-medium text-green-600 hover:text-green-500">กลับสู่หน้าหลัก</a>
                </p>

                {{-- Display Validation Errors --}}
                @if ($errors->any())
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                        <p class="font-bold">เกิดข้อผิดพลาด</p>
                        <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <!-- Email Input -->
                    <div>
                        <label for="user_id" class="block text-sm font-medium text-gray-700">ชื่อผู้ใช้</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                             <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-gray-400"></i>
                            </div>
                            <input type="text" name="user_id" id="user_id" class="focus:ring-green-500 focus:border-green-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md py-2" placeholder="you@example.com" value="" required >
                        </div>
                    </div>

                    <!-- Password Input -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">รหัสผ่าน</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                             <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400"></i>
                            </div>
                            <input type="password" name="password" id="password" class="focus:ring-green-500 focus:border-green-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md py-2" placeholder="••••••••" required autocomplete="current-password">
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember_me" name="remember" type="checkbox" class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                            <label for="remember_me" class="ml-2 block text-sm text-gray-900">จดจำฉันไว้</label>
                        </div>

                        <div class="text-sm">
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="font-medium text-green-600 hover:text-green-500">
                                    ลืมรหัสผ่าน?
                                </a>
                            @endif
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors">
                            เข้าสู่ระบบ
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
