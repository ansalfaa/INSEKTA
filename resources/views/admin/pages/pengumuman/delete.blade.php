<div class="bg-white rounded-xl shadow-lg flex flex-col max-w-md w-full">
    <!-- Header -->
    <div class="bg-gradient-to-r from-amber-500 to-orange-500 p-4 rounded-t-xl">
        <h2 class="text-lg font-semibold text-white flex items-center">
            <i class="fas fa-exclamation-triangle mr-2"></i>
            Konfirmasi Hapus
        </h2>
    </div>

    <!-- Body -->
    <div class="p-6 space-y-4">
        <p class="text-gray-700">
            Yakin ingin menghapus pengumuman?
            <span class="font-semibold text-amber-600" id="deleteJudul">Judul</span>?
        </p>
    </div>

    <!-- Footer -->
    <div class="flex justify-end gap-3 p-4 border-t border-gray-200">
        <button type="button" onclick="closeDeletePengumuman()"
            class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-lg">
            Batal
        </button>

        <form id="deletePengumumanForm" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit"
                class="px-4 py-2 bg-gradient-to-r from-amber-500 to-orange-500 text-white rounded-lg hover:from-amber-600 hover:to-orange-600">
                Hapus
            </button>
        </form>
    </div>
</div>
