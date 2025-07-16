@extends('layouts.admin-layout')

@section('title', 'ค้นหาข้อมูลสมาชิก')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-6">ค้นหาข้อมูลสมาชิก</h1>
        <form action="/searchMember" method="GET">
            <div class="bg-white p-6 rounded-xl shadow-lg mb-8">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="lg:col-span-2">
                        <label for="idCardNumber" class="block text-sm font-medium text-gray-700">เลขบัตรประชาชน</label>
                        <div class="mt-1 relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-id-card text-gray-400"></i>
                            </div>
                            <input type="text" id="idCardNumber" name="idCardNumber"
                                value="{{ request('idCardNumber') }}"
                                class="block w-full pl-10 py-2 border border-gray-300 rounded-md focus:ring-green-500 focus:border-green-500"
                                placeholder="กรอกเลข 13 หลัก" maxlength="13" pattern="\d*">
                        </div>
                    </div>

                    <!-- Member Number -->
                    <div class="lg:col-span-2">
                        <label for="memberNumber" class="block text-sm font-medium text-gray-700">เลขสมาชิก</label>
                        <div class="mt-1 relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-hashtag text-gray-400"></i>
                            </div>
                            <input type="text" id="memberNumber" name="memberNumber"
                                value="{{ request('memberNumber') }}"
                                class="block w-full pl-10 py-2 border border-gray-300 rounded-md focus:ring-green-500 focus:border-green-500"
                                placeholder="เช่น 10025">
                        </div>
                    </div>

                    <!-- First Name -->
                    <div>
                        <label for="firstName" class="block text-sm font-medium text-gray-700">ชื่อ</label>
                        <input type="text" id="firstName" name="firstName" value="{{ request('firstName') }}"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md focus:ring-green-500 focus:border-green-500"
                            placeholder="สมชาย">
                    </div>

                    <!-- Last Name -->
                    <div>
                        <label for="lastName" class="block text-sm font-medium text-gray-700">นามสกุล</label>
                        <input type="text" id="lastName" name="lastName" value="{{ request('lastName') }}"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md focus:ring-green-500 focus:border-green-500"
                            placeholder="ใจดี">
                    </div>

                    <!-- Branch -->
                    <div class="lg:col-span-2">
                        <label for="branch" class="block text-sm font-medium text-gray-700">สาขา</label>
                        <select id="branch" name="branch"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
                            <option value="000" @if (request('branch') == '000') selected @endif>สาขาสำนักงานใหญ่
                            </option>
                            <option value="001" @if (request('branch') == '001') selected @endif>สาขากระบี่</option>
                            <option value="002" @if (request('branch') == '002') selected @endif>สาขาคลองยาง</option>
                            <option value="003" @if (request('branch') == '003') selected @endif>สาขาอ่าวลึก</option>
                            <option value="004" @if (request('branch') == '004') selected @endif>สาขากาญจนดิษฐ์</option>
                            <option value="005" @if (request('branch') == '005') selected @endif>สาขาคลองท่อม</option>
                            <option value="006" @if (request('branch') == '006') selected @endif>สาขาอ่าวนาง</option>
                            <option value="007" @if (request('branch') == '007') selected @endif>สาขาห้วยลึก</option>
                            <option value="008" @if (request('branch') == '008') selected @endif>สาขาเกาะลันตา</option>
                            <option value="009" @if (request('branch') == '009') selected @endif>สาขาเหนือคลอง</option>
                        </select>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="mt-6 pt-6 border-t border-gray-200 flex items-center justify-end gap-4">
                    <a href="{{ url('/searchMember') }}"
                        class="bg-gray-200 text-gray-700 font-bold py-2 px-4 rounded-lg hover:bg-gray-300 transition duration-300">
                        <i class="fas fa-eraser mr-2"></i>
                        ล้างข้อมูล
                    </a>
                    <button type="submit"
                        class="bg-green-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-green-700 transition duration-300">
                        <i class="fas fa-search mr-2"></i>
                        ค้นหา
                    </button>
                </div>
            </div>
        </form>

        <!-- Search Results Section -->
        <div class="bg-white rounded-lg shadow-lg">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-800">ผลการค้นหา</h3>
                @if (isset($data))
                    <span class="text-sm text-gray-500">พบ {{ $data->total() }} รายการ</span>
                @endif
            </div>
            <div class="overflow-x-auto">
                <table id="DataTable" class="w-full text-sm">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 text-center">
                        <tr>
                            <th scope="col" class="px-6 py-3">เลขที่สมาชิก</th>
                            <th scope="col" class="px-6 py-3">ชื่อ</th>
                            <th scope="col" class="px-6 py-3">นามสกุล</th>
                            <th scope="col" class="px-6 py-3">สาขา</th>
                            <th scope="col" class="px-6 py-3">ดูข้อมูล</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @if (isset($data) && $data->count() > 0)
                            @foreach ($data as $item)
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    {{-- จัดกึ่งกลางสำหรับเซลล์ข้อความ --}}
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap text-center">
                                        {{ $item->MEM_ID }}
                                    </td>
                                    <td class="px-6 py-4 text-center">{{ $item->FNAME }}</td>
                                    <td class="px-6 py-4 text-center">{{ $item->LNAME }}</td>
                                    <td class="px-6 py-4 text-center">{{ $item->BR_NAME }}</td>

                                    {{-- จัดกึ่งกลางสำหรับเซลล์ที่มีปุ่ม --}}
                                    <td class="px-6 py-4 flex justify-center">
                                        <a href="{{ url('/data_member?mem_id=' . $item->MEM_ID . '&br_no=' . $item->BR_NO) }}"
                                            class="bg-blue-500 text-white hover:bg-blue-600 w-8 h-8 rounded-md flex items-center justify-center transition-colors duration-200">
                                            <i class="fas fa-file-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="text-center py-10 text-gray-500">
                                    <i class="fas fa-inbox fa-3x text-gray-400 mb-4"></i>
                                    <p class="font-semibold">ไม่พบข้อมูล</p>
                                    <p class="text-xs mt-1">กรุณากรอกเงื่อนไขเพื่อเริ่มต้นการค้นหา</p>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            @if (isset($data) && $data->hasPages())
                <div class="p-4 bg-white border-t border-gray-200">                   
                    {{ $data->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
