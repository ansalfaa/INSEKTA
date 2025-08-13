<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Guru</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="font-sans bg-gray-100 min-h-screen flex flex-col">
    <nav class="bg-blue-700 text-white p-4 flex justify-between items-center shadow-md">
        <h1 class="text-2xl font-bold">Dashboard Guru</h1>
        <div class="flex items-center space-x-4">
            <span class="text-lg">Selamat datang, {{ auth()->user()->nama_lengkap }}</span>
            <form method="POST" action="{{ route('logout') }}" class="inline-block">
                @csrf
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-md transition duration-200 ease-in-out">
                    Logout
                </button>
            </form>
        </div>
    </nav>

    <div class="container mx-auto p-6 flex-grow">
        <div class="bg-white p-8 rounded-lg shadow-lg text-center">
            <h2 class="text-3xl font-semibold text-gray-800 mb-4">Halo, ini halaman dashboard Guru!</h2>
            @if ($guru)
                <p class="text-gray-600 text-lg">NIP: {{ $guru->nip ?? 'N/A' }}</p>
                <p class="text-gray-600 text-lg">Bidang Studi: {{ $guru->bidang_studi ?? 'N/A' }}</p>
            @else
                <p class="text-gray-600 text-lg">Data guru tidak ditemukan.</p>
            @endif
            <p class="text-gray-600 text-lg mt-4">Di sini Anda bisa mengelola mata pelajaran, nilai siswa, dan informasi lainnya.</p>
        </div>
    </div>
</body>
</html>
