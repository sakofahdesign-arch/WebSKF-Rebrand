@php
    $services = [
        [
            'href' => route('register'),
            'title' => 'สมัครสมาชิก',
            'description' => 'เริ่มต้นการเป็นสมาชิก เพื่อรับสิทธิประโยชน์มากมาย',
            'button' => 'สมัครสมาชิก',
            'accent' => 'green',
            'illustration' => 'person',
        ],
        [
            'href' => route('deposit'),
            'title' => 'บริการเงินฝาก',
            'description' => 'ออมเงินกับสหกรณ์ มั่นคง ปลอดภัย ได้ผลตอบแทน',
            'button' => 'ดูบริการเงินฝาก',
            'accent' => 'blue',
            'illustration' => 'wallet',
        ],
        [
            'href' => route('credit_service'),
            'title' => 'บริการสินเชื่อ',
            'description' => 'บริการสินเชื่อหลากหลาย ตอบโจทย์ทุกความต้องการ',
            'button' => 'ดูบริการสินเชื่อ',
            'accent' => 'yellow',
            'illustration' => 'chart',
        ],
        [
            'href' => route('document'),
            'title' => 'เอกสารสมาชิก',
            'description' => 'ดาวน์โหลดเอกสารและแบบฟอร์มสำหรับสมาชิก',
            'button' => 'ดูเอกสารสมาชิก',
            'accent' => 'red',
            'illustration' => 'document',
        ],
    ];

    $accentColors = [
        'green' => [
            'main'       => '#10B981',
            'soft'       => '#BFEEDC',
            'frame'      => '#DDF7EC',
            'border'     => '#34D399',
            'buttonText' => '#059669',
        ],

        'blue' => [
            'main'       => '#3B82F6',
            'soft'       => '#B8D7FF',
            'frame'      => '#DCEBFF',
            'border'     => '#60A5FA',
            'buttonText' => '#2563EB',
        ],

        'yellow' => [
            'main'       => '#F59E0B',
            'soft'       => '#FDE081',
            'frame'      => '#FFF2C7',
            'border'     => '#FBBF24',
            'buttonText' => '#D97706',
        ],

        'red' => [
            'main'       => '#EF4444',
            'soft'       => '#F9B8B8',
            'frame'      => '#FDE0E0',
            'border'     => '#F87171',
            'buttonText' => '#DC2626',
        ],
    ];
@endphp


<section
    data-section="service-intel"
    class="relative isolate overflow-visible py-16 lg:py-20"
