@extends('layouts.layout') 

@section('title', 'ประวัติความเป็นมา') 

@section('content')
    <div class="container mx-auto px-4 py-12">
        <h1 class="text-4xl font-extrabold text-center text-blue-700 mb-10">ประวัติความเป็นมาของสหกรณ์</h1>

        <div class="relative wrap overflow-hidden p-10 h-full">
            {{-- Timeline Vertical Line --}}
            <div class="absolute h-full border border-green-500" style="left: 50%; transform: translateX(-50%);"></div>
            {{-- เพิ่มเส้นกลางแบบ Tailwind (ถ้าใช้ได้) --}}
            {{-- <div class="absolute h-full border-l-2 border-green-500 left-1/2 transform -translate-x-1/2"></div> --}}


            {{-- Timeline Item 1: 2535 --}}
            <div class="mb-8 flex justify-between items-center w-full timeline-item">
                <div class="order-1 w-full md:w-5/12 px-4 py-4 text-right md:text-right"> {{-- ปรับ w-full สำหรับ mobile --}}
                    <p class="mb-3 text-base text-green-600">พ.ศ. 2535</p>
                    <h4 class="mb-3 font-bold text-lg md:text-2xl text-blue-800">การจัดตั้ง "กองทุนออมทรัพย์ษะกอฟะฮ"</h4>
                    <p class="text-sm md:text-base leading-snug text-gray-700">
                        คณะบุคคลร่วมกันจัดตั้ง "กองทุนออมทรัพย์ษะกอฟะฮ" ขึ้นที่ ต.คลองยาง อ.เกาะลันตา จ.กระบี่ โดยระดมทุนเพื่อช่วยเหลือซึ่งกันและกัน
                    </p>
                </div>
                <div class="z-20 flex items-center order-1 bg-green-500 shadow-xl w-8 h-8 rounded-full md:mx-0 mx-auto"> {{-- mx-auto สำหรับ mobile --}}
                    <h1 class="mx-auto font-semibold text-lg text-white">1</h1>
                </div>
                <div class="order-1 w-full md:w-5/12"></div> {{-- สำหรับ desktop เท่านั้น --}}
            </div>

            {{-- Timeline Item 2: 2538 --}}
            <div class="mb-8 flex justify-between items-center w-full timeline-item flex-row-reverse"> {{-- flex-row-reverse สำหรับสลับด้าน --}}
                <div class="order-1 w-full md:w-5/12 px-4 py-4 text-left md:text-left">
                    <p class="mb-3 text-base text-green-600">พ.ศ. 2538</p>
                    <h4 class="mb-3 font-bold text-lg md:text-2xl text-blue-800">จดทะเบียนเป็น "สหกรณ์ออมทรัพย์ษะกอฟะฮอิสลาม จำกัด"</h4>
                    <p class="text-sm md:text-base leading-snug text-gray-700">
                        หลังจากกองทุนฯ มีความเข้มแข็งในระดับหนึ่ง คณะบุคคลดังกล่าว ดำเนินการจดทะเบียน จากกองทุนมาเป็นสหกรณ์ โดยใช้ชื่อว่า "สหกรณ์ออมทรัพย์ษะกอฟะฮอิสลาม จำกัด" เมื่อวันที่ 7 กุมภาพันธ์ พ.ศ.2538
                    </p>
                </div>
                <div class="z-20 flex items-center order-1 bg-green-500 shadow-xl w-8 h-8 rounded-full md:mx-0 mx-auto">
                    <h1 class="mx-auto font-semibold text-lg text-white">2</h1>
                </div>
                <div class="order-1 w-full md:w-5/12"></div>
            </div>

            {{-- Timeline Item 3: 2542 --}}
            <div class="mb-8 flex justify-between items-center w-full timeline-item">
                <div class="order-1 w-full md:w-5/12 px-4 py-4 text-right md:text-right">
                    <p class="mb-3 text-base text-green-600">พ.ศ. 2542</p>
                    <h4 class="mb-3 font-bold text-lg md:text-2xl text-blue-800">ขยายสาขามาที่ อ.เมืองกระบี่</h4>
                    <p class="text-sm md:text-base leading-snug text-gray-700">
                        ได้ขยายสาขามาเปิดกิจการ ที่ อ.เมืองกระบี่ โดยชั้นร้านอาหารอับดุลเลาะฮ์ เป็นสำนักงานใหญ่
                    </p>
                </div>
                <div class="z-20 flex items-center order-1 bg-green-500 shadow-xl w-8 h-8 rounded-full md:mx-0 mx-auto">
                    <h1 class="mx-auto font-semibold text-lg text-white">3</h1>
                </div>
                <div class="order-1 w-full md:w-5/12"></div>
            </div>

            {{-- Timeline Item 4: 2552 --}}
            <div class="mb-8 flex justify-between items-center w-full timeline-item flex-row-reverse">
                <div class="order-1 w-full md:w-5/12 px-4 py-4 text-left md:text-left">
                    <p class="mb-3 text-base text-green-600">พ.ศ. 2552</p>
                    <h4 class="mb-3 font-bold text-lg md:text-2xl text-blue-800">ย้ายสำนักงานใหญ่ (ครั้งที่ 1)</h4>
                    <p class="text-sm md:text-base leading-snug text-gray-700">
                        ได้ย้ายมาอยู่ที่ 119/9-10 ถ.กระบี่ ต.ปากน้ำ อ.เมือง จ.กระบี่ (ใกล้สามแยกวิทยาลัยเทคนิคกระบี่)
                    </p>
                </div>
                <div class="z-20 flex items-center order-1 bg-green-500 shadow-xl w-8 h-8 rounded-full md:mx-0 mx-auto">
                    <h1 class="mx-auto font-semibold text-lg text-white">4</h1>
                </div>
                <div class="order-1 w-full md:w-5/12"></div>
            </div>

            {{-- Timeline Item 5: ปัจจุบัน --}}
            <div class="mb-8 flex justify-between items-center w-full timeline-item">
                <div class="order-1 w-full md:w-5/12 px-4 py-4 text-right md:text-right">
                    <p class="mb-3 text-base text-green-600">ปัจจุบัน</p>
                    <h4 class="mb-3 font-bold text-lg md:text-2xl text-blue-800">ย้ายสำนักงานใหญ่ (ครั้งที่ 2) และขยายสาขา</h4>
                    <p class="text-sm md:text-base leading-snug text-gray-700">
                        สหกรณ์อิสลามษะกอฟะฮ จำกัด ได้ย้ายมา สนง.ใหญ่ มาอยู่ที่ 291 ม.1 ต.คลองยาง อ.เกาะลันตา จ.กระบี่ มีทั้งหมด 7 สาขา และ 2 หน่วยบริการเคลื่อนที่
                    </p>
                </div>
                <div class="z-20 flex items-center order-1 bg-green-500 shadow-xl w-8 h-8 rounded-full md:mx-0 mx-auto">
                    <h1 class="mx-auto font-semibold text-lg text-white">5</h1>
                </div>
                <div class="order-1 w-full md:w-5/12"></div>
            </div>

        </div>
    </div>

   
@endsection