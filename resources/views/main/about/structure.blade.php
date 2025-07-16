@extends('layouts.layout')

@section('title', 'โครงสร้างสหกรณ์') 
@section('content')
    {{-- Main Card Container for the entire page content --}}
    <div class="bg-white rounded-lg shadow-lg p-8 mb-12 border-t-4 border-gray-300">
        <div class="container mx-auto px-4 py-12">
            <h1 class="text-4xl font-extrabold text-center text-blue-700 mb-10">โครงสร้างองค์กร</h1>



            {{-- Level 1: สมาชิก (Members) --}}
            <div class="flex justify-center mb-4">
                <div class="bg-blue-100 p-4 rounded-lg shadow-md text-center border border-blue-300">
                    <h3 class="text-xl font-bold text-blue-800">สมาชิก</h3>
                    <p class="text-blue-600 text-sm">Members</p>
                </div>
            </div>
            <div class="flex justify-center">
                <div class="w-1 h-8 bg-gray-300"></div>
            </div>

            {{-- Level 2: ที่ประชุมใหญ่ (General Assembly) --}}
            <div class="flex justify-center mb-8">
                <div class="bg-green-100 p-4 rounded-lg shadow-md text-center border border-green-300">
                    <h3 class="text-xl font-bold text-green-800">ที่ประชุมใหญ่</h3>
                    <p class="text-green-600 text-sm">General Assembly</p>
                </div>
            </div>

            {{-- Connector from General Assembly to Level 3 Committees --}}
            <div class="flex justify-center relative mb-8">
                <div class="w-1 h-12 bg-gray-300"></div> {{-- Vertical line down from General Assembly --}}
                <div class="absolute w-full h-1 bg-gray-300 top-1/2 transform -translate-y-1/2"></div> {{-- Horizontal line --}}
                {{-- Vertical lines down to each committee (positioned absolutely relative to this container) --}}
                <div class="absolute left-1/4 -ml-0.5 w-1 h-12 bg-gray-300 top-1/2 transform -translate-y-1/2"></div>
                <div class="absolute left-1/2 -ml-0.5 w-1 h-12 bg-gray-300 top-1/2 transform -translate-y-1/2"></div>
                <div class="absolute right-1/4 -mr-0.5 w-1 h-12 bg-gray-300 top-1/2 transform -translate-y-1/2"></div>
                {{-- More precise positioning for 5 items --}}
                <div class="absolute w-1 h-12 bg-gray-300 top-1/2 transform -translate-y-1/2"
                    style="left: calc(10% - 0.5px);"></div>
                <div class="absolute w-1 h-12 bg-gray-300 top-1/2 transform -translate-y-1/2"
                    style="left: calc(30% - 0.5px);"></div>
                <div class="absolute w-1 h-12 bg-gray-300 top-1/2 transform -translate-y-1/2"
                    style="left: calc(50% - 0.5px);"></div>
                <div class="absolute w-1 h-12 bg-gray-300 top-1/2 transform -translate-y-1/2"
                    style="left: calc(70% - 0.5px);"></div>
                <div class="absolute w-1 h-12 bg-gray-300 top-1/2 transform -translate-y-1/2"
                    style="left: calc(90% - 0.5px);"></div>
            </div>


            {{-- Level 3: Committees (Auditor, Supervisory, Board, Zakat, School) --}}
            <div class="flex flex-col md:flex-row justify-center items-start md:items-stretch gap-4 mb-8">
                {{-- ผู้สอบบัญชี (Auditor) --}}
                <div
                    class="flex flex-col items-center w-full md:w-1/5 p-3 bg-gray-50 rounded-lg shadow-sm border border-gray-200 text-center">
                    <h3 class="text-base font-semibold text-gray-800">ผู้สอบบัญชี</h3>
                    <p class="text-gray-600 text-xs">Auditor</p>
                </div>
                {{-- คณะกรรมการกำกับและพิทักษ์รักษา (Supervisory and Custodian Committee) --}}
                <div
                    class="flex flex-col items-center w-full md:w-1/5 p-3 bg-gray-50 rounded-lg shadow-sm border border-gray-200 text-center">
                    <h3 class="text-base font-semibold text-gray-800">คณะกรรมการกำกับและพิทักษ์รักษา</h3>
                    <p class="text-gray-600 text-xs">Supervisory and Custodian Committee</p>
                </div>
                {{-- คณะกรรมการ (Board of Directors) --}}
                <div
                    class="flex flex-col items-center w-full md:w-1/5 p-3 bg-blue-100 rounded-lg shadow-md border border-blue-300 text-center">
                    <h3 class="text-base font-semibold text-blue-800">คณะกรรมการ</h3>
                    <p class="text-blue-600 text-xs">Board of Directors</p>
                </div>
                {{-- คณะกรรมการทุนธุนุมัติษะกอฟะฮ (Zakat Fund Approval Committee) --}}
                <div
                    class="flex flex-col items-center w-full md:w-1/5 p-3 bg-gray-50 rounded-lg shadow-sm border border-gray-200 text-center">
                    <h3 class="text-base font-semibold text-gray-800">คณะกรรมการทุนธุนุมัติษะกอฟะฮ</h3>
                    <p class="text-gray-600 text-xs">Zakat Fund Approval Committee</p>
                </div>
                {{-- โรงเรียนษะกอฟะฮ์วิทยาพัฒน์ (Sakofah Wittayapat School) --}}
                <div
                    class="flex flex-col items-center w-full md:w-1/5 p-3 bg-gray-50 rounded-lg shadow-sm border border-gray-200 text-center">
                    <h3 class="text-base font-semibold text-gray-800">โรงเรียนษะกอฟะฮ์วิทยาพัฒน์</h3>
                    <p class="text-gray-600 text-xs">Sakofah Wittayapat School</p>
                </div>
            </div>

            {{-- Connector from คณะกรรมการ (Board of Directors) to ผู้จัดการใหญ่ (General Manager) --}}
            <div class="flex justify-center mb-8">
                <div class="w-1 h-12 bg-gray-300"></div>
            </div>

            {{-- Level 4: ผู้จัดการใหญ่ (General Manager) --}}
            <div class="flex justify-center mb-8">
                <div class="bg-purple-100 p-4 rounded-lg shadow-md text-center border border-purple-300">
                    <h3 class="text-xl font-bold text-purple-800">ผู้จัดการใหญ่</h3>
                    <p class="text-purple-600 text-sm">General Manager</p>
                </div>
            </div>

            {{-- Connector from ผู้จัดการใหญ่ to คณะกรรมการบริหาร (Management Committee) --}}
            <div class="flex justify-center mb-8">
                <div class="w-1 h-12 bg-gray-300"></div>
            </div>

            {{-- Level 5: คณะกรรมการบริหาร (Management Committee) --}}
            <div class="flex justify-center mb-8">
                <div class="bg-orange-100 p-4 rounded-lg shadow-md text-center border border-orange-300">
                    <h3 class="text-xl font-bold text-orange-800">คณะกรรมการบริหาร</h3>
                    <p class="text-orange-600 text-sm">Management Committee</p>
                </div>
            </div>

            {{-- Connector from Management Committee to Deputy General Managers --}}
            <div class="flex justify-center relative mb-8">
                <div class="w-1 h-12 bg-gray-300"></div> {{-- Vertical line down from Management Committee --}}
                <div class="absolute w-full h-1 bg-gray-300 top-1/2 transform -translate-y-1/2"></div>
                {{-- Horizontal line --}}
                {{-- Vertical lines down to each Deputy General Manager --}}
                <div class="absolute w-1 h-12 bg-gray-300 top-1/2 transform -translate-y-1/2"
                    style="left: calc(20% - 0.5px);"></div>
                <div class="absolute w-1 h-12 bg-gray-300 top-1/2 transform -translate-y-1/2"
                    style="left: calc(50% - 0.5px);"></div>
                <div class="absolute w-1 h-12 bg-gray-300 top-1/2 transform -translate-y-1/2"
                    style="left: calc(80% - 0.5px);"></div>
            </div>

            {{-- Level 6: รองผู้จัดการใหญ่ (Deputy General Managers) --}}
            <div class="flex flex-col md:flex-row justify-center items-start md:items-stretch gap-8 mb-8">
                {{-- รองผู้จัดการใหญ่ สายงานสินเชื่อและบริหารหนี้ (Credit & Debt Management) --}}
                <div
                    class="flex flex-col items-center w-full md:w-1/3 p-4 bg-yellow-100 rounded-lg shadow-md border border-yellow-300 text-center">
                    <h3 class="text-lg font-bold text-yellow-800">รองผู้จัดการใหญ่ สายงานสินเชื่อและบริหารหนี้</h3>
                    <p class="text-yellow-600 text-sm">Deputy General Manager, Credit & Debt Management</p>
                    {{-- Connector to departments --}}
                    <div class="w-1 h-8 bg-gray-300 mt-4"></div>
                    <div class="flex flex-wrap justify-center gap-2 mt-2 w-full">
                        <div class="bg-gray-50 p-2 rounded-lg shadow-sm text-center text-sm w-full sm:w-[calc(50%-0.5rem)]">
                            ส่วนงานสินเชื่อและบริหารหนี้</div>
                        <div class="bg-gray-50 p-2 rounded-lg shadow-sm text-center text-sm w-full sm:w-[calc(50%-0.5rem)]">
                            ส่วนงานสินเชื่อ</div>
                        <div class="bg-gray-50 p-2 rounded-lg shadow-sm text-center text-sm w-full sm:w-[calc(50%-0.5rem)]">
                            ส่วนงานบริหารหนี้</div>
                        <div class="bg-gray-50 p-2 rounded-lg shadow-sm text-center text-sm w-full sm:w-[calc(50%-0.5rem)]">
                            ส่วนงานประเมินและบริหารสินทรัพย์</div>
                    </div>
                </div>

                {{-- รองผู้จัดการใหญ่ สายงานบริหารทั่วไป (General Administration) --}}
                <div
                    class="flex flex-col items-center w-full md:w-1/3 p-4 bg-teal-100 rounded-lg shadow-md border border-teal-300 text-center">
                    <h3 class="text-lg font-bold text-teal-800">รองผู้จัดการใหญ่ สายงานบริหารทั่วไป</h3>
                    <p class="text-teal-600 text-sm">Deputy General Manager, General Administration</p>
                    {{-- Connector to departments --}}
                    <div class="w-1 h-8 bg-gray-300 mt-4"></div>
                    <div class="flex flex-wrap justify-center gap-2 mt-2 w-full">
                        <div class="bg-gray-50 p-2 rounded-lg shadow-sm text-center text-sm w-full sm:w-[calc(50%-0.5rem)]">
                            ส่วนงานบัญชี</div>
                        <div class="bg-gray-50 p-2 rounded-lg shadow-sm text-center text-sm w-full sm:w-[calc(50%-0.5rem)]">
                            ส่วนงานการเงิน</div>
                        <div class="bg-gray-50 p-2 rounded-lg shadow-sm text-center text-sm w-full sm:w-[calc(50%-0.5rem)]">
                            ส่วนงานจัดซื้อจัดจ้าง</div>
                        <div class="bg-gray-50 p-2 rounded-lg shadow-sm text-center text-sm w-full sm:w-[calc(50%-0.5rem)]">
                            ส่วนงานผลประโยชน์</div>
                        <div class="bg-gray-50 p-2 rounded-lg shadow-sm text-center text-sm w-full sm:w-[calc(50%-0.5rem)]">
                            ส่วนงานบุคคล</div>
                        <div class="bg-gray-50 p-2 rounded-lg shadow-sm text-center text-sm w-full sm:w-[calc(50%-0.5rem)]">
                            ส่วนงานอบรมและพัฒนา</div>
                        <div class="bg-gray-50 p-2 rounded-lg shadow-sm text-center text-sm w-full sm:w-[calc(50%-0.5rem)]">
                            ส่วนงานระเบียบและข้อบังคับ</div>
                    </div>
                </div>

                {{-- รองผู้จัดการใหญ่ สายงานสาขาและธุรกิจ (Branches & Business) --}}
                <div
                    class="flex flex-col items-center w-full md:w-1/3 p-4 bg-cyan-100 rounded-lg shadow-md border border-cyan-300 text-center">
                    <h3 class="text-lg font-bold text-cyan-800">รองผู้จัดการใหญ่ สายงานสาขาและธุรกิจ</h3>
                    <p class="text-cyan-600 text-sm">Deputy General Manager, Branches & Business</p>
                    {{-- Connector to departments --}}
                    <div class="w-1 h-8 bg-gray-300 mt-4"></div>
                    <div class="flex flex-wrap justify-center gap-2 mt-2 w-full">
                        <div class="bg-gray-50 p-2 rounded-lg shadow-sm text-center text-sm w-full sm:w-[calc(50%-0.5rem)]">
                            ส่วนงานบริหารสาขาและธุรกิจ</div>
                        <div class="bg-gray-50 p-2 rounded-lg shadow-sm text-center text-sm w-full sm:w-[calc(50%-0.5rem)]">
                            ส่วนงานธุรกิจ</div>
                        <div class="bg-gray-50 p-2 rounded-lg shadow-sm text-center text-sm w-full sm:w-[calc(50%-0.5rem)]">
                            ส่วนงานการตลาด</div>
                        <div class="bg-gray-50 p-2 rounded-lg shadow-sm text-center text-sm w-full sm:w-[calc(50%-0.5rem)]">
                            ส่วนงานประกันภัย</div>
                        <div class="bg-gray-50 p-2 rounded-lg shadow-sm text-center text-sm w-full sm:w-[calc(50%-0.5rem)]">
                            ส่วนงานเทคโนโลยีสารสนเทศ</div>
                        <div class="bg-gray-50 p-2 rounded-lg shadow-sm text-center text-sm w-full sm:w-[calc(50%-0.5rem)]">
                            ส่วนงานอบรมและสวัสดิการสมาชิก</div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection