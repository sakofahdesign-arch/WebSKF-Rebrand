@extends('layouts.admin-layout')

@section('title', 'อัพโหลดไฟล์สินเชื่อ')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">อัพโหลดไฟล์สินเชื่อ</h1>
        <div class="bg-white p-8 rounded-xl shadow-lg max-w-4xl mx-auto">
            <form action="{{ route('postcredit') }}" method="post" enctype="multipart/form-data" novalidate>
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>
                        <label for="memberID" class="block text-sm font-medium text-gray-700">เลขที่สมาชิก <span
                                class="text-red-500">*</span></label>
                        <input type="text" id="memberID" name="memberID" maxlength="5" value="{{ old('memberID') }}"
                            class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-400
                                                            focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500" placeholder="เช่น 12345" required>
                        @error('memberID')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="contractNumber" class="block text-sm font-medium text-gray-700">เลขที่สัญญา <span
                                class="text-red-500">*</span></label>
                        <input type="text" id="contractNumber" name="contractNumber" value="{{ old('contractNumber') }}"
                            class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-400
                                                            focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
                            placeholder="ตัวอย่าง ฉ.0000001/2566" required>
                        @error('contractNumber')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="firstName" class="block text-sm font-medium text-gray-700">ชื่อ <span
                                class="text-red-500">*</span></label>
                        <input type="text" id="firstName" name="firstName" value="{{ old('firstName') }}"
                            class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-400
                                                            focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500" placeholder="ชื่อจริง" required>
                        @error('firstName')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="lastName" class="block text-sm font-medium text-gray-700">นามสกุล <span
                                class="text-red-500">*</span></label>
                        <input type="text" id="lastName" name="lastName" value="{{ old('lastName') }}"
                            class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-400
                                                            focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500" placeholder="นามสกุล" required>
                        @error('lastName')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="contractYear" class="block text-sm font-medium text-gray-700">
                            ปีสัญญา <span class="text-red-500">*</span>
                        </label>
                        <select id="contractYear" name="contractYear" required
                            class="mt-1 block w-full rounded-md border border-gray-300 bg-white px-3 py-2
                                               focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                            <option value="" disabled {{ old('contractYear') ? '' : 'selected' }}>เลือกปี</option>
                            <option value="2565" {{ old('contractYear') == '2565' ? 'selected' : '' }}>2565</option>
                            <option value="2566" {{ old('contractYear') == '2566' ? 'selected' : '' }}>2566</option>
                            <option value="2567" {{ old('contractYear') == '2567' ? 'selected' : '' }}>2567</option>
                            <option value="2568" {{ old('contractYear') == '2568' ? 'selected' : '' }}>2568</option>
                            <option value="2569" {{ old('contractYear') == '2569' ? 'selected' : '' }}>2569</option>
                            <option value="2570" {{ old('contractYear') == '2570' ? 'selected' : '' }}>2570</option>
                        </select>
                        @error('contractYear')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>


                    <div>
                        <label for="branch" class="block text-sm font-medium text-gray-700">สาขา <span
                                class="text-red-500">*</span></label>
                        <select id="branch" name="branch" required
                            class="mt-1 block w-full rounded-md border border-gray-300 bg-white px-3 py-2
                                                            focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                            <option value="" disabled {{ old('branch') ? '' : 'selected' }}>เลือกสาขา</option>
                            <option value="000" {{ old('branch') == '000' ? 'selected' : '' }}>สำนักงานใหญ่</option>
                            <option value="001" {{ old('branch') == '001' ? 'selected' : '' }}>กระบี่</option>
                            <option value="002" {{ old('branch') == '002' ? 'selected' : '' }}>คลองยาง</option>
                            <option value="003" {{ old('branch') == '003' ? 'selected' : '' }}>อ่าวลึก</option>
                            <option value="004" {{ old('branch') == '004' ? 'selected' : '' }}>กาญจนดิษฐ์</option>
                            <option value="005" {{ old('branch') == '005' ? 'selected' : '' }}>คลองท่อม</option>
                            <option value="006" {{ old('branch') == '006' ? 'selected' : '' }}>อ่าวนาง</option>
                            <option value="007" {{ old('branch') == '007' ? 'selected' : '' }}>ห้วยลึก</option>
                            <option value="008" {{ old('branch') == '008' ? 'selected' : '' }}>เกาะลันตา</option>
                            <option value="009" {{ old('branch') == '009' ? 'selected' : '' }}>สาขาเหนือคลอง</option>
                        </select>
                        @error('branch')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="contractType" class="block text-sm font-medium text-gray-700">ประเภทสัญญา <span
                                class="text-red-500">*</span></label>
                        <select id="contractType" name="contractType" required
                            class="mt-1 block w-full rounded-md border border-gray-300 bg-white px-3 py-2
                                                            focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                            <option value="" disabled {{ old('contractType') ? '' : 'selected' }}>เลือกประเภทสัญญา</option>
                            <option value="1" {{ old('contractType') == 1 ? 'selected' : '' }}>ฉุกเฉิน</option>
                            <option value="2" {{ old('contractType') == 2 ? 'selected' : '' }}>สามัญฉุกเฉิน</option>
                            <option value="3" {{ old('contractType') == 3 ? 'selected' : '' }}>สามัญ</option>
                            <option value="4" {{ old('contractType') == 4 ? 'selected' : '' }}>พิเศษ</option>
                            <option value="5" {{ old('contractType') == 5 ? 'selected' : '' }}>พิเศษโครงการ</option>
                            <option value="6" {{ old('contractType') == 6 ? 'selected' : '' }}>โครงการสินทรัพย์</option>
                            <option value="7" {{ old('contractType') == 7 ? 'selected' : '' }}>สวัสดิการเจ้าหน้าที่</option>
                        </select>
                        @error('contractType')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="fileUpload" class="block text-sm font-medium text-gray-700">
                            เลือกไฟล์ (PDF, DOC, DOCX) <span class="text-red-500">*</span>
                        </label>
                        <div class="mt-1">
                            <input id="fileUpload" name="file" type="file" accept=".pdf,.doc,.docx" required class="block w-full text-sm text-gray-700
                           file:mr-3 file:py-1.5 file:px-3
                           file:rounded file:border file:border-gray-300
                           file:text-sm file:font-medium
                           file:bg-green-100 file:text-green-800
                           hover:file:bg-green-200
                           focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500
                           cursor-pointer
                    " />

                        </div>
                        @error('file')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                <div class="mt-8 flex justify-end gap-4 border-t border-gray-200 pt-6">
                    <button type="reset"
                        class="flex items-center gap-2 rounded-lg bg-gray-200 px-5 py-2 font-semibold text-gray-700 hover:bg-gray-300 transition duration-300">
                        <i class="fas fa-times"></i> ยกเลิก
                    </button>
                    <button type="submit"
                        class="flex items-center gap-2 rounded-lg bg-green-600 px-5 py-2 font-semibold text-white hover:bg-green-700 transition duration-300">
                        <i class="fas fa-upload"></i> อัพโหลด
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

