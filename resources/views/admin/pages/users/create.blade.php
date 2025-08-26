<div class="p-4 sm:p-6 lg:p-8 w-full max-w-3xl mx-auto">
    <!-- Form Card -->
    <div class="bg-white rounded-xl shadow-lg flex flex-col max-h-[90vh] overflow-hidden">
        <!-- Header -->
        <div class="bg-gradient-to-r from-primary-amber to-orange-500 p-4 rounded-t-xl">
            <h2 class="text-lg font-semibold text-white flex items-center">
                <i class="fas fa-user-plus mr-2"></i> Form Tambah User
            </h2>
        </div>

        <!-- Tambahkan error display yang lebih baik -->
        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 p-4 m-4 rounded-lg">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-exclamation-circle text-red-400"></i>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">Terdapat kesalahan:</h3>
                        <div class="mt-2 text-sm text-red-700">
                            <ul class="list-disc pl-5 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-50 border border-red-200 p-4 m-4 rounded-lg">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-exclamation-circle text-red-400"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-red-700">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Scrollable Form -->
        <div class="flex-1 overflow-y-auto p-4 sm:p-6 space-y-4">
            <form id="createUserForm" action="{{ route('admin.users.store') }}" method="POST" class="space-y-4">
                @csrf

                <!-- Nama Lengkap & Username -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="flex items-center text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-id-card text-primary-amber mr-2"></i> Nama Lengkap
                        </label>
                        <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}"
                               placeholder="Masukkan nama lengkap..."
                               class="w-full px-3 py-2.5 rounded-lg border-2 border-gray-200 
                               focus:border-primary-amber focus:ring-2 focus:ring-primary-amber/20 transition-all duration-300 outline-none text-sm"
                               required>
                        @error('nama_lengkap')
                            <p class="text-sm text-red-500 mt-1 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div>
                        <label class="flex items-center text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-user text-primary-amber mr-2"></i> Username
                        </label>
                        <input type="text" name="username" value="{{ old('username') }}"
                               placeholder="Masukkan username..."
                               class="w-full px-3 py-2.5 rounded-lg border-2 border-gray-200 
                               focus:border-primary-amber focus:ring-2 focus:ring-primary-amber/20 transition-all duration-300 outline-none text-sm"
                               required>
                        @error('username')
                            <p class="text-sm text-red-500 mt-1 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                <!-- Password & Konfirmasi -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="flex items-center text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-lock text-primary-amber mr-2"></i> Password
                        </label>
                        <input type="password" name="password" placeholder="Masukkan password..."
                               class="w-full px-3 py-2.5 rounded-lg border-2 border-gray-200 
                               focus:border-primary-amber focus:ring-2 focus:ring-primary-amber/20 transition-all duration-300 outline-none text-sm"
                               required>
                        @error('password')
                            <p class="text-sm text-red-500 mt-1 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div>
                        <label class="flex items-center text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-lock text-primary-amber mr-2"></i> Konfirmasi Password
                        </label>
                        <input type="password" name="password_confirmation" placeholder="Ulangi password..."
                               class="w-full px-3 py-2.5 rounded-lg border-2 border-gray-200 
                               focus:border-primary-amber focus:ring-2 focus:ring-primary-amber/20 transition-all duration-300 outline-none text-sm"
                               required>
                    </div>
                </div>

                <!-- Role -->
                <div>
                    <label class="flex items-center text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-users-cog text-primary-amber mr-2"></i> Role
                    </label>
                    <select id="createRole" name="role_id"
                            class="w-full px-3 py-2.5 rounded-lg border-2 border-gray-200 
                            focus:border-primary-amber focus:ring-2 focus:ring-primary-amber/20 transition-all duration-300 outline-none text-sm"
                            required>
                        <option value="">-- Pilih Role --</option>
                        @foreach ($roles->where('nama_role', '!=', 'super_admin') as $role)
                            <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                {{ $role->nama_role }}
                            </option>
                        @endforeach
                    </select>
                    @error('role_id')
                        <p class="text-sm text-red-500 mt-1 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Guru Fields -->
                <div id="guru-fields-create" class="hidden grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="flex items-center text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-id-badge text-primary-amber mr-2"></i> NIP
                        </label>
                        <input type="text" name="nip" value="{{ old('nip') }}"
                               placeholder="Masukkan NIP..."
                               class="w-full px-3 py-2.5 rounded-lg border-2 border-gray-200 
                               focus:border-primary-amber focus:ring-2 focus:ring-primary-amber/20 transition-all duration-300 outline-none text-sm">
                        @error('nip')
                            <p class="text-sm text-red-500 mt-1 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div>
                        <label class="flex items-center text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-book text-primary-amber mr-2"></i> Mata Pelajaran
                        </label>
                        <input type="text" name="mata_pelajaran" value="{{ old('mata_pelajaran') }}"
                               placeholder="Masukkan mata pelajaran..."
                               class="w-full px-3 py-2.5 rounded-lg border-2 border-gray-200 
                               focus:border-primary-amber focus:ring-2 focus:ring-primary-amber/20 transition-all duration-300 outline-none text-sm">
                        @error('mata_pelajaran')
                            <p class="text-sm text-red-500 mt-1 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                <!-- Siswa Fields -->
                <div id="siswa-fields-create" class="hidden grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="flex items-center text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-id-card-alt text-primary-amber mr-2"></i> NIS
                        </label>
                        <input type="text" name="nis" value="{{ old('nis') }}"
                               placeholder="Masukkan NIS..."
                               class="w-full px-3 py-2.5 rounded-lg border-2 border-gray-200 
                               focus:border-primary-amber focus:ring-2 focus:ring-primary-amber/20 transition-all duration-300 outline-none text-sm">
                        @error('nis')
                            <p class="text-sm text-red-500 mt-1 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div>
                        <label class="flex items-center text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-school text-primary-amber mr-2"></i> Kelas
                        </label>
                        <select name="kelas_id"
                                class="w-full px-3 py-2.5 rounded-lg border-2 border-gray-200 
                                focus:border-primary-amber focus:ring-2 focus:ring-primary-amber/20 transition-all duration-300 outline-none text-sm">
                            <option value="">-- Pilih Kelas --</option>
                            @foreach ($kelases as $kelas)
                                <option value="{{ $kelas->id }}" {{ old('kelas_id') == $kelas->id ? 'selected' : '' }}>
                                    {{ $kelas->nama_kelas }}
                                </option>
                            @endforeach
                        </select>
                        @error('kelas_id')
                            <p class="text-sm text-red-500 mt-1 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div>
                        <label class="flex items-center text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-code-branch text-primary-amber mr-2"></i> Jurusan
                        </label>
                        <select name="jurusan_id"
                                class="w-full px-3 py-2.5 rounded-lg border-2 border-gray-200 
                                focus:border-primary-amber focus:ring-2 focus:ring-primary-amber/20 transition-all duration-300 outline-none text-sm">
                            <option value="">-- Pilih Jurusan --</option>
                            @foreach ($jurusans as $jurusan)
                                <option value="{{ $jurusan->id }}" {{ old('jurusan_id') == $jurusan->id ? 'selected' : '' }}>
                                    {{ $jurusan->nama_jurusan }}
                                </option>
                            @endforeach
                        </select>
                        @error('jurusan_id')
                            <p class="text-sm text-red-500 mt-1 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row justify-end gap-3 mt-6 pt-4 border-t border-gray-200">
                    <button type="button" onclick="closeCreateUser()"
                            class="px-4 py-2.5 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors duration-200">
                        <i class="fas fa-times mr-2"></i>Batal
                    </button>
                    <!-- Tambahkan loading state pada tombol submit -->
                    <button type="submit" id="submitBtn"
                            class="px-6 py-2.5 rounded-lg bg-gradient-to-r from-primary-amber to-orange-500 text-white 
                            hover:from-orange-500 hover:to-primary-amber transition-all duration-300 font-semibold shadow-md hover:shadow-lg text-sm">
                        <i class="fas fa-save mr-2"></i>Simpan User
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function toggleFields() {
        let roleSelect = document.getElementById('createRole');
        let selectedValue = roleSelect.value;
        
        let guruFields = document.getElementById('guru-fields-create');
        let siswaFields = document.getElementById('siswa-fields-create');

        // Sembunyikan semua fields dulu
        guruFields.classList.add('hidden');
        siswaFields.classList.add('hidden');

        // Tampilkan sesuai role yang dipilih (berdasarkan value, bukan text)
        if (selectedValue == '3') { // Role Guru
            guruFields.classList.remove('hidden');
        } else if (selectedValue == '4') { // Role Siswa
            siswaFields.classList.remove('hidden');
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const roleSelect = document.getElementById('createRole');
        const form = document.getElementById('createUserForm');
        const submitBtn = document.getElementById('submitBtn');
        
        // Toggle fields saat role berubah
        roleSelect.addEventListener('change', toggleFields);
        
        // Panggil sekali saat load untuk handle old() values
        toggleFields();
        
        form.addEventListener('submit', function(e) {
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Menyimpan...';
        });
    });
</script>
