<div class="p-4 sm:p-6 lg:p-8 w-full max-w-3xl mx-auto">
    <!-- Form Card -->
    <div class="bg-white rounded-xl shadow-lg flex flex-col max-h-[90vh] overflow-hidden">
        
        <!-- Header -->
        <div class="bg-gradient-to-r from-primary-amber to-orange-500 p-4 rounded-t-xl flex justify-between items-center">
            <h2 class="text-lg font-semibold text-white flex items-center">
                <i class="fas fa-plus-circle mr-2"></i>
                Form Challenge Baru
            </h2>
        </div>

        <!-- Form -->
        <div class="flex-1 overflow-y-auto p-4 sm:p-6 space-y-4">
            <form action="{{ route('admin.challenge.store') }}" method="POST" class="space-y-4">
                @csrf

                <!-- Judul Challenge -->
                <div>
                    <label class="flex items-center text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-heading text-primary-amber mr-2"></i>
                        Judul Challenge
                    </label>
                    <input type="text" name="judul" value="{{ old('judul') }}"
                        placeholder="Masukkan judul challenge..."
                        class="w-full px-3 py-2.5 rounded-lg border-2 border-gray-200 
                               focus:border-primary-amber focus:ring-2 focus:ring-primary-amber/20 
                               transition-all duration-300 outline-none text-sm">
                    @error('judul')
                        <p class="text-sm text-red-500 mt-1 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Deskripsi -->
                <div>
                    <label class="flex items-center text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-align-left text-primary-amber mr-2"></i>
                        Deskripsi
                    </label>
                    <textarea name="deskripsi" rows="4" placeholder="Jelaskan detail challenge..."
                        class="w-full px-3 py-2.5 rounded-lg border-2 border-gray-200 
                               focus:border-primary-amber focus:ring-2 focus:ring-primary-amber/20 
                               transition-all duration-300 outline-none resize-none text-sm">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <p class="text-sm text-red-500 mt-1 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Poin -->
                <div>
                    <label class="flex items-center text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-star text-primary-amber mr-2"></i>
                        Poin
                    </label>
                    <input type="number" name="poin" value="{{ old('poin') }}"
                        placeholder="Masukkan poin challenge..." min="0"
                        class="w-full px-3 py-2.5 rounded-lg border-2 border-gray-200 
                               focus:border-primary-amber focus:ring-2 focus:ring-primary-amber/20 
                               transition-all duration-300 outline-none text-sm">
                    @error('poin')
                        <p class="text-sm text-red-500 mt-1 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Deadline -->
                <div>
                    <label class="flex items-center text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-calendar-alt text-primary-amber mr-2"></i>
                        Deadline
                    </label>
                    <input type="date" name="deadline" value="{{ old('deadline') }}"
                        class="w-full px-3 py-2.5 rounded-lg border-2 border-gray-200 
                               focus:border-primary-amber focus:ring-2 focus:ring-primary-amber/20 
                               transition-all duration-300 outline-none text-sm">
                    @error('deadline')
                        <p class="text-sm text-red-500 mt-1 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Tombol Aksi -->
                <div class="flex justify-end gap-3 mt-6 pt-4 border-t border-gray-200">
                    <button type="button" onclick="closeCreateChallenge()" 
                        class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300 transition">
                        Batal
                    </button>
                    <button type="submit" 
                        class="px-6 py-2 rounded-lg bg-gradient-to-r from-primary-amber to-orange-500 text-white hover:opacity-90 transition">
                        Buat Challenge
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

