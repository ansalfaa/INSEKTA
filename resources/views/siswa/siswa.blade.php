@extends('layouts.siswa.app')
@section('title', 'Dashboard Siswa')

@section('content')
<div class="bg-gray-50 min-h-screen py-6">
    <div class="max-w-2xl mx-auto px-4 space-y-6">

        {{-- Filter Navigasi --}}
        <div class="flex justify-center">
            <nav class="bg-white/80 backdrop-blur-md rounded-xl shadow border border-amber-200/50 p-1 flex space-x-1">
                @php
                    $filter = request('filter', 'semua');
                @endphp

                <a href="{{ route('siswa.dashboard', ['filter' => 'semua']) }}"
                   class="px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200
                          {{ $filter === 'semua'
                              ? 'bg-amber-500 text-white shadow-md'
                              : 'text-gray-600 hover:bg-amber-100 hover:text-amber-700' }}">
                    Semua
                </a>

                <a href="{{ route('siswa.dashboard', ['filter' => 'jurusan']) }}"
                   class="px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200
                          {{ $filter === 'jurusan'
                              ? 'bg-amber-500 text-white shadow-md'
                              : 'text-gray-600 hover:bg-amber-100 hover:text-amber-700' }}">
                    Jurusan
                </a>

                <a href="{{ route('siswa.dashboard', ['filter' => 'kelas']) }}"
                   class="px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200
                          {{ $filter === 'kelas'
                              ? 'bg-amber-500 text-white shadow-md'
                              : 'text-gray-600 hover:bg-amber-100 hover:text-amber-700' }}">
                    Kelas
                </a>
            </nav>
        </div>

        {{-- Form Postingan --}}
        <div>
            <x-siswa.create-post-card />
        </div>

        {{-- Feed --}}
        <div class="space-y-6">
            @forelse ($postingan as $post)
                <div class="transform transition-all duration-200 hover:scale-[1.02]">
                    <x-siswa.post-card
                        user-avatar="{{ asset('storage/profil/' . $post->user->foto) }}"
                        username="{{ $post->user->username }}"
                        time-ago="{{ $post->created_at->diffForHumans() }}"
                        content="{{ $post->caption }}"
                        :media="$post->media_url" />
                </div>
            @empty
                {{-- Empty State --}}
                <div class="text-center py-12">
                    <div class="bg-gradient-to-br from-amber-50 to-amber-100/50 rounded-2xl p-8 border border-amber-200/50">
                        <svg class="w-16 h-16 text-amber-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                        <h3 class="text-lg font-semibold text-amber-800 mb-2">Belum Ada Postingan</h3>
                        <p class="text-amber-600 text-sm">Jadilah yang pertama membagikan sesuatu!</p>
                    </div>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if($postingan->hasPages())
            <div class="text-center pt-6">
                <div class="inline-flex">
                    {{ $postingan->links('pagination::tailwind') }}
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
