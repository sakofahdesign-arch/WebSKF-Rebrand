<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'สหกรณ์ออมทรัพย์ษะกอฟะฮ') }}@hasSection('title')
        | @yield('title')
    @endif
    </title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="icon" href="{{ url('images/sakofah-logo.png') }}" type="image/x-icon">
    <meta property="og:title" content="@yield('og_title', 'สหกรณ์อิสลามษะกอฟะฮ จำกัด')" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://www.yahoo.com/" />
    <meta property="og:image" content="@yield('og_image', asset('images/sakofah-logo.png'))" />
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="630" />

    <meta property="og:description" content="@yield('og_description', 'ระดมทุน หนุนธุรกิจ นำชีวิต พ้นดอกเบี้ย')" />
    <meta property="og:site_name" content="สหกรณ์อิสลามษะกอฟะฮ จำกัด" />
    <meta property="og:locale" content="th_TH" />

    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:url" content="https://www.yahoo.com/" />
    <meta name="twitter:title" content="@yield('og_title', 'สหกรณ์อิสลามษะกอฟะฮ จำกัด')" />
    <meta name="twitter:description" content="@yield('og_description', 'ระดมทุน หนุนธุรกิจ นำชีวิต พ้นดอกเบี้ย')" />
    <meta name="twitter:image" content="@yield('og_image', asset('images/default-og-image.jpg'))" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @if (session('cookie_accepted'))
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-Y7M3HX122N"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag() { dataLayer.push(arguments); }
            gtag('js', new Date());
            gtag('config', 'G-Y7M3HX122N');
        </script>
    @endif

    @stack('styles')
</head>

<body class="bg-gray-50 flex flex-col min-h-screen antialiased">
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

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const consent = localStorage.getItem("cookie_consent");
        if (consent === "true") {
            // เรียก backend ให้บันทึกข้อมูลแค่ครั้งเดียว
            if (!localStorage.getItem("visitor_logged")) {
                fetch("/track-visitor", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ track: true })
                })
                .then(res => res.json())
                .then(data => {
                    console.log("Visited saved", data);
                    localStorage.setItem("visitor_logged", "true"); // ป้องกันการบันทึกซ้ำ
                })
                .catch(err => console.error("Visitor tracking failed", err));
            }
        }
    });
</script>


    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>
    @stack('scripts')
</body>

</html>