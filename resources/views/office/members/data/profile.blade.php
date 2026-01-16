<div class="card bg-white shadow-lg border border-gray-100 overflow-hidden">
    <div class="h-2 bg-gradient-to-r from-emerald-500 to-teal-400"></div>
    
    <div class="card-body p-6 md:p-8">
        <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-100">
            <div class="w-10 h-10 rounded-lg bg-emerald-100 flex items-center justify-center text-emerald-600 shadow-sm">
                <i class="fas fa-user-circle text-lg"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-800">รายละเอียดข้อมูลส่วนตัว</h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            
            <div class="flex items-start gap-3 p-2 rounded-lg hover:bg-gray-50 transition-colors">
                <i class="fas fa-user text-emerald-500 mt-1 w-5 text-center"></i>
                <div>
                    <span class="text-xs font-semibold text-gray-400 uppercase tracking-wide">ชื่อ-นามสกุล</span>
                    <p class="text-gray-800 font-medium">{{ $data_member->FNAME . ' ' . $data_member->LNAME }}</p>
                </div>
            </div>

            <div class="flex items-start gap-3 p-2 rounded-lg hover:bg-gray-50 transition-colors">
                <i class="fas fa-id-card text-emerald-500 mt-1 w-5 text-center"></i>
                <div>
                    <span class="text-xs font-semibold text-gray-400 uppercase tracking-wide">เลขบัตรประชาชน</span>
                    <p class="text-gray-800 font-medium">{{ $data_member->ID_CARD }}</p>
                </div>
            </div>

            <div class="flex items-start gap-3 p-2 rounded-lg hover:bg-gray-50 transition-colors">
                <i class="fas fa-birthday-cake text-emerald-500 mt-1 w-5 text-center"></i>
                <div>
                    <span class="text-xs font-semibold text-gray-400 uppercase tracking-wide">วันเกิด</span>
                    <p class="text-gray-800 font-medium">
                        {{ $data_member->DMY_BIRTH ? thaidate('j F Y', $data_member->DMY_BIRTH) : '-' }}
                    </p>
                </div>
            </div>

            <div class="flex items-start gap-3 p-2 rounded-lg hover:bg-gray-50 transition-colors">
                <i class="fas fa-venus-mars text-emerald-500 mt-1 w-5 text-center"></i>
                <div>
                    <span class="text-xs font-semibold text-gray-400 uppercase tracking-wide">เพศ</span>
                    <p class="text-gray-800 font-medium">
                        {{ $data_member->SEX == '1' ? 'ชาย' : 'หญิง' }}
                    </p>
                </div>
            </div>

            <div class="flex items-start gap-3 p-2 rounded-lg hover:bg-gray-50 transition-colors">
                <i class="fas fa-heart text-emerald-500 mt-1 w-5 text-center"></i>
                <div>
                    <span class="text-xs font-semibold text-gray-400 uppercase tracking-wide">สถานะ</span>
                    <p class="text-gray-800 font-medium">{{ $data_member->MARRIAGE_STATUS ?? '-' }}</p>
                </div>
            </div>

            <div class="flex items-start gap-3 p-2 rounded-lg hover:bg-gray-50 transition-colors">
                <i class="fas fa-tint text-emerald-500 mt-1 w-5 text-center"></i>
                <div>
                    <span class="text-xs font-semibold text-gray-400 uppercase tracking-wide">กรุ๊ปเลือด</span>
                    <p class="text-gray-800 font-medium">{{ $data_member->BLO_GROUP ?? '-' }}</p>
                </div>
            </div>

            <div class="flex items-start gap-3 p-2 rounded-lg hover:bg-gray-50 transition-colors">
                <i class="fas fa-male text-emerald-500 mt-1 w-5 text-center"></i>
                <div>
                    <span class="text-xs font-semibold text-gray-400 uppercase tracking-wide">ชื่อบิดา</span>
                    <p class="text-gray-800 font-medium">{{ $data_member->FATHER ?? '-' }}</p>
                </div>
            </div>

            <div class="flex items-start gap-3 p-2 rounded-lg hover:bg-gray-50 transition-colors">
                <i class="fas fa-female text-emerald-500 mt-1 w-5 text-center"></i>
                <div>
                    <span class="text-xs font-semibold text-gray-400 uppercase tracking-wide">ชื่อมารดา</span>
                    <p class="text-gray-800 font-medium">{{ $data_member->MOTHER ?? '-' }}</p>
                </div>
            </div>

            <div class="flex items-start gap-3 p-2 rounded-lg hover:bg-gray-50 transition-colors">
                <i class="fas fa-phone-alt text-emerald-500 mt-1 w-5 text-center"></i>
                <div>
                    <span class="text-xs font-semibold text-gray-400 uppercase tracking-wide">เบอร์โทรศัพท์</span>
                    <p class="text-gray-800 font-medium">{{ $data_member->MOBILE_TEL }}</p>
                </div>
            </div>

            <div class="flex items-start gap-3 p-2 rounded-lg hover:bg-gray-50 transition-colors">
                <i class="fa-brands fa-line text-emerald-500 mt-1 w-5 text-center"></i>
                <div>
                    <span class="text-xs font-semibold text-gray-400 uppercase tracking-wide">LINE ID</span>
                    <p class="text-gray-800 font-medium">{{ $data_member->LINE_ID ?? '-' }}</p>
                </div>
            </div>

            <div class="flex items-start gap-3 p-2 rounded-lg hover:bg-gray-50 transition-colors">
                <i class="fas fa-envelope text-emerald-500 mt-1 w-5 text-center"></i>
                <div>
                    <span class="text-xs font-semibold text-gray-400 uppercase tracking-wide">อีเมล</span>
                    <p class="text-gray-800 font-medium">{{ $data_member->EMAIL ?? '-' }}</p>
                </div>
            </div>

            <div class="flex items-start gap-3 p-2 rounded-lg hover:bg-gray-50 transition-colors md:col-span-2 lg:col-span-3">
                <i class="fas fa-map-marker-alt text-emerald-500 mt-1 w-5 text-center"></i>
                <div>
                    <span class="text-xs font-semibold text-gray-400 uppercase tracking-wide">ที่อยู่</span>
                    <p class="text-gray-800 font-medium leading-relaxed">
                        {{ $data_member->ADDRESS . ' หมู่ ' . $data_member->MOO_ADDR . ' ต.' . $data_member->TUMBOL }}
                    </p>
                </div>
            </div>

        </div>
    </div>
</div>