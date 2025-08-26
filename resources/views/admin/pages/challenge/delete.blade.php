<div class="p-4 sm:p-6 lg:p-8 w-full max-w-md mx-auto">
    <div class="bg-white rounded-xl shadow-lg flex flex-col max-h-[90vh] overflow-hidden">
        
        <!-- Header -->
        <div class="bg-gradient-to-r from-red-500 to-red-600 p-4 rounded-t-xl">
            <h2 class="text-lg font-semibold text-white flex items-center">
                <i class="fas fa-exclamation-triangle mr-2"></i>
                Hapus Challenge
            </h2>
        </div>

        <!-- Body -->
        <div class="flex-1 overflow-y-auto p-4 sm:p-6">
            <form id="deleteChallengeForm" method="POST" class="space-y-4">
                @csrf
                @method('DELETE')
                <input type="hidden" id="deleteChallengeId" name="id">

                <p class="text-gray-700 text-sm">
                    Apakah kamu yakin ingin menghapus challenge 
                    <span id="deleteChallengeJudul" class="font-semibold text-red-600"></span>?
                </p>

                <!-- Footer -->
                <div class="flex justify-end gap-3 mt-6 pt-4 border-t border-gray-200">
                    <button type="button" onclick="closeDeleteChallenge()" 
                        class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300 transition">
                        Batal
                    </button>
                    <button type="submit" 
                        class="px-6 py-2 rounded-lg bg-red-600 hover:bg-red-700 text-white transition">
                        Hapus
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
