<div class="p-4 sm:p-6 lg:p-8 w-full max-w-3xl mx-auto">
    <!-- Form Card -->
    <div class="bg-white rounded-xl shadow-lg flex flex-col max-h-[90vh] overflow-hidden">
            
            <!-- Header -->
            <div class="bg-gradient-to-r from-primary-amber to-orange-500 p-4 rounded-t-xl flex justify-between items-center">
                <h2 class="text-lg font-semibold text-white flex items-center">
                    <i class="fas fa-bullhorn mr-2"></i>
                    Buat Pengumuman Baru
                </h2>
            </div>

            <!-- Form -->
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
                            class="w-full px-3 py-2.5 rounded-lg border-2 border-gray-200 
                                   focus:border-primary-amber focus:ring-2 focus:ring-primary-amber/20 
                                   transition-all duration-300 outline-none text-sm"
                            required>
                    </div>

                    <!-- Isi -->
                    <div>
                        <label class="flex items-center text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-align-left text-primary-amber mr-2"></i>
                            Isi Pengumuman
                        </label>
                        <textarea name="isi" rows="5"
                            class="w-full px-3 py-2.5 rounded-lg border-2 border-gray-200 
                                   focus:border-primary-amber focus:ring-2 focus:ring-primary-amber/20 
                                   transition-all duration-300 outline-none text-sm"
                            required>{{ old('isi') }}</textarea>
                    </div>

                      <!-- Tombol Aksi -->
                    <div class="flex justify-end gap-3 mt-6 pt-4 border-t border-gray-200">
                        <button type="button" onclick="closeCreatePengumuman()" 
                            class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300 transition">
                            Batal
                        </button>
                        <button type="submit" 
                            class="px-6 py-2 rounded-lg bg-gradient-to-r from-primary-amber to-orange-500 text-white hover:opacity-90 transition">
                            Publikasikan
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<script>
    function openPengumumanModal() {
        document.getElementById('pengumumanModal').classList.remove('hidden');
    }
    function closePengumumanModal() {
        document.getElementById('pengumumanModal').classList.add('hidden');
    }
</script>
