@extends('layouts.admin.app')

@section('title', 'Dashboard Admin')

@section('content')
    {{-- Ringkasan statistik utama --}}
    <div class="mb-6 grid grid-cols-1 md:grid-cols-3 gap-3">
        {{-- Total Users --}}
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg p-4 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-xs">Total Users</p>
                    <p class="text-2xl font-semibold">{{ $totalUsers ?? 0 }}</p>
                </div>
                <i class="fas fa-users text-xl text-blue-200"></i>
            </div>
        </div>

        {{-- Aktif Hari Ini --}}
        <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-lg p-4 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-100 text-xs">Aktif Hari Ini</p>
                    <p class="text-2xl font-semibold">{{ rand(50, 150) }}</p>
                </div>
                <i class="fas fa-chart-line text-xl text-green-200"></i>
            </div>
        </div>

        {{-- Status Sistem --}}
        <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-lg p-4 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-100 text-xs">Sistem Status</p>
                    <p class="text-lg font-semibold">Normal</p>
                </div>
                <i class="fas fa-server text-xl text-purple-200"></i>
            </div>
        </div>
    </div>

    {{-- Form pengumuman --}}
    <div class="mb-4">
        @include('components.admin.create-pengumuman')
    </div>

    {{-- Statistik tambahan --}}
    <div>
        <h2 class="text-lg font-semibold text-gray-900 mb-3">Ringkasan Statistik</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
            {{-- Total Diskusi --}}
            <div class="bg-gradient-to-r from-indigo-500 to-indigo-600 rounded-lg p-4 text-white">
                <p class="text-indigo-100 text-xs">Total Diskusi</p>
                <p class="text-2xl font-semibold">{{ $totalDiskusi ?? 0 }}</p>
                <i class="fas fa-users text-xl text-indigo-200 mt-1"></i>
            </div>

            {{-- Total Post --}}
            <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 rounded-lg p-4 text-white">
                <p class="text-yellow-100 text-xs">Total Post</p>
                <p class="text-2xl font-semibold">{{ $totalPosts ?? 0 }}</p>
                <i class="fas fa-pencil-alt text-xl text-yellow-200 mt-1"></i>
            </div>

            {{-- Challenge Aktif --}}
            <div class="bg-gradient-to-r from-pink-500 to-pink-600 rounded-lg p-4 text-white">
                <p class="text-pink-100 text-xs">Challenge Aktif</p>
                <p class="text-2xl font-semibold">{{ $activeChallenges ?? 0 }}</p>
                <i class="fas fa-trophy text-xl text-pink-200 mt-1"></i>
            </div>

            {{-- Pengumuman --}}
            <div class="bg-gradient-to-r from-teal-500 to-teal-600 rounded-lg p-4 text-white">
                <p class="text-teal-100 text-xs">Pengumuman</p>
                <p class="text-2xl font-semibold">{{ $leaderboardCount ?? 0 }}</p>
                <i class="fas fa-chart-bar text-xl text-teal-200 mt-1"></i>
            </div>
        </div>
    </div>
@endsection
