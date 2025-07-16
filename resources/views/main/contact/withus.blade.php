@extends('layouts.layout') {{-- Use the main layout --}}

@section('title', 'ร่วมงานกับเรา') {{-- Page title --}}

@section('content')
    {{-- Hero Section: Full-screen background image with overlay and main call to action --}}
    <div class="relative w-full min-h-screen bg-cover bg-center overflow-hidden z-0"
         style="background-image: url('{{ asset('images/445.jpg') }}'); background-attachment: fixed !important; background-size: cover !important; background-position: center !important;">
        {{-- Explicitly added !important to background properties for maximum specificity --}}
        
        {{-- Overlay (Darker for better text contrast) --}}
        <div class="absolute inset-0 bg-gray-900 opacity-85 z-10"></div> {{-- Increased opacity to 85% and z-10 --}}

        {{-- Main Content of Hero Section --}}
        <div class="absolute inset-0 flex items-center justify-center z-20"> {{-- z-20 ensures content is above overlay --}}
            <div class="mx-auto max-w-7xl px-6 lg:px-8 text-center"> {{-- Content wrapper --}}
                <div class="mx-auto max-w-4xl"> {{-- Inner content max-width --}}
                    <h1 class="text-5xl md:text-6xl lg:text-7xl font-extrabold tracking-tight text-white mb-6 leading-tight">
                        ร่วมงานกับเรา
                    </h1>
                    <p class="mt-8 text-xl md:text-2xl font-light text-gray-300 leading-relaxed max-w-3xl mx-auto">
                        มาร่วมเป็นส่วนหนึ่งของทีมงานสหกรณ์ออมทรัพย์ษะกอฟะฮ จำกัด เพื่อสร้างอนาคตที่มั่นคงและยั่งยืนไปด้วยกัน
                        เรากำลังมองหาผู้ที่มีความสามารถและมุ่งมั่นที่จะเติบโตไปพร้อมกับเรา
                    </p>
                    <div class="mt-10">
                        <a class="inline-flex items-center bg-white text-blue-700 hover:bg-blue-100 hover:text-blue-800
                                  font-bold py-3 px-8 rounded-full text-xl shadow-lg transition duration-300 transform hover:scale-105"
                           href="{{ url('file/form/ใบสมัครงาน.pdf') }}" target="_blank" rel="noopener noreferrer">
                            <svg class="h-6 w-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                            ดาวน์โหลดใบสมัครงาน
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Main Content Area below the Hero Section --}}
    <div class="container mx-auto px-4 py-12">

        {{-- Section: ทำไมต้องร่วมงานกับเรา (Why Join Us?) --}}
        <section class="bg-white rounded-lg shadow-lg p-8 mb-12 border-t-4 border-green-500">
            <h2 class="text-3xl md:text-4xl font-bold text-center text-green-700 mb-8">ทำไมต้องร่วมงานกับเรา?</h2>
            <p class="text-lg text-gray-700 text-center mb-10 max-w-3xl mx-auto">
                เรามุ่งมั่นที่จะสร้างสภาพแวดล้อมการทำงานที่ส่งเสริมการเติบโต ความมั่นคง และความผาสุกของพนักงานทุกคน
            </p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="flex flex-col items-center text-center p-6 bg-gray-50 rounded-lg shadow-sm transform transition-transform duration-300 hover:scale-105 hover:shadow-lg">
                    <svg class="h-20 w-20 text-green-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">โอกาสเติบโตและพัฒนา</h3>
                    <p class="text-gray-600 text-base">เราสนับสนุนการเรียนรู้และพัฒนาศักยภาพอย่างต่อเนื่องผ่านการฝึกอบรมและประสบการณ์จริง</p>
                </div>
                <div class="flex flex-col items-center text-center p-6 bg-gray-50 rounded-lg shadow-sm transform transition-transform duration-300 hover:scale-105 hover:shadow-lg">
                    <svg class="h-20 w-20 text-blue-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c1.657 0 3 .895 3 2s-1.343 2-3 2-3-.895-3-2 1.343-2 3-2zM9 17a3 3 0 00-3 3v1h12v-1a3 3 0 00-3-3H9z"></path></svg>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">สวัสดิการและผลตอบแทนมั่นคง</h3>
                    <p class="text-gray-600 text-base">เรามอบสวัสดิการที่ครบครันและผลตอบแทนที่เป็นธรรม เพื่อชีวิตที่ดีและมั่นคงของพนักงาน</p>
                </div>
                <div class="flex flex-col items-center text-center p-6 bg-gray-50 rounded-lg shadow-sm transform transition-transform duration-300 hover:scale-105 hover:shadow-lg">
                    <svg class="h-20 w-20 text-yellow-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.653-.146-1.286-.42-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.653.146-1.286.42-1.857m0 0a5 5 0 01-5.356-1.857M10 12a3 3 0 100-6 3 3 0 000 6zm-7 9a2 2 0 01-2-2v-2a2 2 0 012-2h10a2 2 0 012 2v2a2 2 0 01-2 2H3z"></path></svg>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">วัฒนธรรมองค์กรที่เป็นมิตร</h3>
                    <p class="text-gray-600 text-base">สภาพแวดล้อมการทำงานที่ส่งเสริมการทำงานเป็นทีม ความร่วมมือ และความเคารพซึ่งกันและกัน</p>
                </div>
            </div>
        </section>

        {{-- Section: กระบวนการรับสมัคร (Application Process) --}}
        <section class="bg-white rounded-lg shadow-lg p-8 mb-12 border-t-4 border-purple-500">
            <h2 class="text-3xl md:text-4xl font-bold text-center text-purple-700 mb-8">กระบวนการรับสมัคร</h2>
            <p class="text-lg text-gray-700 text-center mb-10 max-w-3xl mx-auto">
                ขั้นตอนการสมัครงานกับสหกรณ์ออมทรัพย์ษะกอฟะฮ จำกัด เป็นเรื่องง่ายและโปร่งใส
            </p>
            <div class="flex flex-col md:flex-row justify-center items-center gap-8">
                {{-- Step 1 --}}
                <div class="flex flex-col items-center text-center w-full md:w-1/4">
                    <div class="w-20 h-20 bg-purple-100 rounded-full flex items-center justify-center text-purple-700 text-4xl font-bold mb-4 shadow-md flex-shrink-0">1</div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">ดาวน์โหลดใบสมัคร</h3>
                    <p class="text-gray-600 text-base">คลิกปุ่ม "ดาวน์โหลดใบสมัครงาน" ด้านบนเพื่อรับแบบฟอร์ม</p>
                </div>
                {{-- Connector Line for Desktop --}}
                <div class="hidden md:flex items-center justify-center flex-shrink-0">
                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </div>
                {{-- Connector Line for Mobile --}}
                <div class="md:hidden w-1 h-12 bg-gray-300"></div>

                {{-- Step 2 --}}
                <div class="flex flex-col items-center text-center w-full md:w-1/4">
                    <div class="w-20 h-20 bg-purple-100 rounded-full flex items-center justify-center text-purple-700 text-4xl font-bold mb-4 shadow-md flex-shrink-0">2</div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">กรอกข้อมูลและเตรียมเอกสาร</h3>
                    <p class="text-gray-600 text-base">กรอกข้อมูลในใบสมัครให้ครบถ้วน พร้อมแนบเอกสารที่เกี่ยวข้องตามที่ระบุ</p>
                </div>
                {{-- Connector Line for Desktop --}}
                <div class="hidden md:flex items-center justify-center flex-shrink-0">
                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </div>
                {{-- Connector Line for Mobile --}}
                <div class="md:hidden w-1 h-12 bg-gray-300"></div>

                {{-- Step 3 --}}
                <div class="flex flex-col items-center text-center w-full md:w-1/4">
                    <div class="w-20 h-20 bg-purple-100 rounded-full flex items-center justify-center text-purple-700 text-4xl font-bold mb-4 shadow-md flex-shrink-0">3</div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">ส่งใบสมัคร</h3>
                    <p class="text-gray-600 text-base">ส่งใบสมัครและเอกสารทั้งหมดได้ที่สำนักงานสหกรณ์ หรือช่องทางที่กำหนด</p>
                </div>
            </div>
        </section>

        {{-- Section: ติดต่อเรา (Call to Action for Contact) --}}
        <section class="bg-blue-700 text-white rounded-lg shadow-lg p-8 text-center mt-12">
            <h2 class="text-3xl font-bold mb-4">มีข้อสงสัยเพิ่มเติม?</h2>
            <p class="text-lg mb-6">
                หากมีข้อสงสัยเกี่ยวกับตำแหน่งงาน หรือกระบวนการสมัคร สามารถติดต่อเราได้โดยตรง
            </p>
            <a href="#" class="bg-white text-blue-700 hover:bg-gray-200 font-bold py-3 px-8 rounded-full text-xl shadow-lg transition duration-300 inline-flex items-center">
                <svg class="h-6 w-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                ติดต่อเรา
            </a>
        </section>
    </div>    
@endsection

{{-- Script for debugging background image loading (for the background-image CSS property) --}}
@push('scripts') {{-- Correctly using @push('scripts') --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const bgDiv = document.querySelector('.relative.w-full.min-h-screen.bg-cover.bg-center');
            // Extract URL from inline style
            const imageUrlMatch = bgDiv.style.backgroundImage.match(/url\(['"]?(.*?)['"]?\)/);
            const imageUrl = imageUrlMatch ? imageUrlMatch[1] : null;

            if (imageUrl) {
                console.log('Attempting to load background image from CSS background-image:', imageUrl);
                const img = new Image();
                img.onload = function() {
                    console.log('Background image (CSS) loaded successfully!');
                };
                img.onerror = function() {
                    console.error('Background image (CSS) failed to load. Please check the file path and existence:', imageUrl);
                    // Fallback to a solid background color if image fails to load
                    bgDiv.style.backgroundColor = '#1a202c'; // Fallback to a dark gray
                };
                img.src = imageUrl;
            } else {
                console.warn('Could not extract background image URL from style. Check if background-image is set correctly.');
                // Fallback to a solid background color if URL is not found
                bgDiv.style.backgroundColor = '#1a202c'; // Fallback to a dark gray
            }
        });
    </script>
@endpush