>
    <div class="homepage-heading-spotlight pointer-events-none absolute inset-x-0 top-0 -z-10 h-64"></div>

    <div class="relative z-10 mx-auto max-w-[1560px] px-4 sm:px-6 lg:px-8">

        {{-- Heading --}}
        <div class="mx-auto mb-12 max-w-3xl text-center">
            <h2
                class="text-3xl md:text-4xl font-extrabold text-black dark:text-white tracking-tight"
            >
                ผลิตภัณฑ์สหกรณ์
            </h2>
            <div class="mt-3 h-1 w-20 bg-green-500 mx-auto rounded-full"></div>

            <p
                class="mx-auto mt-4 max-w-2xl text-base leading-relaxed md:text-lg dark:text-white/78"
                style="color:#6B7280;"
            >
                เข้าถึงบริการต่างๆ ได้อย่างรวดเร็ว และติดตามความเคลื่อนไหวล่าสุดจากเรา
            </p>
        </div>


        {{-- Cards --}}
        <div
            class="
                mx-auto
                grid
                max-w-[920px]
                grid-cols-1
                items-stretch
                gap-5
                sm:grid-cols-2
                xl:grid-cols-4
            "
        >

            @foreach ($services as $service)

                @php
                    $color = $accentColors[$service['accent']];
                @endphp

                <a
                    href="{{ $service['href'] }}"
                    class="
                        service-card
                        group
                        relative
                        flex
                        flex-col
                        overflow-hidden
                        bg-white
                        transition-all
                        duration-300
                        ease-out
                    "
                    style="
                        aspect-ratio: 1 / 1.34;
                        border-radius: 18px;
                        border: 1.5px solid {{ $color['border'] }};
                        box-shadow:
                            0 8px 20px rgba(15,23,42,0.07),
                            0 18px 42px rgba(15,23,42,0.10);
                    "
                >

                    {{-- ============================ --}}
                    {{-- TOP GRAPHIC AREA --}}
                    {{-- ============================ --}}
                    <div
                        class="
                            service-frame
                            flex
                            shrink-0
                            items-center
                            justify-center
                            transition-all
                            duration-300
                            group-hover:scale-[1.015]
                        "
                        style="
                            height: 50%;
                            margin: 8px 8px 0 8px;
                            border-radius: 13px;
                            background-color: {{ $color['frame'] }};
                        "
                    >

                        @if ($service['illustration'] === 'person')

                            <svg
                                viewBox="0 0 200 200"
                                class="service-icon"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <circle
                                    cx="100"
                                    cy="64"
                                    r="29"
                                    fill="{{ $color['main'] }}"
                                />

                                <path
                                    d="M58 178
                                       C58 128 74 108 100 108
                                       C126 108 142 128 142 178
                                       Z"
                                    fill="{{ $color['main'] }}"
                                />

                                <circle
                                    cx="147"
                                    cy="142"
                                    r="25"
                                    fill="#ffffff"
                                    stroke="{{ $color['main'] }}"
                                    stroke-width="5"
                                />

                                <path
                                    d="M136 142 L144 150 L159 133"
                                    fill="none"
                                    stroke="{{ $color['main'] }}"
                                    stroke-width="6"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />
                            </svg>


                        @elseif ($service['illustration'] === 'wallet')

                            <svg
                                viewBox="0 0 200 200"
                                class="service-icon"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <rect
                                    x="34"
                                    y="69"
                                    width="132"
                                    height="97"
                                    rx="18"
                                    fill="{{ $color['soft'] }}"
                                />

                                <path
                                    d="M34 83
                                       C34 75 40 69 48 69
                                       H151
                                       C160 69 166 76 166 85
                                       V104
                                       H34
                                       Z"
                                    fill="{{ $color['main'] }}"
                                />

                                <rect
                                    x="122"
                                    y="99"
                                    width="44"
                                    height="45"
                                    rx="14"
                                    fill="{{ $color['main'] }}"
                                />

                                <circle
                                    cx="145"
                                    cy="121"
                                    r="8"
                                    fill="#ffffff"
                                />
                            </svg>


                        @elseif ($service['illustration'] === 'chart')

                            <svg
                                viewBox="0 0 200 200"
                                class="service-icon"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <rect
                                    x="43"
                                    y="120"
                                    width="22"
                                    height="49"
                                    rx="5"
                                    fill="{{ $color['soft'] }}"
                                />

                                <rect
                                    x="88"
                                    y="96"
                                    width="22"
                                    height="73"
                                    rx="5"
                                    fill="{{ $color['soft'] }}"
                                />

                                <rect
                                    x="133"
                                    y="65"
                                    width="22"
                                    height="104"
                                    rx="5"
                                    fill="{{ $color['main'] }}"
                                />

                                <path
                                    d="M42 106
                                       L91 70
                                       L131 89
                                       L160 49"
                                    fill="none"
                                    stroke="{{ $color['main'] }}"
                                    stroke-width="7"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />

                                <path
                                    d="M145 47 L165 47 L160 67 Z"
                                    fill="{{ $color['main'] }}"
                                />
                            </svg>


                        @else

                            <svg
                                viewBox="0 0 200 200"
                                class="service-icon"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <rect
                                    x="48"
                                    y="34"
                                    width="104"
                                    height="134"
                                    rx="14"
                                    fill="{{ $color['soft'] }}"
                                />

                                <rect
                                    x="65"
                                    y="58"
                                    width="70"
                                    height="8"
                                    rx="4"
                                    fill="{{ $color['main'] }}"
                                />

                                <rect
                                    x="65"
                                    y="80"
                                    width="70"
                                    height="8"
                                    rx="4"
                                    fill="{{ $color['main'] }}"
                                />

                                <rect
                                    x="65"
                                    y="102"
                                    width="44"
                                    height="8"
                                    rx="4"
                                    fill="{{ $color['main'] }}"
                                />

                                <circle
                                    cx="141"
                                    cy="148"
                                    r="28"
                                    fill="{{ $color['main'] }}"
                                />

                                <path
                                    d="M141 134
                                       V158
                                       M131 148
                                       L141 158
                                       L151 148"
                                    fill="none"
                                    stroke="#ffffff"
                                    stroke-width="6"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />
                            </svg>

                        @endif

                    </div>


                    {{-- ============================ --}}
                    {{-- CONTENT AREA --}}
                    {{-- ============================ --}}
                    <div
                        class="
                            flex
                            flex-1
                            flex-col
                            px-3
                            pb-3
                            pt-2.5
                        "
                    >

                        <h3
                            class="mb-1 text-[13px] font-extrabold tracking-tight"
                            style="color:#111827;"
                        >
                            {{ $service['title'] }}
                        </h3>

                        <p
                            class="mb-2.5 flex-1 text-[11px] leading-[17px]"
                            style="color:#6B7280;"
                        >
                            {{ $service['description'] }}
                        </p>


                        <span
                            class="
                                service-button
                                inline-flex
                                w-full
                                items-center
                                justify-center
                                gap-2
                                rounded-full
                                bg-white
                                px-3
                                py-1.5
                                text-[11px]
                                font-bold
                                transition-all
                                duration-300
                            "
                            style="
                                border:1.5px solid {{ $color['border'] }};
                                color:{{ $color['buttonText'] }};
                            "
                        >

                            {{ $service['button'] }}

                            <svg
                                class="h-4 w-4 transition-transform duration-300 group-hover:translate-x-1"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="2.5"
                                stroke="currentColor"
                                aria-hidden="true"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M17.25 8.25L21 12m0 0-3.75 3.75M21 12H3"
                                />
                            </svg>

                        </span>

                    </div>

                </a>

            @endforeach

        </div>

    </div>

