<!-- Profile Card -->
<div class="bg-white p-6 rounded-xl shadow-lg">
    <h3 class="text-xl font-semibold text-gray-800 mb-6 border-b pb-4">รายละเอียดข้อมูลส่วนตัว</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 text-sm">
        <div class="p-2"><strong class="text-gray-500 block">ชื่อ-นามสกุล:</strong> <span
                class="text-gray-900">{{ $data_member->FNAME . ' ' . $data_member->LNAME }}</span></div>
        <div class="p-2"><strong class="text-gray-500 block">เลขบัตรประชาชน:</strong> <span
                class="text-gray-900">{{ $data_member->ID_CARD }}</span></div>
        <div class="p-2"><strong class="text-gray-500 block">วันเกิด:</strong> <span
                class="text-gray-900">{{ $data_member->DMY_BIRTH ? thaidate('j F Y', $data_member->DMY_BIRTH) : '-' }}</span>
        </div>
        <div class="p-2"><strong class="text-gray-500 block">เพศ:</strong> <span
                class="text-gray-900">{{ $data_member->SEX == '1' ? 'ชาย' : 'หญิง' }}</span></div>
        <div class="p-2"><strong class="text-gray-500 block">สถานะ:</strong> <span
                class="text-gray-900">{{ $data_member->MARRIAGE_STATUS ?? '-' }}</span></div>
        <div class="p-2"><strong class="text-gray-500 block">กรุ๊ปเลือด:</strong> <span
                class="text-gray-900">{{ $data_member->BLO_GROUP ?? '-' }}</span></div>
        <div class="p-2"><strong class="text-gray-500 block">ชื่อบิดา:</strong> <span
                class="text-gray-900">{{ $data_member->FATHER ?? '-' }}</span></div>
        <div class="p-2"><strong class="text-gray-500 block">ชื่อมารดา:</strong> <span
                class="text-gray-900">{{ $data_member->MOTHER ?? '-' }}</span></div>
        <div class="p-2"><strong class="text-gray-500 block">เบอร์โทรศัพท์:</strong> <span
                class="text-gray-900">{{ $data_member->MOBILE_TEL }}</span></div>
        <div class="p-2"><strong class="text-gray-500 block">LINE ID:</strong> <span
                class="text-gray-900">{{ $data_member->LINE_ID ?? '-' }}</span></div>
        <div class="p-2"><strong class="text-gray-500 block">อีเมล:</strong> <span
                class="text-gray-900">{{ $data_member->EMAIL ?? '-' }}</span></div>
        <div class="p-2 md:col-span-2"><strong class="text-gray-500 block">ที่อยู่:</strong> <span
                class="text-gray-900">{{ $data_member->ADDRESS . ' หมู่ ' . $data_member->MOO_ADDR . ' ต.' . $data_member->TUMBOL }}</span>
        </div>
    </div>
</div>