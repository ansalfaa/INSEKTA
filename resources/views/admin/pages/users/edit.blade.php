@extends('layouts.admin.app')

@section('title', 'Edit User')
@section('page-title', 'Edit User')

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-lg shadow-md p-6">
            {{-- Judul Halaman --}}
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-900">Edit User</h1>
                <p class="text-gray-600 mt-1">Perbarui informasi user {{ $user->username }}</p>
            </div>

            {{-- Form Update User --}}
            <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                {{-- Nama Lengkap --}}
                <div>
                    <label for="nama_lengkap" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap *</label>
                    <input type="text" name="nama_lengkap" id="nama_lengkap"
                        value="{{ old('nama_lengkap', $user->nama_lengkap) }}" required
                        class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('nama_lengkap') border-red-500 @enderror"
                        placeholder="Masukkan nama lengkap">
                    @error('nama_lengkap')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Username --}}
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username *</label>
                    <input type="text" name="username" id="username" value="{{ old('username', $user->username) }}"
                        required
                        class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('username') border-red-500 @enderror"
                        placeholder="Masukkan username">
                    @error('username')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Pilihan Role --}}
                <div>
                    <label for="role_id" class="block text-sm font-medium text-gray-700 mb-1">Role *</label>
                    <select name="role_id" id="role" required
                        class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('role_id') border-red-500 @enderror">
                        <option value="">Pilih Role</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}"
                                {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>
                                {{ ucfirst($role->nama_role) }}
                            </option>
                        @endforeach
                    </select>
                    @error('role_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password Baru --}}
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password Baru</label>
                    <input type="password" name="password" id="password"
                        class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('password') border-red-500 @enderror"
                        placeholder="Kosongkan jika tidak ingin mengubah password">
                    <p class="mt-1 text-sm text-gray-500">Kosongkan jika tidak ingin mengubah password</p>
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Konfirmasi Password --}}
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi
                        Password Baru</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                        placeholder="Konfirmasi password baru">
                </div>

                {{-- Field Guru (muncul jika role Guru) --}}
                <div id="guru-fields" class="hidden">
                    <div>
                        <label for="nip" class="block text-sm font-medium text-gray-700 mb-1">NIP *</label>
                        <input type="text" name="nip" id="nip"
                            value="{{ old('nip', $user->guru->nip ?? '') }}"
                            class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('nip') border-red-500 @enderror"
                            placeholder="Masukkan NIP">
                        @error('nip')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="mata_pelajaran" class="block text-sm font-medium text-gray-700 mb-1">Mata Pelajaran
                            *</label>
                        <input type="text" name="mata_pelajaran" id="mata_pelajaran"
                            value="{{ old('mata_pelajaran', $user->guru->mata_pelajaran ?? '') }}"
                            class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('mata_pelajaran') border-red-500 @enderror"
                            placeholder="Masukkan Mata Pelajaran">
                        @error('mata_pelajaran')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Field Siswa (muncul jika role Siswa) --}}
                <div id="siswa-fields" class="hidden">
                    <div>
                        <label for="nis" class="block text-sm font-medium text-gray-700 mb-1">NIS *</label>
                        <input type="text" name="nis" id="nis"
                            value="{{ old('nis', $user->siswa->nis ?? '') }}"
                            class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('nis') border-red-500 @enderror"
                            placeholder="Masukkan NIS">
                        @error('nis')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="kelas_id" class="block text-sm font-medium text-gray-700 mb-1">Kelas *</label>
                        <select name="kelas_id" id="kelas_id" required
                            class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('kelas_id') border-red-500 @enderror">
                            <option value="">Pilih Kelas</option>
                            @foreach ($kelases as $kelas)
                                <option value="{{ $kelas->id }}"
                                    {{ old('kelas_id', $user->siswa->kelas_id ?? '') == $kelas->id ? 'selected' : '' }}>
                                    {{ $kelas->nama_kelas }}
                                </option>
                            @endforeach
                        </select>
                        @error('kelas_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="jurusan_id" class="block text-sm font-medium text-gray-700 mb-1">Jurusan *</label>
                        <select name="jurusan_id" id="jurusan_id" required
                            class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('jurusan_id') border-red-500 @enderror">
                            <option value="">Pilih Jurusan</option>
                            @foreach ($jurusans as $jurusan)
                                <option value="{{ $jurusan->id }}"
                                    {{ old('jurusan_id', $user->siswa->jurusan_id ?? '') == $jurusan->id ? 'selected' : '' }}>
                                    {{ $jurusan->nama_jurusan }}
                                </option>
                            @endforeach
                        </select>
                        @error('jurusan_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Tombol Submit --}}
                <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.users.index') }}"
                        class="px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors duration-200">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-6 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-colors duration-200">
                        <i class="fas fa-save mr-2"></i> Update User
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Script toggle field berdasarkan role --}}
    <script>
        function toggleRoleFields() {
            let roleSelect = document.getElementById('role');
            let guruFields = document.getElementById('guru-fields');
            let siswaFields = document.getElementById('siswa-fields');

            guruFields.classList.add('hidden');
            siswaFields.classList.add('hidden');

            let selectedRole = roleSelect.options[roleSelect.selectedIndex].text.toLowerCase();

            if (selectedRole === 'guru') {
                guruFields.classList.remove('hidden');
            } else if (selectedRole === 'siswa') {
                siswaFields.classList.remove('hidden');
            }
        }

        document.getElementById('role').addEventListener('change', toggleRoleFields);

        // Jalankan saat halaman pertama kali dibuka
        window.onload = toggleRoleFields;
    </script>
@endsection
