<div class="card bg-white shadow-lg border border-gray-100 overflow-hidden">
    <div class="h-2 bg-gradient-to-r from-emerald-500 to-teal-400"></div>
    
    <div class="card-body p-6 md:p-8">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6 pb-4 border-b border-gray-100">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-emerald-100 flex items-center justify-center text-emerald-600 shadow-sm">
                    <i class="fas fa-piggy-bank text-lg"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800">บัญชีเงินฝาก</h3>
            </div>
            @if(isset($deposit_member) && count($deposit_member) > 0)
                <div class="badge badge-lg badge-ghost gap-2">
                    <i class="fas fa-list-ul"></i>
                    {{ count($deposit_member) }} บัญชี
                </div>
            @endif
        </div>

        <div class="overflow-x-auto rounded-lg border border-gray-100">
            <table class="stockTable w-full">
                <thead class="bg-gray-50 text-gray-500 font-medium">
                    <tr>
                        <th class="py-3 px-4 text-left">ชื่อบัญชี / เลขบัญชี</th>
                        <th class="py-3 px-4 text-right">ยอดคงเหลือ (บาท)</th>
                        <th class="py-3 px-4 text-center">จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($deposit_member as $item)
                        <tr class="hover:bg-emerald-50/50 transition-colors border-b border-gray-100 last:border-none">
                            <td class="py-3 px-4">
                                <div class="flex items-center gap-3">
                                    <div class="avatar placeholder">
                                        <div class="bg-emerald-100 text-emerald-600 rounded-full w-8 h-8">
                                            <span class="text-xs"><i class="fas fa-wallet"></i></span>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="font-bold text-gray-800">{{ $item->ACCOUNT_NAME }}</div>
                                        <div class="text-xs text-gray-500 font-mono bg-gray-100 px-2 py-0.5 rounded inline-block">
                                            {{ $item->ACCOUNT_NO }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3 px-4 text-right">
                                <div class="text-base font-bold text-emerald-600">
                                    {{ number_format($item->BALANCE, 2) }}
                                </div>
                            </td>
                            <td class="py-3 px-4 text-center">
                                <form action="/account_details" method="POST">
                                    @csrf
                                    <input type="hidden" name="account_number" value="{{ $item->ACCOUNT_NO }}">
                                    <button type="submit" class="btn btn-sm btn-ghost text-emerald-600 hover:bg-emerald-100 hover:text-emerald-700">
                                        <i class="fas fa-search mr-1"></i> รายละเอียด
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="py-8 text-center text-gray-400">
                                <div class="flex flex-col items-center justify-center">
                                    <i class="fas fa-folder-open text-4xl mb-2 opacity-50"></i>
                                    <p>ไม่พบข้อมูลบัญชีเงินฝาก</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>