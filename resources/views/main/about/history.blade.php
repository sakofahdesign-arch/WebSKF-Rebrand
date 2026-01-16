@extends('layouts.layout')

@section('title', 'ประวัติความเป็นมา')

@section('content')
    <section class="py-16 bg-white relative">
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden -z-10 opacity-30 pointer-events-none">
            <div class="absolute top-0 left-1/4 w-96 h-96 bg-green-50 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob"></div>
            <div class="absolute top-0 right-1/4 w-96 h-96 bg-blue-50 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob animation-delay-2000"></div>
        </div>

        <div class="container mx-auto px-4">

            <div class="text-center mb-16 max-w-3xl mx-auto">
                <h1 class="text-3xl md:text-5xl font-extrabold text-green-800 tracking-tight">
                    เส้นทางแห่งความภาคภูมิใจ
                </h1>
                <div class="h-1.5 w-24 bg-green-500 mx-auto rounded-full mt-4 mb-6"></div>
                <p class="text-lg text-gray-600 leading-relaxed">
                    กว่า 3 ทศวรรษแห่งความมุ่งมั่น สหกรณ์อิสลามษะกอฟะฮ จำกัด ได้เติบโตเคียงคู่พี่น้องสมาชิก
                    ด้วยรากฐานที่มั่นคงและหลักการอิสลามที่โปร่งใส สู่การยกระดับคุณภาพชีวิตที่ยั่งยืน
                </p>
            </div>

            <ul class="timeline timeline-snap-icon max-md:timeline-compact timeline-vertical">

                <li>
                    <div class="timeline-middle">
                        <div class="w-12 h-12 bg-green-600 rounded-full flex items-center justify-center text-white shadow-lg ring-4 ring-white z-10">
                            <i class="fas fa-hand-holding-seedling text-lg"></i>
                        </div>
                    </div>
                    <div class="timeline-start md:text-end mb-10 md:px-6 w-full">
                        <div class="card bg-white shadow-md border border-gray-100 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                            <div class="card-body p-6">
                                <div class="flex flex-col md:items-end">
                                    <span class="badge badge-success badge-outline gap-2 font-bold mb-2">จุดเริ่มต้น</span>
                                    <time class="font-mono text-3xl font-black text-green-700">พ.ศ. 2535</time>
                                </div>
                                <h3 class="text-xl font-bold text-gray-800 mt-2">กำเนิด "กองทุนออมทรัพย์ษะกอฟะฮ"</h3>
                                <p class="text-gray-600 text-base leading-relaxed mt-3 text-justify">
                                    จุดเริ่มต้นเล็กๆ ที่ยิ่งใหญ่ ณ ตำบลคลองยาง อำเภอเกาะลันตา จังหวัดกระบี่ คณะบุคคลที่มีอุดมการณ์ร่วมกันได้ริเริ่มจัดตั้ง
                                    <strong>"กองทุนออมทรัพย์ษะกอฟะฮ"</strong> ขึ้น โดยมีเป้าหมายหลักเพื่อสร้างระบบการเงินที่ปราศจากดอกเบี้ย (Riba)
                                    และส่งเสริมการออมเพื่อช่วยเหลือเกื้อกูลซึ่งกันและกันภายในชุมชน นับเป็นก้าวแรกที่สำคัญในการปูรากฐานความเข้มแข็งทางเศรษฐกิจฐานราก
                                </p>
                            </div>
                        </div>
                    </div>
                    <hr class="bg-green-100"/>
                </li>

                <li>
                    <hr class="bg-green-100"/>
                    <div class="timeline-middle">
                        <div class="w-12 h-12 bg-green-600 rounded-full flex items-center justify-center text-white shadow-lg ring-4 ring-white z-10">
                            <i class="fas fa-file-contract text-lg"></i>
                        </div>
                    </div>
                    <div class="timeline-end mb-10 md:px-6 w-full">
                        <div class="card bg-white shadow-md border border-gray-100 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                            <div class="card-body p-6">
                                <div class="flex flex-col md:items-start">
                                    <span class="badge badge-primary badge-outline gap-2 font-bold mb-2">จดทะเบียนนิติบุคคล</span>
                                    <time class="font-mono text-3xl font-black text-green-700">พ.ศ. 2538</time>
                                </div>
                                <h3 class="text-xl font-bold text-gray-800 mt-2">ยกระดับสู่ "สหกรณ์ออมทรัพย์"</h3>
                                <p class="text-gray-600 text-base leading-relaxed mt-3 text-justify">
                                    ด้วยความมุ่งมั่นและการดำเนินงานที่โปร่งใส กองทุนฯ ได้เติบโตและมีความเข้มแข็งขึ้นตามลำดับ
                                    คณะผู้ก่อตั้งจึงได้ดำเนินการยื่นขอจดทะเบียนเป็นนิติบุคคลตามกฎหมายสหกรณ์อย่างเป็นทางการ
                                    ภายใต้ชื่อ <strong>"สหกรณ์ออมทรัพย์ษะกอฟะฮอิสลาม จำกัด"</strong> เมื่อวันที่ 7 กุมภาพันธ์ พ.ศ. 2538
                                    เพื่อสร้างความเชื่อมั่นและขยายขอบเขตการให้บริการแก่สมาชิกได้กว้างขวางยิ่งขึ้น
                                </p>
                            </div>
                        </div>
                    </div>
                    <hr class="bg-green-100"/>
                </li>

                <li>
                    <hr class="bg-green-100"/>
                    <div class="timeline-middle">
                        <div class="w-12 h-12 bg-green-600 rounded-full flex items-center justify-center text-white shadow-lg ring-4 ring-white z-10">
                            <i class="fas fa-city text-lg"></i>
                        </div>
                    </div>
                    <div class="timeline-start md:text-end mb-10 md:px-6 w-full">
                        <div class="card bg-white shadow-md border border-gray-100 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                            <div class="card-body p-6">
                                <div class="flex flex-col md:items-end">
                                    <span class="badge badge-info badge-outline gap-2 font-bold mb-2">ขยายสาขา</span>
                                    <time class="font-mono text-3xl font-black text-green-700">พ.ศ. 2542</time>
                                </div>
                                <h3 class="text-xl font-bold text-gray-800 mt-2">เปิดประตูสู่เมืองกระบี่</h3>
                                <p class="text-gray-600 text-base leading-relaxed mt-3 text-justify">
                                    เพื่อตอบสนองความต้องการของสมาชิกที่เพิ่มจำนวนมากขึ้นในเขตอำเภอเมือง สหกรณ์ฯ ได้ตัดสินใจขยายสาขาเข้ามาเปิดให้บริการในตัวเมืองกระบี่เป็นครั้งแรก
                                    โดยใช้อาคารบริเวณชั้นร้านอาหารอับดุลเลาะฮ์เป็นสำนักงานชั่วคราว การขยายตัวในครั้งนี้ถือเป็นจุดเปลี่ยนสำคัญที่ทำให้สหกรณ์ฯ
                                    เป็นที่รู้จักอย่างแพร่หลายและสามารถเข้าถึงพี่น้องมุสลิมในวงกว้าง
                                </p>
                            </div>
                        </div>
                    </div>
                    <hr class="bg-green-100"/>
                </li>

                <li>
                    <hr class="bg-green-100"/>
                    <div class="timeline-middle">
                        <div class="w-12 h-12 bg-green-600 rounded-full flex items-center justify-center text-white shadow-lg ring-4 ring-white z-10">
                            <i class="fas fa-building text-lg"></i>
                        </div>
                    </div>
                    <div class="timeline-end mb-10 md:px-6 w-full">
                        <div class="card bg-white shadow-md border border-gray-100 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                            <div class="card-body p-6">
                                <div class="flex flex-col md:items-start">
                                    <span class="badge badge-warning badge-outline gap-2 font-bold mb-2">ย้ายสำนักงานใหญ่</span>
                                    <time class="font-mono text-3xl font-black text-green-700">พ.ศ. 2552</time>
                                </div>
                                <h3 class="text-xl font-bold text-gray-800 mt-2">รากฐานที่มั่นคง ณ ถนนกระบี่</h3>
                                <p class="text-gray-600 text-base leading-relaxed mt-3 text-justify">
                                    ด้วยการเติบโตอย่างต่อเนื่อง สหกรณ์ฯ ได้ทำการย้ายสำนักงานใหญ่ (ครั้งที่ 1) มายังอาคารพาณิชย์เลขที่ 119/9-10 ถนนกระบี่
                                    ตำบลปากน้ำ อำเภอเมือง จังหวัดกระบี่ (บริเวณใกล้สามแยกวิทยาลัยเทคนิคกระบี่)
                                    เพื่อรองรับปริมาณธุรกรรมที่เพิ่มขึ้นและอำนวยความสะดวกในการเดินทางให้กับสมาชิก
                                    แสดงถึงความพร้อมในการเป็นสถาบันการเงินหลักของชุมชน
                                </p>
                            </div>
                        </div>
                    </div>
                    <hr class="bg-green-100"/>
                </li>

                <li>
                    <hr class="bg-green-100"/>
                    <div class="timeline-middle">
                        <div class="w-12 h-12 bg-green-800 rounded-full flex items-center justify-center text-white shadow-lg ring-4 ring-green-100 z-10">
                            <i class="fas fa-flag-checkered text-lg"></i>
                        </div>
                    </div>
                    <div class="timeline-start md:text-end mb-10 md:px-6 w-full">
                        <div class="card bg-white shadow-lg border-l-8 border-green-600 hover:shadow-2xl transition-all duration-300">
                            <div class="card-body p-8">
                                <div class="flex flex-col md:items-end">
                                    <span class="badge badge-error badge-outline gap-2 font-bold mb-2">ยุคปัจจุบัน</span>
                                    <time class="font-mono text-3xl font-black text-green-800">ปัจจุบัน</time>
                                </div>
                                <h3 class="text-2xl font-bold text-gray-800 mt-2">สู่องค์กรการเงินระดับแนวหน้า</h3>
                                <p class="text-gray-600 text-base leading-relaxed mt-3 text-justify">
                                    ปัจจุบัน สหกรณ์อิสลามษะกอฟะฮ จำกัด ได้ย้ายสำนักงานใหญ่กลับมายังถิ่นกำเนิด ณ เลขที่ 291 หมู่ที่ 1 ตำบลคลองยาง อำเภอเกาะลันตา จังหวัดกระบี่
                                    เพื่อเป็นศูนย์กลางการบริหารงานที่ครอบคลุม
                                    <br><br>
                                    เรามีความภาคภูมิใจที่ได้ให้บริการสมาชิกผ่านเครือข่ายที่แข็งแกร่ง ประกอบด้วย
                                    <span class="font-bold text-green-700">7 สาขาหลัก</span> และ
                                    <span class="font-bold text-green-700">2 หน่วยบริการเคลื่อนที่ (Mobile Unit)</span>
                                    พร้อมด้วยระบบเทคโนโลยีสารสนเทศที่ทันสมัย เพื่อสร้างความมั่นคงทางการเงินและยกระดับคุณภาพชีวิตของสมาชิกอย่างยั่งยืนตลอดไป
                                </p>
                            </div>
                        </div>
                    </div>
                </li>

            </ul>
        </div>
    </section>
@endsection
