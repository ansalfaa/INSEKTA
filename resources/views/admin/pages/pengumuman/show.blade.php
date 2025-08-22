<div class="bg-white rounded-xl shadow-lg flex flex-col max-h-[80vh] overflow-hidden w-full max-w-2xl">
    <!-- Header -->
    <div class="bg-gradient-to-r  from-amber-500 to-orange-500 p-4 rounded-t-xl">
        <h2 class="text-lg font-semibold text-white flex items-center">
            <i class="fas fa-eye mr-2"></i>
            Detail Pengumuman
        </h2>
    </div>

    <!-- Body -->
    <div class="flex-1 overflow-y-auto p-6 space-y-4">
        <input type="hidden" id="showPengumumanId">

        <div>
            <h3 class="text-lg font-bold text-gray-800 mb-2" id="showJudul">Judul Pengumuman</h3>
        </div>

        <div>
            <p class="text-gray-700 leading-relaxed whitespace-pre-line" id="showIsi">
                Isi pengumuman akan tampil di sini...
            </p>
        </div>
    </div>

    <!-- Footer -->
    <div class="flex justify-end gap-3 p-4 border-t border-gray-200">
        <button type="button" onclick="closeShowPengumuman()"
            class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-lg">
            Tutup
        </button>
    </div>
</div>
