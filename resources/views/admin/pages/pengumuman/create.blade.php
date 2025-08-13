@extends('layouts.admin.app')

@section('title', 'Tambah Pengumuman')

@section('content')
<div class="max-w-4xl mx-auto">
    {{-- Header --}}
    <div class="mb-6">
        <div class="flex items-center space-x-2 text-sm text-gray-500 mb-2">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-amber-600">Dashboard</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <a href="{{ route('admin.pengumuman.index') }}" class="hover:text-amber-600">Pengumuman</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <span class="text-amber-600">Tambah</span>
        </div>
        <h1 class="text-2xl lg:text-3xl font-bold text-gray-900">Tambah Pengumuman</h1>
        <p class="text-gray-600 mt-1">Buat pengumuman global untuk semua pengguna sistem</p>
    </div>

    {{-- Form Component --}}
    @include('components.admin.create-pengumuman', [
        'pengumuman' => null,
        'action' => route('admin.pengumuman.store'),
        'method' => 'POST'
    ])
</div>
@endsection
