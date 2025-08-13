@extends('layouts.admin.app')

@section('title', 'Daftar Challenge')

@section('content')
<div class="p-4 sm:p-6 lg:p-8">
    <!-- Replaced standalone HTML with admin layout extension -->
    <!-- Header Section -->
    <div class="mb-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div class="flex items-center">
                <div class="inline-flex items-center justify-center w-10 h-10 bg-primary-amber rounded-lg mr-3">
                    <i class="fas fa-trophy text-white text-lg"></i>
                </div>
                <div>
                    <h1 class="text-xl sm:text-2xl font-bold text-gray-800">Daftar Challenge</h1>
                    <p class="text-sm text-gray-600">Kelola semua challenge yang tersedia</p>
                </div>
            </div>
            <a href="{{ route('admin.challenge.create') }}"
                class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-primary-amber to-orange-500 text-white rounded-lg hover:from-orange-500 hover:to-primary-amber transition-all duration-300 font-medium shadow-md hover:shadow-lg text-sm">
                <i class="fas fa-plus mr-2"></i>Tambah Challenge
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        @if ($challenges->isEmpty())
            <!-- Empty State -->
            <div class="text-center py-12">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 rounded-full mb-4">
                    <i class="fas fa-trophy text-2xl text-gray-400"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Belum Ada Challenge</h3>
                <p class="text-gray-600 mb-4 text-sm">Mulai buat challenge pertama untuk meningkatkan engagement</p>
                <a href="{{ route('admin.challenge.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-primary-amber text-white rounded-lg hover:bg-orange-500 transition-all duration-300 font-medium text-sm">
                    <i class="fas fa-plus mr-2"></i>Buat Challenge Pertama
                </a>
            </div>
        @else
            <!-- Table Header -->
            <div class="bg-gradient-to-r from-primary-amber to-orange-500 p-4">
                <h2 class="text-lg font-semibold text-white flex items-center">
                    <i class="fas fa-list mr-2"></i>
                    Semua Challenge ({{ $challenges->count() }})
                </h2>
            </div>

            <!-- Desktop Table View -->
            <div class="hidden lg:block overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-amber-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700">#</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700">Challenge</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700">Deskripsi</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700">Reward</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700">Status</th>
                            <th class="px-4 py-3 text-center text-xs font-semibold text-gray-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($challenges as $index => $challenge)
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $index + 1 }}</td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-primary-amber rounded-lg flex items-center justify-center mr-3">
                                            <i class="fas fa-trophy text-white text-xs"></i>
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-800 text-sm">{{ $challenge->judul }}</p>
                                            <p class="text-xs text-gray-500">{{ $challenge->poin ?? 0 }} XP</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-600 max-w-xs">
                                    {{ Str::limit($challenge->deskripsi, 60) }}
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-600">
                                    {{ $challenge->reward ?? 'Badge' }}
                                </td>
                                <td class="px-4 py-3">
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <i class="fas fa-circle text-green-400 mr-1" style="font-size: 4px;"></i>
                                        Aktif
                                    </span>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center justify-center space-x-1">
                                        <a href="{{ route('admin.challenge.show', $challenge->id) }}"
                                            class="p-1.5 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition-colors duration-200"
                                            title="Lihat Detail">
                                            <i class="fas fa-eye text-xs"></i>
                                        </a>
                                        <a href="{{ route('admin.challenge.edit', $challenge->id) }}"
                                            class="p-1.5 bg-yellow-500 text-white rounded-md hover:bg-yellow-600 transition-colors duration-200"
                                            title="Edit Challenge">
                                            <i class="fas fa-edit text-xs"></i>
                                        </a>
                                        <form action="{{ route('admin.challenge.destroy', $challenge->id) }}" method="POST" class="inline"
                                            onsubmit="return confirm('Yakin ingin menghapus challenge ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-1.5 bg-red-500 text-white rounded-md hover:bg-red-600 transition-colors duration-200"
                                                title="Hapus Challenge">
                                                <i class="fas fa-trash text-xs"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Mobile Card View -->
            <div class="lg:hidden p-4 space-y-3">
                @foreach ($challenges as $index => $challenge)
                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                        <div class="flex items-start justify-between mb-3">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-primary-amber rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-trophy text-white text-sm"></i>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-800 text-sm">{{ $challenge->judul }}</h3>
                                    <p class="text-xs text-gray-500">{{ $challenge->poin ?? 0 }} XP</p>
                                </div>
                            </div>
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Aktif
                            </span>
                        </div>
                        
                        <p class="text-sm text-gray-600 mb-3">{{ Str::limit($challenge->deskripsi, 80) }}</p>
                        
                        <div class="flex items-center justify-between">
                            <p class="text-xs text-gray-500">Reward: {{ $challenge->reward ?? 'Badge' }}</p>
                            <div class="flex space-x-1">
                                <a href="{{ route('admin.challenge.show', $challenge->id) }}"
                                    class="p-1.5 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition-colors duration-200">
                                    <i class="fas fa-eye text-xs"></i>
                                </a>
                                <a href="{{ route('admin.challenge.edit', $challenge->id) }}"
                                    class="p-1.5 bg-yellow-500 text-white rounded-md hover:bg-yellow-600 transition-colors duration-200">
                                    <i class="fas fa-edit text-xs"></i>
                                </a>
                                <form action="{{ route('admin.challenge.destroy', $challenge->id) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Yakin ingin menghapus challenge ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="p-1.5 bg-red-500 text-white rounded-md hover:bg-red-600 transition-colors duration-200">
                                        <i class="fas fa-trash text-xs"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
