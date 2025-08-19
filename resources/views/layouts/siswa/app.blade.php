<!DOCTYPE html>
<html lang="id" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'INSEKTA') - Sistem Informasi Sekolah</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="h-full bg-gradient-to-br from-amber-50 via-white to-amber-100/30 font-sans antialiased">
    <div class="min-h-full flex">
        <!-- Sidebar Kiri -->
        @include('components.siswa.sidebar')

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col min-w-0">
            <main class="flex-1 flex">
                <!-- Konten Utama -->
                <div class="flex-1 overflow-y-auto">
                    <div class="max-w-4xl mx-auto">
                        @yield('content')
                    </div>
                </div>

                <!-- Sidebar Kanan (hanya tampil jika tidak di-hide) -->
                @unless(!empty($hideSidebarRight) && $hideSidebarRight)
                    <div class="hidden xl:block w-80 flex-shrink-0">
                        @include('components.siswa.right-sidebar')
                    </div>
                @endunless
            </main>
        </div>
    </div>

    <!-- Mobile Menu Overlay -->
    <div id="mobile-menu-overlay"
        class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden md:hidden">
    </div>

    <script>
        // Mobile menu toggle
        function toggleMobileMenu() {
            const sidebar = document.getElementById('sidebar-left');
            const overlay = document.getElementById('mobile-menu-overlay');

            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }

        // Close mobile menu when clicking overlay
        document.getElementById('mobile-menu-overlay')
            .addEventListener('click', toggleMobileMenu);
    </script>
</body>

</html>
