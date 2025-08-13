@extends('layouts.admin.app')

@section('title', 'Tambah User')

@section('content')
    <div class="bg-white shadow-md rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-6">Tambah User</h1>

        {{-- Tampilkan error validasi --}}
        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf

            {{-- Nama Lengkap --}}
            <div class="mb-4">
                <label for="nama_lengkap" class="block text-gray-700 font-medium mb-2">Nama Lengkap</label>
                <input id="nama_lengkap" type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}"
                    class="w-full p-2 border rounded-lg focus:ring focus:ring-amber-300" required>
            </div>

            {{-- Username --}}
            <div class="mb-4">
                <label for="username" class="block text-gray-700 font-medium mb-2">Username</label>
                <input id="username" type="text" name="username" value="{{ old('username') }}"
                    class="w-full p-2 border rounded-lg focus:ring focus:ring-amber-300" required>
            </div>

            {{-- Password --}}
            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-medium mb-2">Password</label>
                <input id="password" type="password" name="password"
                    class="w-full p-2 border rounded-lg focus:ring focus:ring-amber-300" required>
            </div>

            {{-- Konfirmasi Password --}}
            <div class="mb-4">
                <label for="password_confirmation" class="block text-gray-700 font-medium mb-2">Konfirmasi Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation"
                    class="w-full p-2 border rounded-lg focus:ring focus:ring-amber-300" required>
            </div>

            {{-- Role --}}
            <div class="mb-4">
                <label for="role_id" class="block text-gray-700 font-medium mb-2">Role</label>
                <select id="role_id" name="role_id" class="w-full p-2 border rounded-lg focus:ring focus:ring-amber-300"
                    required>
                    <option value="">-- Pilih Role --</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->nama_role }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Field Guru --}}
            <div id="guru-fields" class="hidden">
                <div class="mb-4">
                    <label for="nip" class="block text-gray-700 font-medium mb-2">NIP</label>
                    <input id="nip" type="text" name="nip" value="{{ old('nip') }}"
                        class="w-full p-2 border rounded-lg focus:ring focus:ring-amber-300">
                </div>

                <div class="mb-4">
                    <label for="mata_pelajaran" class="block text-gray-700 font-medium mb-2">Mata Pelajaran</label>
                    <input id="mata_pelajaran" type="text" name="mata_pelajaran" value="{{ old('mata_pelajaran') }}"
                        class="w-full p-2 border rounded-lg focus:ring focus:ring-amber-300">
                </div>
            </div>

            {{-- Field Siswa --}}
            <div id="siswa-fields" class="hidden">
                <div class="mb-4">
                    <label for="nis" class="block text-gray-700 font-medium mb-2">NIS</label>
                    <input id="nis" type="text" name="nis" value="{{ old('nis') }}"
                        class="w-full p-2 border rounded-lg focus:ring focus:ring-amber-300">
                </div>

                <div class="mb-4">
                    <label for="kelas_id" class="block text-gray-700 font-medium mb-2">Kelas</label>
                    <select id="kelas_id" name="kelas_id"
                        class="w-full p-2 border rounded-lg focus:ring focus:ring-amber-300">
                        <option value="">-- Pilih Kelas --</option>
                        @foreach ($kelases as $kelas)
                            <option value="{{ $kelas->id }}" {{ old('kelas_id') == $kelas->id ? 'selected' : '' }}>
                                {{ $kelas->nama_kelas }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="jurusan_id" class="block text-gray-700 font-medium mb-2">Jurusan</label>
                    <select id="jurusan_id" name="jurusan_id"
                        class="w-full p-2 border rounded-lg focus:ring focus:ring-amber-300">
                        <option value="">-- Pilih Jurusan --</option>
                        @foreach ($jurusans as $jurusan)
                            <option value="{{ $jurusan->id }}" {{ old('jurusan_id') == $jurusan->id ? 'selected' : '' }}>
                                {{ $jurusan->nama_jurusan }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Tombol Simpan --}}
            <div class="flex justify-end">
                <a href="{{ route('admin.users.index') }}" class="px-4 py-2 bg-gray-300 rounded-lg mr-2">Batal</a>
                <button type="submit"
                    class="px-4 py-2 bg-amber-500 text-white rounded-lg hover:bg-amber-600">Simpan</button>
            </div>
        </form>
    </div>

    {{-- Script untuk menampilkan field sesuai role --}}
    <script>
        document.getElementById('role_id').addEventListener('change', function() {
            let guruFields = document.getElementById('guru-fields');
            let siswaFields = document.getElementById('siswa-fields');

            guruFields.classList.add('hidden');
            siswaFields.classList.add('hidden');

            let selectedRole = this.options[this.selectedIndex].text.toLowerCase();

            if (selectedRole === 'guru') {
                guruFields.classList.remove('hidden');
            } else if (selectedRole === 'siswa') {
                siswaFields.classList.remove('hidden');
            }
        });
    </script>
@endsection
