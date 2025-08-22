@extends('layouts.siswa.app', ['hideSidebarRight' => true])

@section('title', 'Profil Siswa')

@section('content')
    <div class="bg-gray-50 min-h-screen py-8">
        <div class="max-w-3xl mx-auto px-4 space-y-6">

            {{-- Header Profil --}}
            <div class="relative">
                {{-- Cover --}}
                <div class="h-32 w-full rounded-t-2xl bg-gradient-to-r from-amber-400 to-orange-300"></div>

                {{-- Foto Profil --}}
                <div class="absolute -bottom-12 left-6">
                    <img src="{{ asset('images/default-profile.png') }}" alt="Foto Profil"
                        class="w-24 h-24 rounded-full object-cover ring-4 ring-white shadow-lg">
                </div>
            </div>

            {{-- Info Utama --}}
            <div class="mt-16 px-6">
                <h1 class="text-2xl font-bold text-amber-900">
                    {{ auth()->user()->name }}
                </h1>
                <p class="text-gray-600 text-sm mt-1">
                    NIS: {{ auth()->user()->nis ?? '-' }} ·
                    {{ auth()->user()->kelas ?? '-' }} ·
                    {{ auth()->user()->jurusan ?? '-' }}
                </p>
                <p class="text-gray-500 text-sm mt-3">
                    {{ auth()->user()->bio ?? 'Belum ada bio ✨' }}
                </p>
            </div>

            {{-- Navigasi Tab --}}
            <div class="mt-6 border-b border-gray-200 flex text-sm font-medium text-gray-600">
                <button class="flex-1 py-3 text-center hover:bg-gray-100 hover:text-amber-600 transition">
                    Postingan
                </button>
                <button class="flex-1 py-3 text-center hover:bg-gray-100 hover:text-amber-600 transition">
                    Balasan
                </button>
                <button class="flex-1 py-3 text-center hover:bg-gray-100 hover:text-amber-600 transition">
                    Suka
                </button>
                <button class="flex-1 py-3 text-center hover:bg-gray-100 hover:text-amber-600 transition">
                    Bookmark
                </button>
            </div>

            {{-- Feed Konten (contoh dummy, bisa diganti foreach postingan siswa) --}}
            <div class="space-y-4">
                <div class="bg-white rounded-xl shadow p-4">
                    <p class="text-gray-800 text-sm">
                        Ini adalah contoh postingan siswa. Bisa diisi dari database postingan.
                    </p>
                    <div class="flex justify-between text-xs text-gray-500 mt-3">
                        <span>❤️ 5</span>
                        <span>💬 2</span>
                        <span>🔖 1</span>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow p-4">
                    <p class="text-gray-800 text-sm">
                        Postingan kedua, tampil rapi dengan aksi suka, komentar, dan simpan.
                    </p>
                    <div class="flex justify-between text-xs text-gray-500 mt-3">
                        <span>❤️ 3</span>
                        <span>💬 1</span>
                        <span>🔖 0</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
