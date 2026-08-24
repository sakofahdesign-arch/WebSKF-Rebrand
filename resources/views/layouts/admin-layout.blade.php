<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard เจ้าหน้าที่ - {{ config('app.name', 'สหกรณ์ออมทรัพย์ษะกอฟะฮ') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@300;400;500;600;700;800&family=Inter:wght@400;500;600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="icon" href="{{ url('images/sakofah-logo.png') }}" type="image/x-icon">
    <script>
        (() => {
            const storedTheme = localStorage.getItem('sakofah-theme');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            const theme = storedTheme === 'light' || storedTheme === 'dark'
                ? storedTheme
                : (prefersDark ? 'dark' : 'light');

            document.documentElement.classList.toggle('dark', theme === 'dark');
            document.documentElement.dataset.theme = theme;
            document.documentElement.style.colorScheme = theme;
        })();
    </script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] {
            display: none !important;
        }

        body {
            font-family: 'Noto Sans Thai', 'Inter', system-ui, sans-serif;
        }
    </style>
    @stack('styles')
</head>

<body class="font-sans antialiased bg-gray-50 text-gray-900">
    <div data-theme-pullcord></div>
    <div x-data="{ sidebarOpen: false }" class="flex h-screen overflow-hidden bg-gray-100">

        @include('components.admin-sidebar')

        <div class="flex-1 flex flex-col overflow-hidden relative transition-all duration-300">

            @include('components.admin-header')

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-4 md:p-8 scroll-smooth">
                <div class="mb-6 fade-in">
                    @yield('header')
                </div>

                <div class="w-full">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: "สำเร็จ!",
                    text: "{{ session('success') }}",
                    icon: "success",
                    confirmButtonColor: '#10B981', // Emerald-500
                    confirmButtonText: 'ตกลง'
                });
            });
        </script>
    @endif
    @if (session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: "ข้อผิดพลาด!",
                    text: "{{ session('error') }}",
                    icon: "error",
                    confirmButtonColor: '#EF4444', // Red-500
                    confirmButtonText: 'ตกลง'
                });
            });
        </script>
    @endif
    @stack('scripts')
</body>

</html>
