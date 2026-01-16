@extends('layouts.admin-layout')

@section('title', 'อัพโหลดไฟล์สินเชื่อ')

@section('header')
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                <i class="fas fa-cloud-upload-alt text-emerald-600"></i> อัพโหลดไฟล์สินเชื่อ
            </h2>
            <nav class="flex text-sm text-gray-500 mt-1" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2">
                    <li class="inline-flex items-center">
                        <a href="#" class="hover:text-emerald-600">งานสินเชื่อ</a>
                    </li>
                    <li><i class="fas fa-chevron-right text-xs"></i></li>
                    <li class="text-gray-400" aria-current="page">นำเข้าข้อมูล</li>
                </ol>
            </nav>
        </div>
    </div>
@endsection

@section('content')
    <div class="container mx-auto max-w-4xl">

        <div class="card bg-white shadow-lg border border-gray-100 overflow-hidden">
            <div class="h-2 bg-gradient-to-r from-emerald-500 to-teal-400"></div>

            <div class="p-8 md:p-10">
                <div class="text-center mb-8">
                    <div class="w-16 h-16 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl shadow-sm">
                        <i class="fas fa-file-contract"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800">แบบฟอร์มนำเข้าข้อมูลสัญญา</h3>
                    <p class="text-gray-500 mt-1">กรุณากรอกข้อมูลให้ครบถ้วนและแนบไฟล์สัญญา (PDF/DOC)</p>
                </div>

                <form action="{{ route('postcredit') }}" method="post" enctype="multipart/form-data" novalidate class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div class="form-control w-full">
                            <label for="memberID" class="label">
                                <span class="label-text font-bold text-gray-700">เลขที่สมาชิก <span class="text-red-500">*</span></span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-id-card text-gray-400"></i>
                                </div>
                                <input type="text" id="memberID" name="memberID" maxlength="5" value="{{ old('memberID') }}"
                                    class="input input-bordered w-full pl-10 focus:input-emerald-500 bg-gray-50 focus:bg-white transition-colors @error('memberID') input-error @enderror"
                                    placeholder="เช่น 12345" required>
                            </div>
                            @error('memberID')
                                <label class="label"><span class="label-text-alt text-red-500">{{ $message }}</span></label>
                            @enderror
                        </div>

                        <div class="form-control w-full">
                            <label for="contractNumber" class="label">
                                <span class="label-text font-bold text-gray-700">เลขที่สัญญา <span class="text-red-500">*</span></span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-file-signature text-gray-400"></i>
                                </div>
                                <input type="text" id="contractNumber" name="contractNumber" value="{{ old('contractNumber') }}"
                                    class="input input-bordered w-full pl-10 focus:input-emerald-500 bg-gray-50 focus:bg-white transition-colors @error('contractNumber') input-error @enderror"
                                    placeholder="ตัวอย่าง ฉ.0000001/2566" required>
                            </div>
                            @error('contractNumber')
                                <label class="label"><span class="label-text-alt text-red-500">{{ $message }}</span></label>
                            @enderror
                        </div>

                        <div class="form-control w-full">
                            <label for="firstName" class="label">
                                <span class="label-text font-bold text-gray-700">ชื่อ <span class="text-red-500">*</span></span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-user text-gray-400"></i>
                                </div>
                                <input type="text" id="firstName" name="firstName" value="{{ old('firstName') }}"
                                    class="input input-bordered w-full pl-10 focus:input-emerald-500 bg-gray-50 focus:bg-white transition-colors @error('firstName') input-error @enderror"
                                    placeholder="ระบุชื่อจริง" required>
                            </div>
                            @error('firstName')
                                <label class="label"><span class="label-text-alt text-red-500">{{ $message }}</span></label>
                            @enderror
                        </div>

                        <div class="form-control w-full">
                            <label for="lastName" class="label">
                                <span class="label-text font-bold text-gray-700">นามสกุล <span class="text-red-500">*</span></span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-user-tag text-gray-400"></i>
                                </div>
                                <input type="text" id="lastName" name="lastName" value="{{ old('lastName') }}"
                                    class="input input-bordered w-full pl-10 focus:input-emerald-500 bg-gray-50 focus:bg-white transition-colors @error('lastName') input-error @enderror"
                                    placeholder="ระบุนามสกุล" required>
                            </div>
                            @error('lastName')
                                <label class="label"><span class="label-text-alt text-red-500">{{ $message }}</span></label>
                            @enderror
                        </div>

                        <div class="form-control w-full">
                            <label for="contractYear" class="label">
                                <span class="label-text font-bold text-gray-700">ปีสัญญา <span class="text-red-500">*</span></span>
                            </label>
                            <select id="contractYear" name="contractYear" class="select select-bordered w-full focus:select-emerald-500 bg-gray-50 focus:bg-white @error('contractYear') select-error @enderror" required>
                                <option value="" disabled {{ old('contractYear') ? '' : 'selected' }}>เลือกปี</option>
                                @foreach(['2565', '2566', '2567', '2568', '2569', '2570'] as $year)
                                    <option value="{{ $year }}" {{ old('contractYear') == $year ? 'selected' : '' }}>{{ $year }}</option>
                                @endforeach
                            </select>
                            @error('contractYear')
                                <label class="label"><span class="label-text-alt text-red-500">{{ $message }}</span></label>
                            @enderror
                        </div>

                        <div class="form-control w-full">
                            <label for="branch" class="label">
                                <span class="label-text font-bold text-gray-700">สาขา <span class="text-red-500">*</span></span>
                            </label>
                            <select id="branch" name="branch" class="select select-bordered w-full focus:select-emerald-500 bg-gray-50 focus:bg-white @error('branch') select-error @enderror" required>
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
                                <label class="label"><span class="label-text-alt text-red-500">{{ $message }}</span></label>
                            @enderror
                        </div>

                        <div class="form-control w-full md:col-span-2">
                            <label for="contractType" class="label">
                                <span class="label-text font-bold text-gray-700">ประเภทสัญญา <span class="text-red-500">*</span></span>
                            </label>
                            <select id="contractType" name="contractType" class="select select-bordered w-full focus:select-emerald-500 bg-gray-50 focus:bg-white @error('contractType') select-error @enderror" required>
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
                                <label class="label"><span class="label-text-alt text-red-500">{{ $message }}</span></label>
                            @enderror
                        </div>

                        <div class="form-control w-full md:col-span-2" x-data="{ fileName: null, isDragging: false }">
                            <label class="label">
                                <span class="label-text font-bold text-gray-700">ไฟล์เอกสาร (PDF, DOC) <span class="text-red-500">*</span></span>
                            </label>

                            <div class="relative group">
                                <label for="fileUpload" 
                                    class="flex flex-col items-center justify-center w-full h-40 border-2 border-dashed rounded-xl cursor-pointer transition-all duration-300 bg-gray-50 hover:bg-emerald-50/50"
                                    :class="isDragging ? 'border-emerald-500 bg-emerald-50' : 'border-gray-300 group-hover:border-emerald-400'"
                                    @dragover.prevent="isDragging = true"
                                    @dragleave.prevent="isDragging = false"
                                    @drop.prevent="isDragging = false; fileName = $event.dataTransfer.files[0].name; $refs.fileInput.files = $event.dataTransfer.files">
                                    
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6 text-center px-4">
                                        <div x-show="!fileName">
                                            <i class="fas fa-cloud-upload-alt text-3xl mb-3 text-gray-400 group-hover:text-emerald-500 transition-colors"></i>
                                            <p class="mb-1 text-sm text-gray-500"><span class="font-semibold text-emerald-600">คลิกเพื่อเลือกไฟล์</span> หรือลากไฟล์มาวาง</p>
                                        </div>

                                        <div x-show="fileName" style="display: none;" class="text-emerald-600">
                                            <i class="fas fa-check-circle text-3xl mb-2"></i>
                                            <p class="text-sm font-medium text-gray-900" x-text="fileName"></p>
                                        </div>
                                    </div>

                                    <input id="fileUpload" x-ref="fileInput" name="file" type="file" class="hidden" 
                                        accept=".pdf,.doc,.docx"
                                        @change="fileName = $event.target.files[0] ? $event.target.files[0].name : null"
                                        required />
                                </label>
                            </div>
                            @error('file')
                                <label class="label"><span class="label-text-alt text-red-500">{{ $message }}</span></label>
                            @enderror
                        </div>

                    </div>

                    <div class="flex items-center justify-end gap-3 pt-6 border-t border-gray-100 mt-6">
                        <button type="reset" class="btn btn-ghost text-gray-500 hover:bg-gray-100">
                            <i class="fas fa-times"></i> ยกเลิก
                        </button>
                        <button type="submit" class="btn bg-emerald-600 hover:bg-emerald-700 text-white border-none shadow-md gap-2 px-6">
                            <i class="fas fa-save"></i> บันทึกข้อมูล
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
