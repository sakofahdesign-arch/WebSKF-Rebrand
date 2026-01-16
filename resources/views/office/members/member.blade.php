@extends('layouts.admin-layout')

@section('title', 'ค้นหาข้อมูลสมาชิก')
@section('header')
    <h2 class="text-2xl font-semibold text-gray-800">
        <i class="fas fa-users text-emerald-600 mr-2"></i> ค้นหาข้อมูลสมาชิก
    </h2>
@endsection

@section('content')
<div class="container mx-auto px-4 max-w-6xl">
    
    <div class="bg-white rounded-xl shadow-md border border-gray-100 mb-8 overflow-hidden">
        <div class="border-b border-gray-100 bg-gray-50 px-6 py-4">
            <h3 class="text-lg font-medium text-gray-700">ระบุเงื่อนไขการค้นหา</h3>
        </div>
        
        <form action="/searchMember" method="GET" class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                
                <div class="lg:col-span-2">
                    <label for="idCardNumber" class="block text-sm font-medium text-gray-700 mb-1">เลขบัตรประชาชน</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-id-card text-gray-400"></i>
                        </div>
                        <input type="text" id="idCardNumber" name="idCardNumber"
                            value="{{ request('idCardNumber') }}"
                            class="block w-full pl-10 py-2.5 bg-gray-50 border border-gray-300 rounded-lg focus:ring-emerald-500 focus:border-emerald-500 text-sm transition-colors"
                            placeholder="กรอกเลข 13 หลัก" maxlength="13" pattern="\d*">
                    </div>
                </div>

                <div class="lg:col-span-2">
                    <label for="memberNumber" class="block text-sm font-medium text-gray-700 mb-1">เลขสมาชิก</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-hashtag text-gray-400"></i>
                        </div>
                        <input type="text" id="memberNumber" name="memberNumber"
                            value="{{ request('memberNumber') }}"
                            class="block w-full pl-10 py-2.5 bg-gray-50 border border-gray-300 rounded-lg focus:ring-emerald-500 focus:border-emerald-500 text-sm transition-colors"
                            placeholder="เช่น 10025">
                    </div>
                </div>

                <div>
                    <label for="firstName" class="block text-sm font-medium text-gray-700 mb-1">ชื่อ</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-user text-gray-400"></i>
                        </div>
                        <input type="text" id="firstName" name="firstName" value="{{ request('firstName') }}"
                            class="block w-full pl-10 py-2.5 bg-gray-50 border border-gray-300 rounded-lg focus:ring-emerald-500 focus:border-emerald-500 text-sm transition-colors"
                            placeholder="ไม่ต้องระบุคำนำหน้า">
                    </div>
                </div>

                <div>
                    <label for="lastName" class="block text-sm font-medium text-gray-700 mb-1">นามสกุล</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-user text-gray-400"></i>
                        </div>
                        <input type="text" id="lastName" name="lastName" value="{{ request('lastName') }}"
                            class="block w-full pl-10 py-2.5 bg-gray-50 border border-gray-300 rounded-lg focus:ring-emerald-500 focus:border-emerald-500 text-sm transition-colors"
                            placeholder="ไม่ต้องระบุคำนำหน้า">
                    </div>
                </div>

                <div class="lg:col-span-2">
                    <label for="branch" class="block text-sm font-medium text-gray-700 mb-1">สังกัดสาขา</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-building text-gray-400"></i>
                        </div>
                        <select id="branch" name="branch"
                            class="block w-full pl-10 py-2.5 bg-gray-50 border border-gray-300 rounded-lg focus:ring-emerald-500 focus:border-emerald-500 text-sm transition-colors appearance-none">
                            <option value="000" @if (request('branch') == '000') selected @endif>สาขาสำนักงานใหญ่</option>
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
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <i class="fas fa-chevron-down text-gray-400 text-xs"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8 flex items-center justify-end gap-3 border-t border-gray-100 pt-5">
                <a href="{{ url('/searchMember') }}"
                    class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-colors shadow-sm">
                    <i class="fas fa-eraser mr-2 text-gray-400"></i>
                    ล้างค่า
                </a>
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-emerald-600 border border-transparent rounded-lg font-medium text-white hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-colors shadow-sm">
                    <i class="fas fa-search mr-2"></i>
                    ค้นหาข้อมูล
                </button>
            </div>
        </form>
    </div>

    <div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50">
            <h3 class="text-lg font-medium text-gray-700 flex items-center gap-2">
                <i class="fas fa-list text-emerald-500"></i> ผลการค้นหา
            </h3>
            @if (isset($data))
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                    พบ {{ $data->total() }} รายการ
                </span>
            @endif
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="text-xs text-gray-500 uppercase bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th scope="col" class="px-6 py-3 font-semibold text-center w-32">เลขสมาชิก</th>
                        <th scope="col" class="px-6 py-3 font-semibold">ชื่อ-นามสกุล</th>
                        <th scope="col" class="px-6 py-3 font-semibold text-center">สาขา</th>
                        <th scope="col" class="px-6 py-3 font-semibold text-center w-24">จัดการ</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @if (isset($data) && $data->count() > 0)
                        @foreach ($data as $item)
                            <tr class="bg-white hover:bg-gray-50 transition-colors group">
                                <td class="px-6 py-4 text-center font-medium text-emerald-600">
                                    {{ $item->MEM_ID }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div>
                                            <div class="font-medium text-gray-900">{{ $item->FNAME }} {{ $item->LNAME }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800">
                                        {{ $item->BR_NAME }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <a href="{{ url('/data_member?mem_id=' . $item->MEM_ID . '&br_no=' . $item->BR_NO) }}"
                                       class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-white border border-gray-200 text-gray-500 hover:text-emerald-600 hover:border-emerald-500 hover:bg-emerald-50 transition-all shadow-sm"
                                       title="ดูรายละเอียด">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4 text-gray-400">
                                        <i class="fas fa-search text-2xl"></i>
                                    </div>
                                    <h3 class="text-gray-900 font-medium mb-1">ไม่พบข้อมูลสมาชิก</h3>
                                    <p class="text-gray-500 text-sm">กรุณาลองค้นหาด้วยเงื่อนไขอื่น หรือระบุข้อมูลให้ครบถ้วน</p>
                                </div>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        @if (isset($data) && $data->hasPages())
            <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
                {{ $data->appends(request()->query())->links() }}
            </div>
        @endif
    </div>
</div>
@endsection