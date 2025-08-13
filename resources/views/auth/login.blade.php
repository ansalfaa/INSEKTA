<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login - INSEKTA</title>

    {{-- Import font Poppins --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet" />

    {{-- Import Tailwind CSS via Vite --}}
    @vite('resources/css/app.css')
</head>

<body class="bg-gradient-to-br from-light-amber via-accent-amber/30 to-light-amber/20 min-h-screen flex items-center justify-center font-sans p-4 sm:p-6 lg:p-8">

    <div class="w-full max-w-6xl bg-white/80 backdrop-blur-md rounded-2xl shadow-2xl overflow-hidden lg:grid lg:grid-cols-2 lg:gap-0">

        {{-- Bagian kiri: gambar ilustrasi, hanya tampil di layar besar --}}
        <div class="hidden lg:flex items-center justify-center p-8 bg-light-amber/50">
            <img src="{{ asset('images/placeholder.svg?height=500&width=500') }}"
                 alt="Anak belajar dengan laptop"
                 class="w-full h-auto max-h-[400px] object-contain animate-fade-in" />
        </div>

        {{-- Bagian kanan: form login --}}
        <div class="p-8 lg:p-12 flex flex-col justify-center">
            <h2 class="text-3xl font-bold text-dark-amber mb-8 text-center">Masuk ke INSEKTA</h2>

            {{-- Tampilkan pesan error dari session --}}
            @if (session('error'))
                <div class="mb-6 p-3 bg-red-100 border border-red-400 text-red-700 rounded-md text-sm" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Form login --}}
            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                {{-- Input username --}}
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                    <input
                        type="text"
                        id="username"
                        name="username"
                        required
                        autofocus
                        value="{{ old('username') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm
                               focus:outline-none focus:ring-2 focus:ring-primary-amber focus:border-primary-amber
                               transition-all duration-200"
                    />
                    @error('username')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Input password --}}
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm
                               focus:outline-none focus:ring-2 focus:ring-primary-amber focus:border-primary-amber
                               transition-all duration-200"
                    />
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Checkbox Ingat Saya dan link Lupa Password --}}
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input
                            id="remember_me"
                            name="remember"
                            type="checkbox"
                            class="h-4 w-4 text-primary-amber focus:ring-primary-amber border-gray-300 rounded"
                        />
                        <label for="remember_me" class="ml-2 block text-sm text-gray-900">Ingat Saya</label>
                    </div>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                           class="text-sm text-primary-amber hover:text-dark-amber hover:underline font-medium transition-colors duration-200">
                            Lupa Password?
                        </a>
                    @endif
                </div>

                {{-- Tombol Submit --}}
                <button type="submit"
                        class="w-full bg-gradient-to-r from-primary-amber to-dark-amber hover:from-accent-amber hover:to-dark-amber
                               text-white font-semibold py-3 px-4 rounded-lg shadow-md hover:shadow-lg
                               transition-all duration-300 transform hover:-translate-y-0.5">
                    Masuk
                </button>
            </form>

            {{-- Link kontak admin jika belum punya akun --}}
            <p class="mt-8 text-center text-sm text-gray-600">
                Belum punya akun?
                <a href="{{ route('login') }}"
                   class="font-semibold text-primary-amber hover:text-dark-amber hover:underline transition-colors duration-200">
                    Hubungi Admin
                </a>
            </p>
        </div>
    </div>
</body>
</html>
