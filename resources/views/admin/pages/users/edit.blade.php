<div class="p-4 sm:p-6 lg:p-8 w-full max-w-3xl mx-auto">
    <div class="bg-white rounded-xl shadow-lg flex flex-col max-h-[90vh] overflow-hidden">
        
        <!-- Header -->
        <div class="bg-gradient-to-r from-primary-amber to-orange-500 p-4 rounded-t-xl">
            <h2 class="text-lg font-semibold text-white flex items-center">
                <i class="fas fa-user-edit mr-2"></i>
                Form Edit User
            </h2>
        </div>

        <!-- Scrollable Form -->
        <div class="flex-1 overflow-y-auto p-4 sm:p-6 space-y-4">
            @if(isset($user))
                <form id="editUserForm" action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <input type="hidden" id="editUserId" name="id" value="{{ $user->id }}">

                    <!-- Nama Lengkap & Username -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="flex items-center text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-id-card text-primary-amber mr-2"></i>
                                Nama Lengkap
                            </label>
                            <input type="text" id="editNama" name="nama_lengkap"
                                value="{{ old('nama_lengkap', $user->nama_lengkap) }}"
                                class="w-full px-3 py-2.5 rounded-lg border-2 border-gray-200 
                                       focus:border-primary-amber focus:ring-2 focus:ring-primary-amber/20 
                                       transition-all duration-300 outline-none text-sm"
                                required>
                        </div>
                        <div>
                            <label class="flex items-center text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-user text-primary-amber mr-2"></i>
                                Username
                            </label>
                            <input type="text" id="editUsername" name="username"
                                value="{{ old('username', $user->username) }}"
                                class="w-full px-3 py-2.5 rounded-lg border-2 border-gray-200 
                                       focus:border-primary-amber focus:ring-2 focus:ring-primary-amber/20 
                                       transition-all duration-300 outline-none text-sm"
                                required>
                        </div>
                    </div>

                    <!-- Password (opsional) -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="flex items-center text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-lock text-primary-amber mr-2"></i>
                                Password (Kosongkan jika tidak diubah)
                            </label>
                            <input type="password" name="password"
                                class="w-full px-3 py-2.5 rounded-lg border-2 border-gray-200 
                                       focus:border-primary-amber focus:ring-2 focus:ring-primary-amber/20 
                                       transition-all duration-300 outline-none text-sm">
                        </div>
                        <div>
                            <label class="flex items-center text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-lock text-primary-amber mr-2"></i>
                                Konfirmasi Password
                            </label>
                            <input type="password" name="password_confirmation"
                                class="w-full px-3 py-2.5 rounded-lg border-2 border-gray-200 
                                       focus:border-primary-amber focus:ring-2 focus:ring-primary-amber/20 
                                       transition-all duration-300 outline-none text-sm">
                        </div>
                    </div>

                    <!-- Role -->
                    <div>
                        <label class="flex items-center text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-users-cog text-primary-amber mr-2"></i>
                            Role
                        </label>
                        <select id="editRole" name="role_id"
                            class="w-full px-3 py-2.5 rounded-lg border-2 border-gray-200 
                                   focus:border-primary-amber focus:ring-2 focus:ring-primary-amber/20 
                                   transition-all duration-300 outline-none text-sm"
                            required>
                            <option value="">-- Pilih Role --</option>
                            @foreach ($roles->where('nama_role', '!=', 'super_admin') as $role)
                                <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                    {{ $role->nama_role }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Guru Fields -->
                    <div id="guru-fields-edit"
                        class="{{ $user->role_id == 3 ? '' : 'hidden' }} grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label>NIP</label>
                            <input type="text" id="editNip" name="nip"
                                value="{{ old('nip', $user->guru->nip ?? '') }}"
                                class="w-full px-3 py-2.5 rounded-lg border-2 border-gray-200">
                        </div>
                        <div>
                            <label>Mata Pelajaran</label>
                            <input type="text" id="editMapel" name="mata_pelajaran"
                                value="{{ old('mata_pelajaran', $user->guru->mata_pelajaran ?? '') }}"
                                class="w-full px-3 py-2.5 rounded-lg border-2 border-gray-200">
                        </div>
                    </div>

                    <!-- Siswa Fields -->
                    <div id="siswa-fields-edit"
                        class="{{ $user->role_id == 4 ? '' : 'hidden' }} grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label>NIS</label>
                            <input type="text" id="editNis" name="nis"
                                value="{{ old('nis', $user->siswa->nis ?? '') }}"
                                class="w-full px-3 py-2.5 rounded-lg border-2 border-gray-200">
                        </div>
                        <div>
                            <label>Kelas</label>
                            <select id="editKelas" name="kelas_id"
                                class="w-full px-3 py-2.5 rounded-lg border-2 border-gray-200">
                                <option value="">-- Pilih Kelas --</option>
                                @foreach ($kelases as $kelas)
                                    <option value="{{ $kelas->id }}"
                                        {{ isset($user->siswa) && $user->siswa->kelas_id == $kelas->id ? 'selected' : '' }}>
                                        {{ $kelas->nama_kelas }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label>Jurusan</label>
                            <select id="editJurusan" name="jurusan_id"
                                class="w-full px-3 py-2.5 rounded-lg border-2 border-gray-200">
                                <option value="">-- Pilih Jurusan --</option>
                                @foreach ($jurusans as $jurusan)
                                    <option value="{{ $jurusan->id }}"
                                        {{ isset($user->siswa) && $user->siswa->jurusan_id == $jurusan->id ? 'selected' : '' }}>
                                        {{ $jurusan->nama_jurusan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex justify-end gap-3 mt-6 pt-4 border-t border-gray-200">
                        <button type="button" onclick="closeEditModal()" class="px-4 py-2 bg-gray-200 rounded-lg">
                            Batal
                        </button>
                        <button type="submit"
                            class="px-6 py-2 rounded-lg bg-gradient-to-r from-primary-amber to-orange-500 text-white">
                            Update User
                        </button>
                    </div>
                </form>
            @else
                <div class="p-4 bg-red-100 text-red-700 rounded-lg text-center">
                    User tidak ditemukan.
                </div>
            @endif
        </div>
    </div>
</div>

<script>
    function toggleRoleFieldsEdit() {
        let roleSelect = document.getElementById('editRole');
        let guruFields = document.getElementById('guru-fields-edit');
        let siswaFields = document.getElementById('siswa-fields-edit');

        guruFields.classList.add('hidden');
        siswaFields.classList.add('hidden');

        let selectedRole = parseInt(roleSelect.value);
        if (selectedRole === 3) guruFields.classList.remove('hidden'); // Guru
        else if (selectedRole === 4) siswaFields.classList.remove('hidden'); // Siswa
    }

    document.getElementById('editRole')?.addEventListener('change', toggleRoleFieldsEdit);
    window.addEventListener('load', toggleRoleFieldsEdit);
</script>
