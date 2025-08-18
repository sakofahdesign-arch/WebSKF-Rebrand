@extends('layouts.layout')
@section('title', 'ติดต่อเรา')
@push('styles')
    <style>
        @keyframes gradient-animate {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeIn 1s ease-out forwards;
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.8s ease-out forwards;
            opacity: 0;
            /* Initial state */
        }

        .animate-fade-in-up.delay-200 {
            animation-delay: 0.2s;
        }

        .animate-fade-in-up.delay-400 {
            animation-delay: 0.4s;
        }
    </style>
@endpush
@section('content')
    <div class="container mx-auto max-w-2xl py-12 px-4 sm:px-6 lg:px-8">
        <div
            class="relative bg-white p-8 rounded-2xl shadow-2xl border-4 border-emerald-300 transform transition-transform duration-500 hover:scale-[1.01] overflow-hidden">
            <!-- Animated frame/border effect -->
            <div class="absolute inset-0 rounded-2xl z-0"
                style="background: linear-gradient(-45deg, #d1fae5, #6ee7b7, #a7f3d0, #34d399); background-size: 400% 400%; animation: gradient-animate 10s ease infinite; opacity: 0.25;">
            </div>

            <div class="relative z-10 text-center">
                <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-4 animate-fade-in-up">ติดต่อเรา</h1>
                <p class="text-gray-600 mb-8 animate-fade-in">
                    หากมีข้อสงสัยหรือต้องการสอบถามข้อมูลเพิ่มเติม สามารถติดต่อเราได้ตามรายละเอียดด้านล่าง
                </p>

                <div class="space-y-8 mt-10">
                    <!-- Address Section -->
                    <div class="flex flex-col items-center animate-fade-in-up delay-200">
                        <div
                            class="bg-gradient-to-br from-green-400 to-green-600 text-white p-5 rounded-full mb-3 shadow-lg transform transition-transform duration-300 hover:scale-110">
                            <i class="fas fa-map-marker-alt text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-1">ที่อยู่</h3>
                        <p class="text-gray-600">
                            เลขที่ 291 หมู่ที่ 1 ตำบลคลองยาง อำเภอเกาะลันตา จังหวัดกระบี่ 81120
                        </p>
                    </div>

                    <!-- Phone Section -->
                    <div class="flex flex-col items-center animate-fade-in-up delay-400">
                        <div
                            class="bg-gradient-to-br from-green-400 to-green-600 text-white p-5 rounded-full mb-3 shadow-lg transform transition-transform duration-300 hover:scale-110">
                            <i class="fas fa-phone-alt text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-1">เบอร์โทรศัพท์</h3>
                        <a href="tel:075652525" class="text-gray-600 hover:text-green-600 transition duration-300">
                            075-652-525
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection