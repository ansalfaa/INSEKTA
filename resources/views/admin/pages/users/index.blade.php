@extends('layouts.admin.app', [
    'hideHeader' => true,
    'hideSidebarRight' => true,
])

@section('title', 'Manajemen User')

@section('content')
    <div class="space-y-6 font-poppins">



        {{-- Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between border-b border-gray-200 pb-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Manajemen User</h1>
                <p class="text-gray-600 mt-1">Kelola semua pengguna sistem INSEKTA dengan mudah.</p>
            </div>
            <div class="mt-4 sm:mt-0">
                <button onclick="openUserModal()"
                    class="inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-primary-amber to-orange-500 text-white rounded-lg shadow hover:from-orange-500 hover:to-primary-amber transition-all duration-300">
                    <i class="fas fa-user-plus mr-2"></i>
                    Tambah User
                </button>
            </div>
        </div>

        {{-- Statistik --}}
        <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
            {{-- Total User --}}
            <div class="stat-card" data-role="">
                <div class="w-10 h-10 flex items-center justify-center rounded-full bg-amber-100 text-amber-600 mr-3">
                    <i class="fas fa-users"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Total User</p>
                    <p class="text-lg font-semibold text-gray-900">{{ $totalUsers }}</p>
                </div>
            </div>
            {{-- Admin --}}
            <div class="stat-card" data-role="admin">
                <div class="w-10 h-10 flex items-center justify-center rounded-full bg-red-100 text-red-600 mr-3">
                    <i class="fas fa-user-shield"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Admin</p>
                    <p class="text-lg font-semibold">{{ $rolesCount['admin'] ?? 0 }}</p>
                </div>
            </div>
            {{-- Guru --}}
            <div class="stat-card" data-role="guru">
                <div class="w-10 h-10 flex items-center justify-center rounded-full bg-yellow-100 text-yellow-600 mr-3">
                    <i class="fas fa-chalkboard-teacher"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Guru</p>
                    <p class="text-lg font-semibold">{{ $rolesCount['guru'] ?? 0 }}</p>
                </div>
            </div>
            {{-- Siswa --}}
            <div class="stat-card" data-role="siswa">
                <div class="w-10 h-10 flex items-center justify-center rounded-full bg-blue-100 text-blue-600 mr-3">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Siswa</p>
                    <p class="text-lg font-semibold">{{ $rolesCount['siswa'] ?? 0 }}</p>
                </div>
            </div>
        </div>

        {{-- Filter & Search --}}
        <div class="bg-white rounded-xl shadow p-5 border border-gray-100" id="filterContainer">
            <form method="GET" action="{{ route('admin.users.index') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4"
                id="filterForm">
                {{-- Search --}}
                <div>
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Cari User</label>
                    <input type="text" name="search" id="search" value="{{ request('search') }}"
                        placeholder="Cari berdasarkan username atau nama..."
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                </div>

                {{-- Role --}}
                <div>
                    <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Filter Role</label>
                    <select name="role" id="role"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                        <option value="">Semua Role</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->nama_role }}"
                                {{ request('role') == $role->nama_role ? 'selected' : '' }}>
                                {{ ucfirst($role->nama_role) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Dropdown jurusan & kelas (muncul kalau siswa) --}}
                <div id="siswaFilters" class="hidden md:col-span-3 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="jurusan" class="block text-sm font-medium text-gray-700 mb-1">Jurusan</label>
                        <select name="jurusan" id="jurusan"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                            <option value="">Semua Jurusan</option>
                            @foreach ($jurusans as $j)
                                <option value="{{ $j->id }}" {{ request('jurusan') == $j->id ? 'selected' : '' }}>
                                    {{ $j->nama_jurusan }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="kelas" class="block text-sm font-medium text-gray-700 mb-1">Kelas</label>
                        <select name="kelas" id="kelas"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                            <option value="">Semua Kelas</option>
                            @foreach ($kelases as $k)
                                <option value="{{ $k->id }}" {{ request('kelas') == $k->id ? 'selected' : '' }}>
                                    {{ $k->nama_kelas }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Button --}}
                <div class="flex items-end">
                    <button type="submit"
                        class="w-full px-4 py-2 bg-amber-500 text-white rounded-lg shadow hover:bg-amber-600 transition-colors duration-200">
                        <i class="fas fa-search mr-2"></i>Cari
                    </button>
                </div>
            </form>
        </div>

        {{-- Tabel Data --}}
        <div class="bg-white rounded-xl shadow border border-gray-100 hidden sm:block">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">#</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">User</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Username</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Role</th>

                            @if (request('role') == 'guru')
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">NIP</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Mata Pelajaran
                                </th>
                            @elseif(request('role') == 'siswa')
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">NIS</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Kelas</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Jurusan</th>
                            @endif

                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Tanggal Dibuat
                            </th>
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
                                        <div
                                            class="w-10 h-10 bg-amber-500 rounded-full flex items-center justify-center text-white font-semibold mr-3">
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
                                        <span
                                            class="px-2 py-1 text-xs font-semibold rounded-full 
                                        @if ($user->role->nama_role == 'admin') bg-red-100 text-red-800 
                                        @elseif($user->role->nama_role == 'guru') bg-yellow-100 text-yellow-800 
                                        @else bg-blue-100 text-blue-800 @endif">
                                            {{ ucfirst($user->role->nama_role) }}
                                        </span>
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>

                                @if (request('role') == 'guru')
                                    <td class="px-6 py-4 text-sm text-gray-500">{{ $user->guru->nip ?? '-' }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-500">{{ $user->guru->mata_pelajaran ?? '-' }}
                                    </td>
                                @elseif(request('role') == 'siswa')
                                    <td class="px-6 py-4 text-sm text-gray-500">{{ $user->siswa->nis ?? '-' }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        {{ $user->siswa->kelas->nama_kelas ?? '-' }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        {{ $user->siswa->jurusan->nama_jurusan ?? '-' }}</td>
                                @endif

                                <td class="px-6 py-4 text-sm text-gray-500">{{ $user->created_at->format('d M Y') }}</td>
                                <td class="px-6 py-4 text-right space-x-3">

                                    {{-- Tombol Edit --}}
                                    @if (
                                        $user->role_id !== \App\Http\Controllers\Admin\UserController::ROLE_SUPER_ADMIN ||
                                            auth()->user()->role_id === \App\Http\Controllers\Admin\UserController::ROLE_SUPER_ADMIN)
                                        <button type="button" onclick='openEditModal(@json($user))'
                                            class="text-amber-600 hover:text-amber-800">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    @endif

                                    {{-- Tombol Hapus --}}
                                    @if (
                                        $user->id !== auth()->id() &&
                                            ($user->role_id !== \App\Http\Controllers\Admin\UserController::ROLE_SUPER_ADMIN ||
                                                auth()->user()->role_id === \App\Http\Controllers\Admin\UserController::ROLE_SUPER_ADMIN))
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800"
                                                onclick="return confirm('Yakin ingin menghapus user {{ $user->username }}?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-12 text-center text-gray-500">
                                    <i class="fas fa-users text-4xl mb-4 text-gray-300"></i>
                                    <p>Tidak ada data user yang ditemukan.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Modal Create --}}
    <div id="createUserModal" class="fixed inset-0 bg-black/50 hidden flex items-center justify-center z-50">
        @include('admin.pages.users.create')
    </div>

    {{-- Modal Edit --}}
    <div id="editUserModal" class="fixed inset-0 bg-black/50 hidden flex items-center justify-center z-50">
        @include('admin.pages.users.edit')
    </div>
@endsection

@push('scripts')
    <script>
        // Modal
        function openUserModal() {
            document.getElementById('createUserModal').classList.remove('hidden');
            document.getElementById('createUserModal').classList.add('flex');
        }

        function closeUserModal() {
            document.getElementById('createUserModal').classList.add('hidden');
            document.getElementById('createUserModal').classList.remove('flex');
        }

        // Statistik klik → filter otomatis
        document.querySelectorAll('.stat-card').forEach(card => {
            card.addEventListener('click', () => {
                let role = card.dataset.role;
                document.getElementById('role').value = role;
                document.getElementById('filterForm').submit();
            });
        });

        // Tampilkan filter jurusan/kelas jika role siswa
        function toggleSiswaFilters() {
            const role = document.getElementById('role').value;
            const siswaFilters = document.getElementById('siswaFilters');
            if (role === 'siswa') {
                siswaFilters.classList.remove('hidden');
            } else {
                siswaFilters.classList.add('hidden');
            }
        }
        document.getElementById('role').addEventListener('change', function() {
            toggleSiswaFilters();
            document.getElementById('filterForm').submit(); // auto submit role
        });
        toggleSiswaFilters();

        // Auto submit saat jurusan/kelas berubah
        const jurusanSelect = document.getElementById('jurusan');
        const kelasSelect = document.getElementById('kelas');

        if (jurusanSelect) {
            jurusanSelect.addEventListener('change', function() {
                document.getElementById('filterForm').submit();
            });
        }

        if (kelasSelect) {
            kelasSelect.addEventListener('change', function() {
                document.getElementById('filterForm').submit();
            });
        }

        toggleSiswaFilters();

        // Auto search dengan debounce
        let searchTimer;
        document.getElementById('search').addEventListener('input', function() {
            clearTimeout(searchTimer);
            searchTimer = setTimeout(() => {
                document.getElementById('filterForm').submit();
            }, 500);
        });

        function openEditModal(user) {
            document.getElementById('editUserId').value = user.id;
            document.getElementById('editNama').value = user.nama_lengkap;
            document.getElementById('editUsername').value = user.username;
            document.getElementById('editRole').value = user.role_id;

            document.getElementById('editUserForm').action = '/admin/users/' + user.id;

            if (user.role_id == 3) {
                document.getElementById('guru-fields-edit').classList.remove('hidden');
                document.getElementById('editNip').value = user.guru?.nip || '';
                document.getElementById('editMapel').value = user.guru?.mata_pelajaran || '';
            } else {
                document.getElementById('guru-fields-edit').classList.add('hidden');
            }

            if (user.role_id == 4) {
                document.getElementById('siswa-fields-edit').classList.remove('hidden');
                document.getElementById('editNis').value = user.siswa?.nis || '';
                document.getElementById('editKelas').value = user.siswa?.kelas_id || '';
                document.getElementById('editJurusan').value = user.siswa?.jurusan_id || '';
            } else {
                document.getElementById('siswa-fields-edit').classList.add('hidden');
            }

            document.getElementById('editUserModal').classList.remove('hidden');
            document.getElementById('editUserModal').classList.add('flex');
        }
    </script>
@endpush
