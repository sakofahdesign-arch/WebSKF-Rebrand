@php
    $leftItems = [
        [
            'label' => 'หน้าหลัก',
            'href' => route('index'),
            'icon' => 'home',
        ],
        [
            'label' => 'เกี่ยวกับเรา',
            'href' => route('history'),
            'icon' => 'user',
            'children' => [
                ['label' => 'ประวัติความเป็นมา', 'href' => route('history')],
                ['label' => 'วิสัยทัศน์ พันธกิจ', 'href' => route('vision')],
                ['label' => 'คณะกรรมการ/ผู้บริหาร', 'href' => route('manager')],
                ['label' => 'สำนักงาน', 'href' => route('office')],
                ['label' => 'โครงสร้างสหกรณ์', 'href' => route('structure')],
                ['label' => 'รถโมบาย', 'href' => route('mobile')],
            ],
        ],
        [
            'label' => 'บริการสหกรณ์',
            'href' => route('register'),
            'icon' => 'landmark',
            'children' => [
                ['label' => 'สมัครสมาชิก', 'href' => route('register')],
                ['label' => 'บริการเงินฝาก', 'href' => route('deposit')],
                ['label' => 'บริการสินเชื่อ', 'href' => route('credit_service')],
            ],
        ],
        [
            'label' => 'สวัสดิการ',
            'href' => route('marry'),
            'icon' => 'heart',
            'children' => [
                ['label' => 'สวัสดิการแต่งงาน', 'href' => route('marry')],
                ['label' => 'สวัสดิการคลอดบุตร', 'href' => route('maternity')],
                ['label' => 'เงินสมทบยามชรา', 'href' => route('oldage')],
                ['label' => 'ค่ารักษาพยาบาล', 'href' => route('medical')],
                ['label' => 'สวัสดิการเสียชีวิต', 'href' => route('dead')],
            ],
        ],
    ];

    $rightItems = [
        [
            'label' => 'ข่าวสาร',
            'href' => route('activity'),
            'icon' => 'newspaper',
            'children' => [
                ['label' => 'กิจกรรม/ความเคลื่อนไหว', 'href' => route('activity')],
                ['label' => 'ปฏิทินสหกรณ์', 'href' => route('calender')],
            ],
        ],
        [
            'label' => 'ขายสินทรัพย์',
            'href' => route('homeList'),
            'icon' => 'flame',
            'highlight' => true,
            'children' => [
                ['label' => 'บ้านพร้อมที่ดิน/ทาวน์โฮม', 'href' => route('homeList')],
                ['label' => 'ที่ดินเปล่า', 'href' => route('vacantList')],
                ['label' => 'คอนโด', 'href' => route('condoList')],
            ],
        ],
        [
            'label' => 'ดาวน์โหลด',
            'href' => route('document'),
            'icon' => 'download',
            'children' => [
                ['label' => 'เอกสารสำหรับสมาชิก', 'href' => route('document')],
                ['label' => 'รายงานกิจการ', 'href' => route('businessreport')],
            ],
        ],
        [
            'label' => 'ติดต่อ',
            'href' => route('contact'),
            'icon' => 'phone',
            'children' => [
                ['label' => 'แบบประเมินบริการ', 'href' => '#'],
                ['label' => 'ร่วมงานกับเรา', 'href' => route('withus')],
                ['label' => 'สาขา', 'href' => route('office')],
            ],
        ],
        [
            'label' => 'พาทเนอร์',
            'href' => 'https://www.tiptakaful.com/th/insurance',
            'icon' => 'handshake',
            'children' => [
                [
                    'label' => 'ผลิตภัณฑ์ทิพยตะกาฟุล',
                    'href' => 'https://www.tiptakaful.com/th/insurance',
                    'external' => true,
                ],
                [
                    'label' => 'ซื้อประกันออนไลน์',
                    'href' => 'https://affinity.tipinsure.com/product/affinity/takaful_branch?branch=TKF_SKF',
                    'external' => true,
                ],
            ],
        ],
    ];
@endphp

<header data-section="notch-navbar">
    <div
        data-notch-navbar
        data-logo-src="{{ asset('images/sakofah-logo.png') }}"
        data-logo-alt="SAKOFAH"
        data-left-items='@json($leftItems)'
        data-right-items='@json($rightItems)'
    ></div>

    <noscript>
        <nav class="bg-emerald-950 px-4 py-3 text-white">
            <a href="{{ route('index') }}" class="font-semibold">SAKOFAH</a>
        </nav>
    </noscript>
</header>

<div
    class="{{
        request()->routeIs('office') || request()->routeIs('vision')
            ? 'h-0 bg-transparent'
            : (request()->routeIs('index') ? 'h-10 bg-transparent' : 'h-16 bg-white')
    }}"
    aria-hidden="true"
></div>
