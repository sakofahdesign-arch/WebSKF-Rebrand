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

    <div
        class="homepage-heading-spotlight pointer-events-none absolute inset-x-0 top-0 -z-10 h-64"
    ></div>

    <div class="relative z-10 mx-auto max-w-[1560px] px-4 sm:px-6 lg:px-8">


        {{-- ====================================================== --}}
        {{-- HEADING --}}
        {{-- ====================================================== --}}

        <div class="mx-auto mb-12 max-w-3xl text-center">

            <h2
                class="text-3xl md:text-4xl font-extrabold text-black dark:text-white tracking-tight"
            >
                ผลิตภัณฑ์สหกรณ์
            </h2>

            <div
                class="mt-3 h-1 w-20 bg-green-500 mx-auto rounded-full"
            ></div>

            <p
                class="mx-auto mt-4 max-w-2xl text-base leading-relaxed md:text-lg dark:text-white/78"
                style="color:#6B7280;"
            >
                เข้าถึงบริการต่างๆ ได้อย่างรวดเร็ว
                และติดตามความเคลื่อนไหวล่าสุดจากเรา
            </p>

        </div>



        {{-- ====================================================== --}}
        {{-- SERVICE CARDS --}}
        {{-- ====================================================== --}}

        <div class="service-grid">

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
                        --service-main: {{ $color['main'] }};
                        --service-frame: {{ $color['frame'] }};
                        --service-border: {{ $color['border'] }};
                        --service-button-text: {{ $color['buttonText'] }};
                        aspect-ratio: 1 / 1.34;
                        border-radius: 18px;
                        border: 1.5px solid {{ $color['border'] }};
                        box-shadow:
                            0 8px 20px rgba(15,23,42,0.07),
                            0 18px 42px rgba(15,23,42,0.10);
                    "
                >


                    {{-- ================================================== --}}
                    {{-- TOP GRAPHIC AREA --}}
                    {{-- ================================================== --}}

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


                        {{-- PERSON --}}
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
                                    d="
                                        M58 178
                                        C58 128 74 108 100 108
                                        C126 108 142 128 142 178
                                        Z
                                    "
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



                        {{-- WALLET --}}
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
                                    d="
                                        M34 83
                                        C34 75 40 69 48 69
                                        H151
                                        C160 69 166 76 166 85
                                        V104
                                        H34
                                        Z
                                    "
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



                        {{-- CHART --}}
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
                                    d="
                                        M42 106
                                        L91 70
                                        L131 89
                                        L160 49
                                    "
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



                        {{-- DOCUMENT --}}
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
                                    d="
                                        M141 134
                                        V158

                                        M131 148
                                        L141 158
                                        L151 148
                                    "
                                    fill="none"
                                    stroke="#ffffff"
                                    stroke-width="6"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />

                            </svg>

                        @endif

                    </div>



                    {{-- ================================================== --}}
                    {{-- CONTENT AREA --}}
                    {{-- ================================================== --}}

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
    | SECTION
    |--------------------------------------------------------------------------
    */

    [data-section="service-intel"] {
        background: transparent !important;
    }



    /*
    |--------------------------------------------------------------------------
    | SERVICE GRID
    |--------------------------------------------------------------------------
    |
    | สำคัญ:
    | ไม่ใช้ grid-cols-4 แบบ 1fr
    | เพราะมันทำให้แต่ละ column กว้างกว่าตัว card
    |
    */

    [data-section="service-intel"] .service-grid {

        display: grid;

        /*
         * มือถือ = 1 ใบ
         */
        grid-template-columns: 220px;

        /*
         * ระยะห่างจริงระหว่างแต่ละ card
         */
        column-gap: 22px;
        row-gap: 18px;

        /*
         * ให้ container กว้างตาม card จริง
         * ไม่ยืดเต็มพื้นที่
         */
        width: fit-content;
        max-width: 100%;

        /*
         * จัด card ทั้งกลุ่มไว้ตรงกลาง
         */
        margin-left: auto;
        margin-right: auto;

        align-items: stretch;
        justify-content: center;
    }



    /*
    |--------------------------------------------------------------------------
    | TABLET
    |--------------------------------------------------------------------------
    */

    @media (min-width: 640px) {

        [data-section="service-intel"] .service-grid {
            grid-template-columns: repeat(2, 220px);
        }

    }



    /*
    |--------------------------------------------------------------------------
    | DESKTOP
    |--------------------------------------------------------------------------
    */

    @media (min-width: 1280px) {

        [data-section="service-intel"] .service-grid {

            /*
             * 4 cards x 220px
             *
             * ช่องว่างจริงระหว่างแต่ละ card
             */
            grid-template-columns: repeat(4, 220px);

            column-gap: 24px;
        }

    }



    /*
    |--------------------------------------------------------------------------
    | CARD
    |--------------------------------------------------------------------------
    */

    [data-section="service-intel"] .service-card {

        min-height: 0;

        isolation: isolate;
        background:
            radial-gradient(125% 92% at 9% 0%, rgba(255, 255, 255, 0.82), rgba(255, 255, 255, 0.34) 44%, transparent 72%),
            linear-gradient(135deg, rgba(255, 255, 255, 0.62), rgba(255, 255, 255, 0.20) 48%, color-mix(in srgb, var(--service-frame) 38%, transparent)),
            color-mix(in srgb, var(--service-frame) 54%, rgba(255, 255, 255, 0.38)) !important;
        backdrop-filter: blur(14px) saturate(1.55) contrast(1.04);
        -webkit-backdrop-filter: blur(14px) saturate(1.55) contrast(1.04);

        /*
         * ให้ card เต็ม column 220px
         */
        width: 220px;
        max-width: 220px;

        justify-self: center;

        box-shadow:
            0 18px 42px color-mix(in srgb, var(--service-main) 18%, transparent),
            0 10px 24px rgba(15, 23, 42, 0.10),
            inset 0 1px 0 rgba(255, 255, 255, 0.96),
            inset 1px 0 0 rgba(255, 255, 255, 0.76),
            inset 0 -16px 30px color-mix(in srgb, var(--service-main) 9%, transparent) !important;
    }

    [data-section="service-intel"] .service-card::before,
    [data-section="service-intel"] .service-card::after {
        position: absolute;
        inset: 0;
        border-radius: inherit;
        content: "";
        pointer-events: none;
        z-index: 0;
    }

    [data-section="service-intel"] .service-card::before {
        padding: 1.25px;
        background:
            linear-gradient(135deg, rgba(255, 255, 255, 0.98), rgba(255, 255, 255, 0.18) 30%, color-mix(in srgb, var(--service-main) 30%, transparent) 58%, rgba(255, 255, 255, 0.84)),
            radial-gradient(12rem 8rem at 18% 0%, rgba(255, 255, 255, 0.80), transparent 68%);
        mask:
            linear-gradient(#000 0 0) content-box,
            linear-gradient(#000 0 0);
        mask-composite: exclude;
        -webkit-mask:
            linear-gradient(#000 0 0) content-box,
            linear-gradient(#000 0 0);
        -webkit-mask-composite: xor;
    }

    [data-section="service-intel"] .service-card::after {
        background:
            linear-gradient(110deg, transparent 0%, rgba(255, 255, 255, 0.38) 13%, transparent 30%),
            radial-gradient(10rem 4rem at 50% -4%, rgba(255, 255, 255, 0.68), transparent 72%),
            radial-gradient(9rem 7rem at 92% 96%, color-mix(in srgb, var(--service-main) 16%, transparent), transparent 72%);
        box-shadow:
            inset 0 0 0 0.5px rgba(255, 255, 255, 0.74),
            inset 0 12px 28px rgba(255, 255, 255, 0.22),
            inset 0 -1px 0 color-mix(in srgb, var(--service-main) 24%, transparent);
        mix-blend-mode: screen;
        opacity: 0.92;
    }

    [data-section="service-intel"] .service-card > * {
        position: relative;
        z-index: 1;
    }



    /*
    |--------------------------------------------------------------------------
    | CARD HOVER
    |--------------------------------------------------------------------------
    */

    [data-section="service-intel"] .service-card:hover {

        transform: translateY(-7px);

        box-shadow:
            0 24px 54px color-mix(in srgb, var(--service-main) 22%, transparent),
            0 14px 32px rgba(15, 23, 42, 0.13),
            inset 0 1px 0 rgba(255, 255, 255, 0.98),
            inset 1px 0 0 rgba(255, 255, 255, 0.82),
            inset 0 -18px 34px color-mix(in srgb, var(--service-main) 11%, transparent) !important;
    }



    /*
    |--------------------------------------------------------------------------
    | GRAPHIC FRAME
    |--------------------------------------------------------------------------
    */

    [data-section="service-intel"] .service-frame {
        border: 1px solid rgba(255, 255, 255, 0.54);
        background:
            radial-gradient(105% 92% at 12% 0%, rgba(255, 255, 255, 0.58), transparent 70%),
            linear-gradient(135deg, rgba(255, 255, 255, 0.36), color-mix(in srgb, var(--service-frame) 82%, rgba(255, 255, 255, 0.18))) !important;
        box-shadow:
            inset 0 1px 0 rgba(255, 255, 255, 0.82),
            inset 0 -14px 28px color-mix(in srgb, var(--service-main) 8%, transparent);
        backdrop-filter: blur(10px) saturate(1.35);
        -webkit-backdrop-filter: blur(10px) saturate(1.35);
    }



    /*
    |--------------------------------------------------------------------------
    | ICON
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


    /*
    | GREEN
    */

    [data-section="service-intel"]
    .service-card:nth-child(1)
    .service-button:hover {

        background-color: #10B981 !important;

    }


    /*
    | BLUE
    */

    [data-section="service-intel"]
    .service-card:nth-child(2)
    .service-button:hover {

        background-color: #3B82F6 !important;

    }


    /*
    | YELLOW
    */

    [data-section="service-intel"]
    .service-card:nth-child(3)
    .service-button:hover {

        background-color: #F59E0B !important;

    }


    /*
    | RED
    */

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



    /*
    |--------------------------------------------------------------------------
    | MOBILE
    |--------------------------------------------------------------------------
    */

    @media (max-width: 639px) {

        [data-section="service-intel"] .service-grid {

            /*
             * ป้องกัน overflow บนมือถือจอเล็ก
             */
            grid-template-columns: minmax(0, 220px);

            width: 100%;

        }


        [data-section="service-intel"] .service-card {

            width: 100%;
            max-width: 220px;

        }

    }

</style>
