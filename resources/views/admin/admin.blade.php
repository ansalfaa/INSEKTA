@extends('layouts.admin.app')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="max-w-3xl mx-auto px-4">
        {{-- Header Section --}}
        <div class="mb-8">
            <div class="bg-gradient-to-r from-amber-50 to-orange-50 rounded-2xl p-6 border border-amber-100">
                <h1 class="text-2xl font-bold text-amber-900 mb-2">Dashboard Overview</h1>
                <p class="text-amber-700">Welcome back! Here's what's happening with your platform today.</p>
            </div>
        </div>

        {{-- Main Statistics Cards --}}
        <div class="mb-6 grid grid-cols-1 md:grid-cols-2 gap-4">
            {{-- Total Users --}}
            <div class="group hover:scale-105 transition-all duration-300">
                <div class="bg-gradient-to-br from-amber-500 to-amber-600 rounded-lg p-4 text-white shadow-md hover:shadow-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-amber-100 text-xs font-medium">Total Users</p>
                            <p class="text-2xl font-bold mt-1">{{ $totalUsers ?? 0 }}</p>
                            <span class="text-amber-200 text-xs">↗ +12% dari bulan lalu</span>
                        </div>
                        <div class="bg-amber-400/20 rounded-full p-2">
                            <i class="fas fa-users text-xl text-amber-100"></i>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Aktif Hari Ini --}}
            <div class="group hover:scale-105 transition-all duration-300">
                <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-lg p-4 text-white shadow-md hover:shadow-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-orange-100 text-xs font-medium">Aktif Hari Ini</p>
                            <p class="text-2xl font-bold mt-1">{{ rand(50, 150) }}</p>
                            <span class="text-orange-200 text-xs">↗ +8% dari kemarin</span>
                        </div>
                        <div class="bg-orange-400/20 rounded-full p-2">
                            <i class="fas fa-chart-line text-xl text-orange-100"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Form pengumuman --}}
        <div class="mb-8">
            <div class="bg-white rounded-xl shadow-sm border border-amber-100 overflow-hidden">
                <div class="bg-gradient-to-r from-amber-500 to-orange-500 px-6 py-4">
                    <h3 class="text-lg font-semibold text-white">Quick Actions</h3>
                </div>
                <div class="p-6">
                    @include('components.admin.create-pengumuman')
                </div>
            </div>
        </div>

        {{-- Detailed Statistics --}}
        <div>
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-gray-900">Detailed Analytics</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                {{-- Total Diskusi --}}
                <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <div class="bg-amber-100 rounded-lg p-3">
                            <i class="fas fa-comments text-amber-600 text-xl"></i>
                        </div>
                        <span class="text-xs font-medium text-green-600 bg-green-100 px-2 py-1 rounded-full">+5.2%</span>
                    </div>
                    <p class="text-gray-600 text-sm font-medium">Total Diskusi</p>
                    <p class="text-2xl font-bold text-gray-900 mt-1">{{ $totalDiskusi ?? 0 }}</p>
                    <div class="mt-3 h-1 bg-gray-200 rounded-full">
                        <div class="h-1 bg-amber-500 rounded-full" style="width: 75%"></div>
                    </div>
                </div>

                {{-- Total Post --}}
                <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <div class="bg-orange-100 rounded-lg p-3">
                            <i class="fas fa-pencil-alt text-orange-600 text-xl"></i>
                        </div>
                        <span class="text-xs font-medium text-green-600 bg-green-100 px-2 py-1 rounded-full">+12.1%</span>
                    </div>
                    <p class="text-gray-600 text-sm font-medium">Total Post</p>
                    <p class="text-2xl font-bold text-gray-900 mt-1">{{ $totalPosts ?? 0 }}</p>
                    <div class="mt-3 h-1 bg-gray-200 rounded-full">
                        <div class="h-1 bg-orange-500 rounded-full" style="width: 60%"></div>
                    </div>
                </div>

                {{-- Challenge Aktif --}}
                <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <div class="bg-yellow-100 rounded-lg p-3">
                            <i class="fas fa-trophy text-yellow-600 text-xl"></i>
                        </div>
                        <span class="text-xs font-medium text-blue-600 bg-blue-100 px-2 py-1 rounded-full">Active</span>
                    </div>
                    <p class="text-gray-600 text-sm font-medium">Challenge Aktif</p>
                    <p class="text-2xl font-bold text-gray-900 mt-1">{{ $activeChallenges ?? 0 }}</p>
                    <div class="mt-3 h-1 bg-gray-200 rounded-full">
                        <div class="h-1 bg-yellow-500 rounded-full" style="width: 45%"></div>
                    </div>
                </div>

                {{-- Pengumuman --}}
                <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <div class="bg-amber-100 rounded-lg p-3">
                            <i class="fas fa-bullhorn text-amber-600 text-xl"></i>
                        </div>
                        <span class="text-xs font-medium text-gray-600 bg-gray-100 px-2 py-1 rounded-full">Recent</span>
                    </div>
                    <p class="text-gray-600 text-sm font-medium">Pengumuman</p>
                    <p class="text-2xl font-bold text-gray-900 mt-1">{{ $leaderboardCount ?? 0 }}</p>
                    <div class="mt-3 h-1 bg-gray-200 rounded-full">
                        <div class="h-1 bg-amber-500 rounded-full" style="width: 85%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
