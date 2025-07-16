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

    {{-- Google Fonts (Sarabun for Thai) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=sarabun:wght@400;500;700&display=swap" rel="stylesheet">
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
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-Y7M3HX122N"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'G-Y7M3HX122N');
    </script>
    @stack('styles')
</head>

<body class="bg-gray-50 flex flex-col min-h-screen antialiased">
    @include('components.header')
    <main class="flex-grow">
        @yield('content')
    </main>
    @include('components.footer')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>
    @stack('scripts')
</body>

</html>