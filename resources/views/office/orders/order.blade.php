@extends('layouts.admin-layout')

@section('title', 'ระเบียบสหกรณ์')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-6">ระเบียบสหกรณ์</h1>

    <div class="bg-white p-6 rounded-xl shadow-lg">
        <h3 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-4">
            <i class="fas fa-scroll mr-2 text-gray-500"></i>
            ระเบียบสหกรณ์ปี 2565
        </h3>
        <div class="space-y-3">
            
            <!-- Regulation Item -->
            <a href="{{ url('file/order/ว่าด้วยกองทุนให้ยืมเพื่อการศึกษา.pdf') }}" target="_blank" class="block p-4 border rounded-lg hover:bg-gray-50 hover:border-green-500 transition duration-200">
                <div class="flex justify-between items-center">
                    <div class="flex items-center">
                        <i class="fas fa-file-pdf text-red-500 text-xl mr-4"></i>
                        <p class="font-medium text-gray-700">ว่าด้วยกองทุนให้ยืมเพื่อการศึกษา</p>
                    </div>
                    <i class="fas fa-download text-gray-400"></i>
                </div>
            </a>

            <!-- Regulation Item -->
            <a href="{{ url('file/order/ว่าด้วยการจ่ายและเก็บรักษาเงินสด.pdf') }}" target="_blank" class="block p-4 border rounded-lg hover:bg-gray-50 hover:border-green-500 transition duration-200">
                <div class="flex justify-between items-center">
                    <div class="flex items-center">
                        <i class="fas fa-file-pdf text-red-500 text-xl mr-4"></i>
                        <p class="font-medium text-gray-700">ว่าด้วยการจ่ายและเก็บรักษาเงินสด</p>
                    </div>
                    <i class="fas fa-download text-gray-400"></i>
                </div>
            </a>

            <!-- Regulation Item -->
            <a href="{{ url('file/order/ว่าด้วยการใช้ทุนสาธารณประโยชน์.pdf') }}" target="_blank" class="block p-4 border rounded-lg hover:bg-gray-50 hover:border-green-500 transition duration-200">
                <div class="flex justify-between items-center">
                    <div class="flex items-center">
                        <i class="fas fa-file-pdf text-red-500 text-xl mr-4"></i>
                        <p class="font-medium text-gray-700">ว่าด้วยการใช้ทุนสาธารณประโยชน์</p>
                    </div>
                    <i class="fas fa-download text-gray-400"></i>
                </div>
            </a>

            <!-- Regulation Item -->
            <a href="{{ url('file/order/ว่าด้วยการให้เงินกู้ยืมเพื่อศึกษาต่อสำหรับเจ้าหน้าที่สหกรณ์.pdf') }}" target="_blank" class="block p-4 border rounded-lg hover:bg-gray-50 hover:border-green-500 transition duration-200">
                <div class="flex justify-between items-center">
                    <div class="flex items-center">
                        <i class="fas fa-file-pdf text-red-500 text-xl mr-4"></i>
                        <p class="font-medium text-gray-700">ว่าด้วยการให้เงินกู้ยืมเพื่อศึกษาต่อสำหรับเจ้าหน้าที่สหกรณ์</p>
                    </div>
                    <i class="fas fa-download text-gray-400"></i>
                </div>
            </a>

            <!-- Regulation Item -->
            <a href="{{ url('file/order/ว่าด้วยคณะอนุกรรมการ.pdf') }}" target="_blank" class="block p-4 border rounded-lg hover:bg-gray-50 hover:border-green-500 transition duration-200">
                <div class="flex justify-between items-center">
                    <div class="flex items-center">
                        <i class="fas fa-file-pdf text-red-500 text-xl mr-4"></i>
                        <p class="font-medium text-gray-700">ว่าด้วยคณะอนุกรรมการ</p>
                    </div>
                    <i class="fas fa-download text-gray-400"></i>
                </div>
            </a>

            <!-- Regulation Item -->
            <a href="{{ url('file/order/ว่าด้วยค่าเบี้ยเลี้ยง-ค่าพาหนะ-ค่าเดินทาง.pdf') }}" target="_blank" class="block p-4 border rounded-lg hover:bg-gray-50 hover:border-green-500 transition duration-200">
                <div class="flex justify-between items-center">
                    <div class="flex items-center">
                        <i class="fas fa-file-pdf text-red-500 text-xl mr-4"></i>
                        <p class="font-medium text-gray-700">ว่าด้วยค่าเบี้ยเลี้ยง-ค่าพาหนะ-ค่าเดินทาง</p>
                    </div>
                    <i class="fas fa-download text-gray-400"></i>
                </div>
            </a>

            <!-- Regulation Item -->
            <a href="{{ url('file/order/ว่าด้วยเงินยืมทดลองจ่าย.pdf') }}" target="_blank" class="block p-4 border rounded-lg hover:bg-gray-50 hover:border-green-500 transition duration-200">
                <div class="flex justify-between items-center">
                    <div class="flex items-center">
                        <i class="fas fa-file-pdf text-red-500 text-xl mr-4"></i>
                        <p class="font-medium text-gray-700">ว่าด้วยเงินยืมทดลองจ่าย</p>
                    </div>
                    <i class="fas fa-download text-gray-400"></i>
                </div>
            </a>

            <!-- Regulation Item -->
            <a href="{{ url('file/order/ว่าด้วยเจ้าหน้าที่และข้อบังคับเกี่ยวกับการทำงาน.pdf') }}" target="_blank" class="block p-4 border rounded-lg hover:bg-gray-50 hover:border-green-500 transition duration-200">
                <div class="flex justify-between items-center">
                    <div class="flex items-center">
                        <i class="fas fa-file-pdf text-red-500 text-xl mr-4"></i>
                        <p class="font-medium text-gray-700">ว่าด้วยเจ้าหน้าที่และข้อบังคับเกี่ยวกับการทำงาน</p>
                    </div>
                    <i class="fas fa-download text-gray-400"></i>
                </div>
            </a>

            <!-- Regulation Item -->
            <a href="{{ url('file/order/ว่าด้วยเจ้าหน้าที่และลูกจ้างสหกรณ์.pdf') }}" target="_blank" class="block p-4 border rounded-lg hover:bg-gray-50 hover:border-green-500 transition duration-200">
                <div class="flex justify-between items-center">
                    <div class="flex items-center">
                        <i class="fas fa-file-pdf text-red-500 text-xl mr-4"></i>
                        <p class="font-medium text-gray-700">ว่าด้วยเจ้าหน้าที่และลูกจ้างสหกรณ์</p>
                    </div>
                    <i class="fas fa-download text-gray-400"></i>
                </div>
            </a>

            <!-- Regulation Item -->
            <a href="{{ url('file/order/ว่าด้วยใช้เงินทุนสะสมเพื่อการศึกษาอบรม.pdf') }}" target="_blank" class="block p-4 border rounded-lg hover:bg-gray-50 hover:border-green-500 transition duration-200">
                <div class="flex justify-between items-center">
                    <div class="flex items-center">
                        <i class="fas fa-file-pdf text-red-500 text-xl mr-4"></i>
                        <p class="font-medium text-gray-700">ว่าด้วยใช้เงินทุนสะสมเพื่อการศึกษาอบรม</p>
                    </div>
                    <i class="fas fa-download text-gray-400"></i>
                </div>
            </a>

            <!-- Regulation Item -->
            <a href="{{ url('file/order/ว่าด้วยที่ปรึกษาของสหกรณ์.pdf') }}" target="_blank" class="block p-4 border rounded-lg hover:bg-gray-50 hover:border-green-500 transition duration-200">
                <div class="flex justify-between items-center">
                    <div class="flex items-center">
                        <i class="fas fa-file-pdf text-red-500 text-xl mr-4"></i>
                        <p class="font-medium text-gray-700">ว่าด้วยที่ปรึกษาของสหกรณ์</p>
                    </div>
                    <i class="fas fa-download text-gray-400"></i>
                </div>
            </a>

            <!-- Regulation Item -->
            <a href="{{ url('file/order/ว่าด้วยสวัสดิการคณะกรรมการและเจ้าหน้าที่.pdf') }}" target="_blank" class="block p-4 border rounded-lg hover:bg-gray-50 hover:border-green-500 transition duration-200">
                <div class="flex justify-between items-center">
                    <div class="flex items-center">
                        <i class="fas fa-file-pdf text-red-500 text-xl mr-4"></i>
                        <p class="font-medium text-gray-700">ว่าด้วยสวัสดิการคณะกรรมการและเจ้าหน้าที่</p>
                    </div>
                    <i class="fas fa-download text-gray-400"></i>
                </div>
            </a>

            <!-- Regulation Item -->
            <a href="{{ url('file/order/ว่าด้วยอำนาจหน้าที่และความรับผิดชอบของเจ้าหน้าที่สหกรณ์.pdf') }}" target="_blank" class="block p-4 border rounded-lg hover:bg-gray-50 hover:border-green-500 transition duration-200">
                <div class="flex justify-between items-center">
                    <div class="flex items-center">
                        <i class="fas fa-file-pdf text-red-500 text-xl mr-4"></i>
                        <p class="font-medium text-gray-700">ว่าด้วยอำนาจหน้าที่และความรับผิดชอบของเจ้าหน้าที่สหกรณ์</p>
                    </div>
                    <i class="fas fa-download text-gray-400"></i>
                </div>
            </a>

        </div>
    </div>
</div>
@endsection
