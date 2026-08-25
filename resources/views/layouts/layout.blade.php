<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'สหกรณ์ออมทรัพย์ษะกอฟะฮ') }} @hasSection('title')
            | @yield('title')
        @endif
    </title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@300;400;500;600;700;800&family=Inter:wght@400;500;600&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

    <link rel="icon" href="{{ url('images/sakofah-logo.png') }}" type="image/x-icon">

    <meta property="og:title" content="@yield('og_title', 'สหกรณ์อิสลามษะกอฟะฮ จำกัด')" />
    <meta property="og:type" content="website" />

    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:image" content="@yield('og_image', asset('images/sakofah-logo.png'))" />
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="630" />
    <meta property="og:description" content="@yield('og_description', 'ระดมทุน หนุนธุรกิจ นำชีวิต พ้นดอกเบี้ย')" />
    <meta property="og:site_name" content="สหกรณ์อิสลามษะกอฟะฮ จำกัด" />
    <meta property="og:locale" content="th_TH" />

    <meta name="twitter:card" content="summary_large_image" />

    <meta name="twitter:url" content="{{ url()->current() }}" />
    <meta name="twitter:title" content="@yield('og_title', 'สหกรณ์อิสลามษะกอฟะฮ จำกัด')" />
    <meta name="twitter:description" content="@yield('og_description', 'ระดมทุน หนุนธุรกิจ นำชีวิต พ้นดอกเบี้ย')" />

    <meta name="twitter:image" content="@yield('og_image', asset('images/sakofah-logo.png'))" />

    <script>
        (() => {
            const storedTheme = localStorage.getItem('sakofah-theme-v2');
            const theme = storedTheme === 'light' || storedTheme === 'dark'
                ? storedTheme
                : 'light';

            document.documentElement.classList.toggle('dark', theme === 'dark');
            document.documentElement.dataset.theme = theme;
            document.documentElement.style.colorScheme = theme;
        })();
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script async src="https://www.googletagmanager.com/gtag/js?id=G-Y7M3HX122N"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'G-Y7M3HX122N');
    </script>
<style>
        @keyframes fire-flicker {

            0%,
            100% {
                color: #ef4444;
                text-shadow: 0px -1px 3px #f97316;
            }

            50% {
                color: #f97316;
                text-shadow: 0px -2px 6px #eab308;
            }
        }

        .fire-text {
            animation: fire-flicker 0.8s ease-in-out infinite;
            font-weight: 600;
            display: inline-block;
        }
    </style>
    @stack('styles')
</head>

<body class="bg-gray-50 flex flex-col min-h-screen antialiased">
    <div data-theme-pullcord></div>
    @include('components.header')
    <main class="flex-grow">
        @yield('content')
    </main>
    @include('components.footer')
    <div id="cookie-consent"
        class="fixed bottom-4 left-4 right-4 md:left-8 md:right-auto md:bottom-8 max-w-sm bg-white border border-gray-200 rounded-xl shadow-lg p-4 md:p-6 z-50 hidden">
        <div class="text-sm text-gray-700">
            เว็บไซต์นี้ใช้คุกกี้เพื่อวิเคราะห์และปรับปรุงประสบการณ์ของผู้ใช้
            <a href="/privacy-policy" class="text-blue-600 underline hover:text-blue-800 ml-1">เรียนรู้เพิ่มเติม</a>
        </div>
        <div class="flex justify-end mt-4">
            <button id="accept-cookies"
                class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium py-2 px-4 rounded-md transition">
                ยอมรับ
            </button>
        </div>
    </div>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>
    @stack('scripts')
</body>

</html>
