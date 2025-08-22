<div class="p-4 sm:p-6 lg:p-8 w-full max-w-3xl mx-auto">
    <div class="bg-white rounded-xl shadow-lg flex flex-col max-h-[90vh] overflow-hidden">

        <!-- Header -->
        <div class="bg-gradient-to-r from-amber-500 to-orange-500 p-4 rounded-t-xl">
            <h2 class="text-lg font-semibold text-white flex items-center">
                <i class="fas fa-bullhorn mr-2"></i>
                Edit Pengumuman
            </h2>
        </div>

        <!-- Scrollable Form -->
        <div class="flex-1 overflow-y-auto p-4 sm:p-6 space-y-4">
            <form id="editPengumumanForm" action="" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <input type="hidden" id="editPengumumanId" name="id">

                <!-- Judul -->
                <div>
                    <label class="flex items-center text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-heading text-amber-500 mr-2"></i>
                        Judul
                    </label>
                    <input type="text" id="editJudul" name="judul"
                        class="w-full px-3 py-2.5 rounded-lg border-2 border-gray-200 
                               focus:border-amber-500 focus:ring-2 focus:ring-amber-500/20 
                               transition-all duration-300 outline-none text-sm"
                        required>
                </div>

                <!-- Isi -->
                <div>
                    <label class="flex items-center text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-align-left text-amber-500 mr-2"></i>
                        Isi Pengumuman
                    </label>
                    <textarea id="editIsi" name="isi" rows="6" placeholder="Tulis isi pengumuman di sini..."
                        class="w-full px-3 py-2.5 rounded-lg border-2 border-gray-200 
                               focus:border-amber-500 focus:ring-2 focus:ring-amber-500/20 
                               transition-all duration-300 outline-none text-sm resize-y"
                        required></textarea>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end gap-3 mt-6 pt-4 border-t border-gray-200">
                    <button type="button" onclick="closeEditPengumuman()" 
                        class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-lg">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-6 py-2 rounded-lg bg-gradient-to-r from-amber-500 to-orange-500 text-white hover:from-amber-600 hover:to-orange-600">
                        Update Pengumuman
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
