<div class="p-4 sm:p-6 lg:p-8 w-full max-w-3xl mx-auto">
    <div class="bg-white rounded-xl shadow-lg flex flex-col max-h-[90vh] overflow-hidden">

        <!-- Header -->
        <div
            class="bg-gradient-to-r from-primary-amber to-orange-500 p-4 rounded-t-xl flex justify-between items-center">
            <h2 class="text-lg font-semibold text-white flex items-center">
                <i class="fas fa-edit mr-2"></i>
                Edit Challenge
            </h2>
            <button onclick="closeEditChallenge()" class="text-white hover:text-gray-200">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <!-- Scrollable Form -->
        <div class="flex-1 overflow-y-auto p-4 sm:p-6 space-y-4">
            <form id="editChallengeForm" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <input type="hidden" id="editChallengeId" name="id">

                <!-- Judul -->
                <div>
                    <label class="flex items-center text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-heading text-primary-amber mr-2"></i>
                        Judul
                    </label>
                    <input type="text" id="editChallengeJudul" name="judul"
                        class="w-full px-3 py-2.5 rounded-lg border-2 border-gray-200 
                               focus:border-primary-amber focus:ring-2 focus:ring-primary-amber/20 
                               transition-all duration-300 outline-none text-sm"
                        required>
                </div>

                <!-- Deskripsi -->
                <div>
                    <label class="flex items-center text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-align-left text-primary-amber mr-2"></i>
                        Deskripsi
                    </label>
                    <textarea id="editChallengeDeskripsi" name="deskripsi"
                        class="w-full px-3 py-2.5 rounded-lg border-2 border-gray-200 
                               focus:border-primary-amber focus:ring-2 focus:ring-primary-amber/20 
                               transition-all duration-300 outline-none text-sm"></textarea>
                </div>

                <!-- Poin -->
                <div>
                    <label class="flex items-center text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-star text-primary-amber mr-2"></i>
                        Poin
                    </label>
                    <input type="number" id="editChallengePoin" name="poin"
                        class="w-full px-3 py-2.5 rounded-lg border-2 border-gray-200 
                               focus:border-primary-amber focus:ring-2 focus:ring-primary-amber/20 
                               transition-all duration-300 outline-none text-sm"
                        required>
                </div>

                <!-- Deadline -->
                <div>
                    <label class="flex items-center text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-calendar-alt text-primary-amber mr-2"></i>
                        Deadline
                    </label>
                    <input type="date" id="editChallengeDeadline" name="deadline"
                        class="w-full px-3 py-2.5 rounded-lg border-2 border-gray-200 
                               focus:border-primary-amber focus:ring-2 focus:ring-primary-amber/20 
                               transition-all duration-300 outline-none text-sm"
                        required>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end gap-3 mt-6 pt-4 border-t border-gray-200">
                    <button type="button" onclick="closeEditChallenge()" class="px-4 py-2 bg-gray-200 rounded-lg">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-6 py-2 rounded-lg bg-gradient-to-r from-primary-amber to-orange-500 text-white">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
