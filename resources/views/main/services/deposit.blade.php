@extends('layouts.layout')
@section('title', 'บริการเงินฝาก')

@section('content')
<div class="bg-white min-h-screen text-gray-800" data-theme="light" x-data="{ loaded: false }" x-init="() => { setTimeout(() => loaded = true, 50) }">

    <div class="container mx-auto px-4 pt-16 pb-8 text-center transition-all duration-700 ease-out"
         :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-5'">

        <h1 class="text-5xl md:text-6xl font-extrabold text-green-900 mb-6 leading-tight">
            บริการเงินฝาก
        </h1>

        <p class="text-xl md:text-2xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
            เลือกรูปแบบการออมและการลงทุนที่หลากหลาย ตอบโจทย์ทุกเป้าหมายทางการเงินของคุณตามหลักการอิสลาม
        </p>

        <div class="w-24 h-1.5 bg-green-500 mx-auto rounded-full mt-8"></div>
    </div>

    <div class="container mx-auto px-4 py-12 max-w-6xl">

        <div class="space-y-16">

            <div class="card lg:card-side bg-white shadow-xl border border-gray-100 hover:shadow-2xl transition-all duration-500 ease-out transform"
                 :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'">

                <figure class="lg:w-1/3 bg-green-50 p-12 flex flex-col items-center justify-center text-center relative overflow-hidden group">
                    <div class="w-32 h-32 rounded-full bg-green-100 flex items-center justify-center mb-6 shadow-inner ring-4 ring-white">
                        <i class="fas fa-wallet text-5xl text-green-600"></i>
                    </div>
                    <h2 class="card-title text-3xl font-bold text-gray-800 mb-2">เงินฝากวาดีอะฮ</h2>
                    <p class="text-gray-500 text-lg font-medium">(รักษาทรัพย์)</p>
                </figure>

                <div class="card-body lg:w-2/3 p-10">
                    <p class="text-gray-600 text-xl mb-8 leading-relaxed">
                        เหมาะสำหรับการออมระยะสั้น หรือใช้เป็นบัญชีหมุนเวียน ฝากถอนได้ทุกวันทำการ
                    </p>

                    <div class="grid md:grid-cols-2 gap-10">
                        <div>
                            <h3 class="font-bold text-gray-800 text-xl mb-4 flex items-center border-b pb-2">
                                <i class="fas fa-star text-yellow-400 mr-3 text-2xl"></i> ลักษณะบริการ
                            </h3>
                            <ul class="space-y-3">
                                <li class="flex items-start text-gray-700 text-lg">
                                    <i class="fas fa-check-circle text-green-600 mt-1.5 mr-3 flex-shrink-0"></i>
                                    ใช้บริการฝากถอนได้ทุกสาขาและหน่วยบริการเคลื่อนที่ โดยไม่มีค่าธรรมเนียม
                                </li>
                                <li class="flex items-start text-gray-700 text-lg">
                                    <i class="fas fa-check-circle text-green-600 mt-1.5 mr-3 flex-shrink-0"></i>
                                    ใช้เป็นบัญชีเพื่อหักชำระค่าหุ้น หรือหนี้สินกับสหกรณ์ได้
                                </li>
                                <li class="flex items-start text-gray-700 text-lg">
                                    <i class="fas fa-check-circle text-green-600 mt-1.5 mr-3 flex-shrink-0"></i>
                                    ใช้สำหรับรองรับเงินปันผล
                                </li>
                            </ul>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-800 text-xl mb-4 flex items-center border-b pb-2">
                                <i class="fas fa-file-contract text-gray-400 mr-3 text-2xl"></i> เงื่อนไขการให้บริการ
                            </h3>
                            <ul class="space-y-3">
                                <li class="flex items-start text-gray-700 text-lg">
                                    <i class="fas fa-info-circle text-gray-400 mt-1.5 mr-3 flex-shrink-0"></i>
                                    เปิดบัญชีครั้งแรกไม่ต่ำกว่า 100 บาท
                                </li>
                                <li class="flex items-start text-gray-700 text-lg">
                                    <i class="fas fa-info-circle text-gray-400 mt-1.5 mr-3 flex-shrink-0"></i>
                                    ฝาก-ถอน ได้ตลอดเวลาทำการ
                                </li>
                                <li class="flex items-start text-gray-700 text-lg">
                                    <i class="fas fa-info-circle text-gray-400 mt-1.5 mr-3 flex-shrink-0"></i>
                                    เป็นการออมเพื่อให้สหกรณ์ฯ รักษาทรัพย์ โดยไม่มีผลตอบแทน
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card lg:card-side bg-white shadow-xl border border-gray-100 hover:shadow-2xl transition-all duration-500 ease-out transform"
                 :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'"
                 style="transition-delay: 150ms">

                <figure class="lg:w-1/3 bg-blue-50 p-12 flex flex-col items-center justify-center text-center relative overflow-hidden group">
                    <div class="w-32 h-32 rounded-full bg-blue-100 flex items-center justify-center mb-6 shadow-inner ring-4 ring-white">
                        <i class="fas fa-handshake text-5xl text-blue-600"></i>
                    </div>
                    <h2 class="card-title text-3xl font-bold text-gray-800 mb-2">เงินฝากมูฏอรอบะฮ</h2>
                    <p class="text-gray-500 text-lg font-medium">(ร่วมลงทุน)</p>
                </figure>

                <div class="card-body lg:w-2/3 p-10">
                    <p class="text-gray-600 text-xl mb-8 leading-relaxed">
                        เป็นบัญชีเงินฝากเพื่อการร่วมลงทุนธุรกิจกับสหกรณ์ภายใต้หลักมูฎอรอบะฮ
                    </p>

                    <div class="grid md:grid-cols-2 gap-10">
                        <div>
                            <h3 class="font-bold text-gray-800 text-xl mb-4 flex items-center border-b pb-2">
                                <i class="fas fa-star text-yellow-400 mr-3 text-2xl"></i> ลักษณะบริการ
                            </h3>
                            <ul class="space-y-3">
                                <li class="flex items-start text-gray-700 text-lg">
                                    <i class="fas fa-check-circle text-blue-600 mt-1.5 mr-3 flex-shrink-0"></i>
                                    ใช้บริการฝากถอนได้ทุกสาขารวมถึงหน่วยบริการสหกรณ์เคลื่อนที่ได้โดยไม่มีค่าธรรมเนียม
                                </li>
                            </ul>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-800 text-xl mb-4 flex items-center border-b pb-2">
                                <i class="fas fa-file-contract text-gray-400 mr-3 text-2xl"></i> เงื่อนไขการให้บริการ
                            </h3>
                            <ul class="space-y-3">
                                <li class="flex items-start text-gray-700 text-lg">
                                    <i class="fas fa-info-circle text-gray-400 mt-1.5 mr-3 flex-shrink-0"></i>
                                    เปิดบัญชีครั้งแรกไม่ต่ำกว่า 10,000 บาท
                                </li>
                                <li class="flex items-start text-gray-700 text-lg">
                                    <i class="fas fa-info-circle text-gray-400 mt-1.5 mr-3 flex-shrink-0"></i>
                                    ฝาก - ถอน ได้ตลอดเวลาทำการ
                                </li>
                                <li class="flex items-start text-gray-700 text-lg">
                                    <i class="fas fa-info-circle text-gray-400 mt-1.5 mr-3 flex-shrink-0"></i>
                                    มีปันผลให้แก่สมาชิก ทุกๆ 3 เดือน ตามไตรมาสสหกรณ์
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card lg:card-side bg-white shadow-xl border border-gray-100 hover:shadow-2xl transition-all duration-500 ease-out transform"
                 :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'"
                 style="transition-delay: 300ms">

                <figure class="lg:w-1/3 bg-orange-50 p-12 flex flex-col items-center justify-center text-center relative overflow-hidden group">
                    <div class="w-32 h-32 rounded-full bg-orange-100 flex items-center justify-center mb-6 shadow-inner ring-4 ring-white">
                        <i class="fas fa-graduation-cap text-5xl text-orange-600"></i>
                    </div>
                    <h2 class="card-title text-3xl font-bold text-gray-800 mb-2">เงินฝากพิเศษ เพื่อการศึกษา</h2>
                    <p class="text-gray-500 text-lg font-medium">(Special Education)</p>
                </figure>

                <div class="card-body lg:w-2/3 p-10">
                    <p class="text-gray-600 text-xl mb-8 leading-relaxed">
                        เหมาะกับบุตรหลานที่ผู้ปกครองต้องการฝากเงินสะสมให้จนโต
                    </p>

                    <div class="grid md:grid-cols-2 gap-10">
                        <div>
                            <h3 class="font-bold text-gray-800 text-xl mb-4 flex items-center border-b pb-2">
                                <i class="fas fa-star text-yellow-400 mr-3 text-2xl"></i> ลักษณะบริการ
                            </h3>
                            <ul class="space-y-3">
                                <li class="flex items-start text-gray-700 text-lg">
                                    <i class="fas fa-check-circle text-orange-600 mt-1.5 mr-3 flex-shrink-0"></i>
                                    เมื่อครบกำหนด 5 ปี สามารถปิดบัญชีพร้อมรับทุนการศึกษาจากสหกรณ์
                                </li>
                                <li class="flex items-start text-gray-700 text-lg">
                                    <i class="fas fa-check-circle text-orange-600 mt-1.5 mr-3 flex-shrink-0"></i>
                                    สามารถฝากสะสมต่อไปได้อีก หากยังไม่ต้องการปิดบัญชี
                                </li>
                            </ul>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-800 text-xl mb-4 flex items-center border-b pb-2">
                                <i class="fas fa-file-contract text-gray-400 mr-3 text-2xl"></i> เงื่อนไขการให้บริการ
                            </h3>
                            <ul class="space-y-3">
                                <li class="flex items-start text-gray-700 text-lg">
                                    <i class="fas fa-info-circle text-gray-400 mt-1.5 mr-3 flex-shrink-0"></i>
                                    เปิดบัญชีครั้งแรกตั้งแต่ 200 / 500 / 1,000 / 1,500 บาท
                                </li>
                                <li class="flex items-start text-gray-700 text-lg">
                                    <i class="fas fa-info-circle text-gray-400 mt-1.5 mr-3 flex-shrink-0"></i>
                                    ฝากเป็นประจำทุกเดือนตามจำนวนเงินที่เปิดบัญชี
                                </li>
                                <li class="flex items-start text-gray-700 text-lg">
                                    <i class="fas fa-info-circle text-gray-400 mt-1.5 mr-3 flex-shrink-0"></i>
                                    ฝากต่อเนื่องครบ 5 ปี สหกรณ์ฯ จะสมทบทุนการศึกษาให้ 1,200 / 3,000 / 6,000 / 9,000 บาท
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card lg:card-side bg-white shadow-xl border border-gray-100 hover:shadow-2xl transition-all duration-500 ease-out transform"
                 :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'"
                 style="transition-delay: 450ms">

                <figure class="lg:w-1/3 bg-yellow-50 p-12 flex flex-col items-center justify-center text-center relative overflow-hidden group">
                    <div class="w-32 h-32 rounded-full bg-yellow-100 flex items-center justify-center mb-6 shadow-inner ring-4 ring-white">
                        <i class="fas fa-kaaba text-5xl text-yellow-600"></i>
                    </div>
                    <h2 class="card-title text-3xl font-bold text-gray-800 mb-2">เงินฝากพิเศษ ฮัจย์-อุมเราะห์</h2>
                    <p class="text-gray-500 text-lg font-medium">(Special Hajj-Umrah)</p>
                </figure>

                <div class="card-body lg:w-2/3 p-10">
                    <p class="text-gray-600 text-xl mb-8 leading-relaxed">
                        บัญชีเพื่อการออมเงินแบบมีเป้าหมายเพื่อการประกอบพิธีฮัจย์หรืออุมเราะห์
                    </p>

                    <div class="grid md:grid-cols-2 gap-10">
                        <div>
                            <h3 class="font-bold text-gray-800 text-xl mb-4 flex items-center border-b pb-2">
                                <i class="fas fa-star text-yellow-400 mr-3 text-2xl"></i> ลักษณะบริการ
                            </h3>
                            <ul class="space-y-3">
                                <li class="flex items-start text-gray-700 text-lg">
                                    <i class="fas fa-check-circle text-yellow-600 mt-1.5 mr-3 flex-shrink-0"></i>
                                    การถอนเงินจะทำได้ก็ต่อเมื่อถึงกำหนดเวลาเดินทางไปประกอบพิธี
                                </li>
                            </ul>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-800 text-xl mb-4 flex items-center border-b pb-2">
                                <i class="fas fa-file-contract text-gray-400 mr-3 text-2xl"></i> เงื่อนไขการให้บริการ
                            </h3>
                            <ul class="space-y-3">
                                <li class="flex items-start text-gray-700 text-lg">
                                    <i class="fas fa-info-circle text-gray-400 mt-1.5 mr-3 flex-shrink-0"></i>
                                    เปิดบัญชีครั้งแรกไม่ต่ำกว่า 500 บาท
                                </li>
                                <li class="flex items-start text-gray-700 text-lg">
                                    <i class="fas fa-info-circle text-gray-400 mt-1.5 mr-3 flex-shrink-0"></i>
                                    เมื่อเงินฝากในบัญชีมีตั้งแต่ 10,000 บาทขึ้นไป จะได้รับเงินปันผลทุก 3 เดือน
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card lg:card-side bg-white shadow-xl border border-gray-100 hover:shadow-2xl transition-all duration-500 ease-out transform"
                 :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'"
                 style="transition-delay: 600ms">

                <figure class="lg:w-1/3 bg-red-50 p-12 flex flex-col items-center justify-center text-center relative overflow-hidden group">
                    <div class="w-32 h-32 rounded-full bg-red-100 flex items-center justify-center mb-6 shadow-inner ring-4 ring-white">
                        <i class="fas fa-leaf text-5xl text-red-600"></i>
                    </div>
                    <h2 class="card-title text-3xl font-bold text-gray-800 mb-2">เงินฝากพิเศษ เพื่อกุรบาน</h2>
                    <p class="text-gray-500 text-lg font-medium">(Special Qurban)</p>
                </figure>

                <div class="card-body lg:w-2/3 p-10">
                    <p class="text-gray-600 text-xl mb-8 leading-relaxed">
                        บัญชีเพื่อการออมเงินแบบมีเป้าหมายเพื่อการทำกุรบาน
                    </p>

                    <div class="grid md:grid-cols-2 gap-10">
                        <div>
                            <h3 class="font-bold text-gray-800 text-xl mb-4 flex items-center border-b pb-2">
                                <i class="fas fa-star text-yellow-400 mr-3 text-2xl"></i> ลักษณะบริการ
                            </h3>
                            <ul class="space-y-3">
                                <li class="flex items-start text-gray-700 text-lg">
                                    <i class="fas fa-check-circle text-red-600 mt-1.5 mr-3 flex-shrink-0"></i>
                                    การถอนเงินจะกระทำได้กรณีทำกุรบานหรือถอนเพื่อปิดบัญชีเท่านั้น
                                </li>
                            </ul>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-800 text-xl mb-4 flex items-center border-b pb-2">
                                <i class="fas fa-file-contract text-gray-400 mr-3 text-2xl"></i> เงื่อนไขการให้บริการ
                            </h3>
                            <ul class="space-y-3">
                                <li class="flex items-start text-gray-700 text-lg">
                                    <i class="fas fa-info-circle text-gray-400 mt-1.5 mr-3 flex-shrink-0"></i>
                                    เปิดบัญชีครั้งแรกไม่ต่ำกว่า 500 บาท
                                </li>
                                <li class="flex items-start text-gray-700 text-lg">
                                    <i class="fas fa-info-circle text-gray-400 mt-1.5 mr-3 flex-shrink-0"></i>
                                    ฝากครั้งต่อไปไม่ต่ำกว่า 200 บาท
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="mt-24 text-center bg-gradient-to-r from-green-600 to-teal-500 rounded-3xl p-12 md:p-20 text-white shadow-2xl relative overflow-hidden transition-all duration-700 delay-500"
             :class="loaded ? 'opacity-100 scale-100' : 'opacity-0 scale-95'">
            <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-10 rounded-full -mr-16 -mt-16 blur-2xl"></div>
            <div class="absolute bottom-0 left-0 w-48 h-48 bg-white opacity-10 rounded-full -ml-10 -mb-10 blur-xl"></div>

            <h2 class="text-4xl md:text-5xl font-bold mb-6 relative z-10">เปิดบัญชีกับเราวันนี้</h2>
            <p class="text-green-50 text-xl md:text-2xl mb-10 max-w-3xl mx-auto relative z-10 leading-relaxed">
                สร้างรากฐานทางการเงินที่มั่นคงและถูกต้องตามหลักศาสนา เพื่ออนาคตที่ดีของคุณและครอบครัว
            </p>
            <div class="flex flex-col sm:flex-row gap-6 justify-center relative z-10">
                <a href="{{ url('/register') }}" class="btn btn-lg h-16 px-10 text-xl bg-white text-green-700 hover:bg-green-50 border-none shadow-lg">
                    <i class="fas fa-user-plus mr-3"></i> สมัครสมาชิก
                </a>
                <a href="{{ url('/contact') }}" class="btn btn-lg h-16 px-10 text-xl btn-outline text-white border-2 border-white hover:bg-white hover:text-green-700 hover:border-white">
                    <i class="fas fa-map-marker-alt mr-3"></i> ค้นหาสาขาใกล้บ้าน
                </a>
            </div>
        </div>

    </div>
</div>
@endsection
