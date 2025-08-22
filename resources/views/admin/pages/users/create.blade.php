<div class="p-4 sm:p-6 lg:p-8 w-full max-w-3xl mx-auto">
    <!-- Form Card -->
    <div class="bg-white rounded-xl shadow-lg flex flex-col max-h-[90vh] overflow-hidden">
        <!-- Header -->
        <div class="bg-gradient-to-r from-primary-amber to-orange-500 p-4 rounded-t-xl">
            <h2 class="text-lg font-semibold text-white flex items-center">
                <i class="fas fa-bullhorn mr-2"></i>
                Form Tambah Pengumuman
            </h2>
        </div>

        <!-- Scrollable Form -->
        <div class="flex-1 overflow-y-auto p-4 sm:p-6 space-y-4">
            <form action="{{ route('admin.pengumuman.store') }}" method="POST" class="space-y-4">
                @csrf

                <!-- Judul -->
                <div>
                    <label class="flex items-center text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-heading text-primary-amber mr-2"></i>
                        Judul Pengumuman
                    </label>
                    <input type="text" name="judul" value="{{ old('judul') }}"
                        placeholder="Masukkan judul pengumuman..."
                        class="w-full px-3 py-2.5 rounded-lg border-2 border-gray-200 
                               focus:border-primary-amber focus:ring-2 focus:ring-primary-amber/20 
                               transition-all duration-300 outline-none text-sm"
                        required>
                    @error('judul')
                        <p class="text-sm text-red-500 mt-1 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Isi Pengumuman -->
                <div>
                    <label class="flex items-center text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-file-alt text-primary-amber mr-2"></i>
                        Isi Pengumuman
                    </label>
                    <textarea name="isi" rows="6" placeholder="Tulis isi pengumuman..."
                        class="w-full px-3 py-2.5 rounded-lg border-2 border-gray-200 
                               focus:border-primary-amber focus:ring-2 focus:ring-primary-amber/20 
                               transition-all duration-300 outline-none text-sm"
                        required>{{ old('isi') }}</textarea>
                    @error('isi')
                        <p class="text-sm text-red-500 mt-1 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Tanggal Pengumuman -->
                <div>
                    <label class="flex items-center text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-calendar-alt text-primary-amber mr-2"></i>
                        Tanggal Pengumuman
                    </label>
                    <input type="date" name="tanggal" value="{{ old('tanggal') }}"
                        class="w-full px-3 py-2.5 rounded-lg border-2 border-gray-200 
                               focus:border-primary-amber focus:ring-2 focus:ring-primary-amber/20 
                               transition-all duration-300 outline-none text-sm"
                        required>
                    @error('tanggal')
                        <p class="text-sm text-red-500 mt-1 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row justify-end gap-3 mt-6 pt-4 border-t border-gray-200">
                    <button type="button" onclick="closePengumumanModal()"
                        class="px-4 py-2.5 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors duration-200">
                        <i class="fas fa-times mr-2"></i>Batal
                    </button>
                    <button type="submit"
                        class="px-6 py-2.5 rounded-lg bg-gradient-to-r from-primary-amber to-orange-500 
                               text-white hover:from-orange-500 hover:to-primary-amber transition-all duration-300 
                               font-semibold shadow-md hover:shadow-lg text-sm">
                        <i class="fas fa-save mr-2"></i>Simpan Pengumuman
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


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
