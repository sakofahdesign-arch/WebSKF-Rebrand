@extends('layouts.layout') {{-- Use the main layout --}}

@section('title', 'สวัสดิการการแต่งงาน') {{-- Page title --}}

@section('content')
    <div class="container mx-auto px-4 py-12">
        <h1 class="text-4xl font-extrabold text-center text-blue-700 mb-10">สวัสดิการการแต่งงาน</h1>

        <p class="text-lg text-gray-700 text-center mb-12 max-w-3xl mx-auto">
            สหกรณ์ออมทรัพย์ษะกอฟะฮ จำกัด มอบสวัสดิการการแต่งงานเพื่อเป็นส่วนหนึ่งในการร่วมยินดีกับสมาชิก
        </p>

        {{-- Section: การขอรับสวัสดิการและเอกสารที่เกี่ยวข้อง (Applying for Welfare and Required Documents) --}}
        <section class="bg-white rounded-lg shadow-lg p-8 mb-12 border-t-4 border-green-500">
            <h2 class="text-3xl font-bold text-center text-green-700 mb-8 flex items-center justify-center">
                <svg class="h-8 w-8 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                การขอรับสวัสดิการและเอกสาร
            </h2>
            <div class="flex flex-col md:flex-row items-center justify-center gap-8 mb-8"> {{-- Added mb-8 for spacing before documents list --}}
                <div class="md:w-1/2 text-center md:text-left">
                    <p class="text-xl text-gray-700 leading-relaxed mb-4">
                        สวัสดิการการแต่งงาน ตั้งแต่ <strong class="text-green-600">1,000-2,000 บาท</strong>
                        <br>(รับสิทธิ์ได้เพียงครั้งเดียว)
                    </p>
                    <p class="text-lg text-gray-700 leading-relaxed">
                        ยื่นเอกสารขอรับสวัสดิการภายใน <strong class="text-blue-600">90 วัน</strong> นับจากวันแต่งงาน
                    </p>
                </div>
                <div class="md:w-1/2 flex justify-center">
                    
                    <img src="{{asset('images/welfare/123456.jpg')}}" alt="คู่บ่าวสาว" class="w-full max-w-md rounded-lg shadow-md border border-gray-200">
                </div>
            </div>

            {{-- Sub-section: เอกสารที่ใช้ในการขอรับสวัสดิการ (Required Documents) --}}
            <h3 class="text-2xl font-bold text-center text-blue-700 mb-6 flex items-center justify-center">
                <svg class="h-7 w-7 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                เอกสารที่ใช้ในการขอรับสวัสดิการ
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-lg text-gray-700">
                <div class="flex items-start">
                    <svg class="h-6 w-6 text-green-500 mr-3 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    <span>ใบนะกะฮ์ หรือ ทะเบียนสมรส</span>
                </div>
                <div class="flex items-start">
                    <svg class="h-6 w-6 text-green-500 mr-3 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    <span>สำเนาบัตรประชาชน</span>
                </div>
                <div class="flex items-start md:col-span-2"> {{-- Spans 2 columns on md screens --}}
                    <svg class="h-6 w-6 text-green-500 mr-3 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    <span>สมุดบัญชีทุนเรือนหุ้น</span>
                </div>
            </div>
        </section>

        {{-- Call to Action Section --}}
        <section class="bg-blue-700 text-white rounded-lg shadow-lg p-8 text-center mt-12">
            <h2 class="text-3xl font-bold mb-4">มีข้อสงสัยเกี่ยวกับสวัสดิการ?</h2>
            <p class="text-lg mb-6">
                ติดต่อสอบถามเจ้าหน้าที่สหกรณ์เพื่อข้อมูลเพิ่มเติมและเงื่อนไขการขอรับสิทธิ์
            </p>
            <a href="#" class="bg-white text-blue-700 hover:bg-gray-200 font-bold py-3 px-8 rounded-full text-xl shadow-lg transition duration-300 inline-flex items-center">
                <svg class="h-6 w-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v4a1 1 0 001 1h2m-2 0h4m-4 0h.01M12 16l-4-4m4 4l4-4m-4 4v4m0-4h.01M12 3c-1.105 0-2 .895-2 2v1h4V5c0-1.105-.895-2-2-2zM4 9h16a1 1 0 011 1v10a1 1 0 01-1 1H4a1 1 0 01-1-1V10a1 1 0 011-1z"></path></svg>
                ติดต่อเจ้าหน้าที่
            </a>
        </section>

    </div>
@endsection
