<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'INSEKTA Dashboard')</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-gradient-to-br from-light-amber via-accent-amber/30 to-light-amber/20 min-h-screen font-sans">
    <div id="dashboard-wrapper" class="flex min-h-screen relative">
        <!-- Overlay untuk Sidebar Mobile -->
        <div id="sidebar-overlay" class="sidebar-overlay md:hidden"></div>

        <!-- Sidebar Kiri -->
        @include('components.siswa.sidebar')

        <!-- Main Content -->
        <main class="flex flex-1 flex-col relative bg-light-amber/50">

            <!-- Header -->
            @include('components.siswa.header')

            <!-- Konten Utama -->
            <div class="flex flex-col lg:flex-row flex-1 p-4 lg:p-6 gap-6">

                <!-- Feed Postingan -->
                <div class="w-full lg:w-2/3 order-2 lg:order-1 bg-white rounded-xl shadow-lg p-4 lg:p-6">
                    @yield('content')
                </div>

                <!-- Sidebar Kanan -->
                <div class="w-full lg:w-1/3 order-1 lg:order-2">
                    @include('components.siswa.right-sidebar')
                </div>
            </div>

            <!-- Tombol Buat Postingan -->
            @include('components.siswa.floating-action-button')


            <!-- Serch Sidebar -->
            @include('components.siswa.search-sidebar')

        </main>
    </div>
</body>

</html>