</section>


<style>

    /*
    |--------------------------------------------------------------------------
    | IMPORTANT
    | ไม่มี background ยาวของ section
    |--------------------------------------------------------------------------
    */

    [data-section="service-intel"] {
        background: transparent !important;
    }


    /*
    |--------------------------------------------------------------------------
    | CARD
    |--------------------------------------------------------------------------
    */

    [data-section="service-intel"] .service-card {
        min-height: 0;
        background-color: #ffffff !important;
        justify-self: center;
        width: 100%;
        max-width: 220px;

        box-shadow:
            0 8px 20px rgba(15, 23, 42, 0.07),
            0 18px 42px rgba(15, 23, 42, 0.10) !important;
    }

    [data-section="service-intel"] .service-card:hover {
        transform: translateY(-7px);

        box-shadow:
            0 12px 26px rgba(15, 23, 42, 0.09),
            0 24px 50px rgba(15, 23, 42, 0.15) !important;
    }


    /*
    |--------------------------------------------------------------------------
    | GRAPHIC FRAME
    |--------------------------------------------------------------------------
    */

    [data-section="service-intel"] .service-frame {
        background-image: none !important;
    }


    /*
    |--------------------------------------------------------------------------
    | ICON
    | ประมาณ 40% ของพื้นที่ graphic ตาม reference
    |--------------------------------------------------------------------------
    */

    [data-section="service-intel"] .service-icon {
        width: 38%;
        max-width: 96px;
        height: auto;
    }


    /*
    |--------------------------------------------------------------------------
    | BUTTON HOVER
    |--------------------------------------------------------------------------
    */

    [data-section="service-intel"] .service-button:hover {
        color: #ffffff !important;
    }

    [data-section="service-intel"]
    .service-card:nth-child(1)
    .service-button:hover {
        background-color: #10B981 !important;
    }

    [data-section="service-intel"]
    .service-card:nth-child(2)
    .service-button:hover {
        background-color: #3B82F6 !important;
    }

    [data-section="service-intel"]
    .service-card:nth-child(3)
    .service-button:hover {
        background-color: #F59E0B !important;
    }

    [data-section="service-intel"]
    .service-card:nth-child(4)
    .service-button:hover {
        background-color: #EF4444 !important;
    }


    /*
    |--------------------------------------------------------------------------
    | RESPONSIVE
    |--------------------------------------------------------------------------
    */

    @media (max-width: 1279px) {

        [data-section="service-intel"] .service-card {
            aspect-ratio: auto !important;
            min-height: 300px;
        }

        [data-section="service-intel"] .service-frame {
            height: 150px !important;
        }

    }

    @media (max-width: 639px) {

        [data-section="service-intel"] .service-card {
            max-width: 230px;
        }

    }

</style>
