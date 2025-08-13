@extends('layouts.admin.app', [
    'hideHeader' => true,
    'hideSidebarRight' => true
])

@section('title', 'Manajemen User')

@section('content')
<div class="space-y-6">

    {{-- Judul Halaman --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between border-b border-gray-200 pb-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Manajemen User</h1>
            <p class="text-gray-600 mt-1">Kelola semua pengguna sistem INSEKTA dengan mudah.</p>
        </div>
        <div class="mt-4 sm:mt-0">
            <a href="{{ route('admin.users.create') }}"
                class="inline-flex items-center px-5 py-2.5 bg-primary-600 text-white rounded-lg shadow hover:bg-primary-700 transition-all duration-200">
                <i class="fas fa-plus mr-2"></i>
                Tambah User
            </a>
        </div>
    </div>

    {{-- Alert --}}
    @if (session('success'))
        <div class="alert-auto-hide bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg flex items-center shadow-sm">
            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert-auto-hide bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg flex items-center shadow-sm">
            <i class="fas fa-exclamation-circle mr-2"></i> {{ session('error') }}
        </div>
    @endif

    {{-- Filter & Search --}}
    <div class="bg-white rounded-lg shadow p-5 border border-gray-100">
        <form method="GET" action="{{ route('admin.users.index') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4" id="filterForm">
            {{-- Search --}}
            <div>
                <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Cari User</label>
                <input type="text" name="search" id="search" value="{{ request('search') }}"
                    placeholder="Cari berdasarkan username atau nama..."
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
            </div>

            {{-- Role --}}
            <div>
                <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Filter Role</label>
                <select name="role" id="role"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                    <option value="">Semua Role</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}" {{ request('role') == $role->id ? 'selected' : '' }}>
                            {{ ucfirst($role->nama_role) }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Button --}}
            <div class="flex items-end">
                <button type="submit"
                    class="w-full px-4 py-2 bg-primary-600 text-white rounded-lg shadow hover:bg-primary-700 transition-colors duration-200">
                    <i class="fas fa-search mr-2"></i>Cari
                </button>
            </div>
        </form>
    </div>

    {{-- Data Table --}}
    <div class="bg-white rounded-lg shadow border border-gray-100">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">#</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">User</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Username</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Role</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Tanggal Dibuat</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($users as $user)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-6 py-4 text-sm text-gray-900">
                                {{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-primary-500 rounded-full flex items-center justify-center text-white font-semibold mr-3">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div>
                                        <div class="font-medium text-gray-900">{{ $user->nama_lengkap }}</div>
                                        <div class="text-xs text-gray-500">ID: {{ $user->id }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm">{{ $user->username }}</td>
                            <td class="px-6 py-4">
                                @if ($user->role)
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full
                                        @if ($user->role->nama_role == 'admin') bg-red-100 text-red-800
                                        @elseif($user->role->nama_role == 'guru') bg-yellow-100 text-yellow-800
                                        @else bg-blue-100 text-blue-800 @endif">
                                        {{ ucfirst($user->role->nama_role) }}
                                    </span>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $user->created_at->format('d M Y') }}</td>
                            <td class="px-6 py-4 text-right space-x-3">
                                <a href="{{ route('admin.users.edit', $user->id) }}"
                                    class="text-primary-600 hover:text-primary-900">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @if ($user->id !== auth()->id())
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900"
                                            onclick="return confirm('Yakin ingin menghapus user {{ $user->username }}?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                <i class="fas fa-users text-4xl mb-4 text-gray-300"></i>
                                <p>Tidak ada data user yang ditemukan.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if ($users->hasPages())
            <div class="px-4 py-3 border-t border-gray-200 bg-gray-50">
                {{ $users->links() }}
            </div>
        @endif
    </div>
</div>

{{-- Auto submit filter --}}
<script>
    document.getElementById('role').addEventListener('change', function () {
        this.form.submit();
    });
</script>
@endsection
