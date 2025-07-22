@extends('layouts.admin-layout')

@section('title', 'อัพโหลดไฟล์สินเชื่อ')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-6">อัพโหลดไฟล์สินเชื่อ</h1>

        <!-- Upload Form Card -->
        <div class="bg-white p-6 rounded-xl shadow-lg">
            <form action="/postcredit" method="post" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- Member ID -->
                    <div>
                        <label for="memberID" class="block text-sm font-medium text-gray-700">เลขที่สมาชิก <span
                                class="text-red-500">*</span></label>
                        <input type="text" id="memberID" name="memberID"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md focus:ring-green-500 focus:border-green-500"
                            placeholder="เลขที่สมาชิก" required>
                    </div>

                    <!-- Contract Number -->
                    <div>
                        <label for="contractNumber" class="block text-sm font-medium text-gray-700">เลขที่สัญญา <span
                                class="text-red-500">*</span></label>
                        <input type="text" id="contractNumber" name="contractNumber"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md focus:ring-green-500 focus:border-green-500"
                            placeholder="ตัวอย่าง ฉ.0000001/2566" required>
                    </div>

                    <!-- First Name -->
                    <div>
                        <label for="firstName" class="block text-sm font-medium text-gray-700">ชื่อ <span
                                class="text-red-500">*</span></label>
                        <input type="text" id="firstName" name="firstName"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md focus:ring-green-500 focus:border-green-500"
                            placeholder="ชื่อจริง" required>
                    </div>

                    <!-- Last Name -->
                    <div>
                        <label for="lastName" class="block text-sm font-medium text-gray-700">นามสกุล <span
                                class="text-red-500">*</span></label>
                        <input type="text" id="lastName" name="lastName"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md focus:ring-green-500 focus:border-green-500"
                            placeholder="นามสกุล" required>
                    </div>

                    <!-- Contract Year -->
                    <div>
                        <label for="contractYear" class="block text-sm font-medium text-gray-700">ปีสัญญา <span
                                class="text-red-500">*</span></label>
                        <select id="contractYear" name="contractYear"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500"
                            required>
                            <option value="" disabled selected>เลือกปี</option>
                            @for ($i = date('Y') + 543; $i >= 2565; $i--)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>

                    <!-- Branch -->
                    <div>
                        <label for="branch" class="block text-sm font-medium text-gray-700">สาขา <span
                                class="text-red-500">*</span></label>
                        <select id="branch" name="branch"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500"
                            required>
                            <option value="" disabled selected>เลือกสาขา</option>
                            <option value="000">สำนักงานใหญ่</option>
                            <option value="001">กระบี่</option>
                            <option value="002">คลองยาง</option>
                            <option value="003">อ่าวลึก</option>
                            <option value="004">กาญจนดิษฐ์</option>
                            <option value="005">คลองท่อม</option>
                            <option value="006">อ่าวนาง</option>
                            <option value="007">ห้วยลึก</option>
                            <option value="008">เกาะลันตา</option>
                            <option value="009">สาขาเหนือคลอง</option>
                        </select>
                    </div>

                    <!-- Contract Type -->
                    <div class="md:col-span-2">
                        <label for="contractType" class="block text-sm font-medium text-gray-700">ประเภทสัญญา <span
                                class="text-red-500">*</span></label>
                        <select id="contractType" name="contractType"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500"
                            required>
                            <option value="" disabled selected>เลือกประเภทสัญญา</option>
                            <option value="1">ฉุกเฉิน</option>
                            <option value="2">สามัญฉุกเฉิน</option>
                            <option value="3">สามัญ</option>
                            <option value="4">พิเศษ</option>
                            <option value="5">พิเศษโครงการ</option>
                            <option value="6">โครงการสินทรัพย์</option>
                            <option value="7">สวัสดิการเจ้าหน้าที่</option>
                        </select>
                    </div>

                    <!-- File Upload -->
                    <div class="md:col-span-2">
                        <label for="fileUpload" class="block text-sm font-medium text-gray-700">เลือกไฟล์ (PDF, DOC, DOCX)
                            <span class="text-red-500">*</span></label>
                        {{-- EDITED: Updated 'accept' attribute to match server-side validation --}}
                        <input id="fileUpload" name="file" type="file"
                            class="mt-1 block w-full text-sm text-gray-500
                        file:mr-4 file:py-2 file:px-4
                        file:rounded-full file:border-0
                        file:text-sm file:font-semibold
                        file:bg-green-50 file:text-green-700
                        hover:file:bg-green-100"
                            required accept=".pdf,.doc,.docx">
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="mt-6 pt-6 border-t border-gray-200 flex items-center justify-end gap-4">
                    <button type="reset"
                        class="bg-gray-200 text-gray-700 font-bold py-2 px-4 rounded-lg hover:bg-gray-300 transition duration-300">
                        <i class="fas fa-times mr-2"></i>
                        ยกเลิก
                    </button>
                    <button type="submit"
                        class="bg-green-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-green-700 transition duration-300">
                        <i class="fas fa-upload mr-2"></i>
                        อัพโหลด
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@include('components.sweetalert2')
