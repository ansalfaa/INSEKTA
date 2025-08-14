<div class="p-4 sm:p-6 lg:p-8 max-w-2xl mx-auto">

    <!-- Form Card -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="bg-gradient-to-r from-primary-amber to-orange-500 p-4">
            <h2 class="text-lg font-semibold text-white flex items-center">
                <i class="fas fa-plus-circle mr-2"></i>
                Form Challenge Baru
            </h2>
        </div>

        <form action="{{ route('admin.challenge.store') }}" method="POST" class="p-4 sm:p-6">
            @csrf

            <!-- Judul Challenge -->
            <div class="mb-4">
                <label class="flex items-center text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-heading text-primary-amber mr-2"></i>
                    Judul Challenge
                </label>
                <input type="text" name="judul" value="{{ old('judul') }}" 
                    placeholder="Masukkan judul challenge..."
                    class="w-full px-3 py-2.5 rounded-lg border-2 border-gray-200 focus:border-primary-amber focus:ring-2 focus:ring-primary-amber/20 transition-all duration-300 outline-none text-sm">
                @error('judul') 
                    <p class="text-sm text-red-500 mt-1 flex items-center">
                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                    </p> 
                @enderror
            </div>

            <!-- Deskripsi -->
            <div class="mb-4">
                <label class="flex items-center text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-align-left text-primary-amber mr-2"></i>
                    Deskripsi
                </label>
                <textarea name="deskripsi" rows="4" 
                    placeholder="Jelaskan detail challenge..."
                    class="w-full px-3 py-2.5 rounded-lg border-2 border-gray-200 focus:border-primary-amber focus:ring-2 focus:ring-primary-amber/20 transition-all duration-300 outline-none resize-none text-sm">{{ old('deskripsi') }}</textarea>
                @error('deskripsi') 
                    <p class="text-sm text-red-500 mt-1 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                    </p> 
                @enderror
            </div>

            <!-- Poin -->
            <div class="mb-4">
                <label class="flex items-center text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-star text-primary-amber mr-2"></i>
                    Poin
                </label>
                <input type="number" name="poin" value="{{ old('poin') }}"
                    placeholder="Masukkan poin challenge..."
                    min="0"
                    class="w-full px-3 py-2.5 rounded-lg border-2 border-gray-200 focus:border-primary-amber focus:ring-2 focus:ring-primary-amber/20 transition-all duration-300 outline-none text-sm">
                @error('poin') 
                    <p class="text-sm text-red-500 mt-1 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                    </p> 
                @enderror
            </div>

            <!-- Deadline -->
            <div class="mb-4">
                <label class="flex items-center text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-calendar-alt text-primary-amber mr-2"></i>
                    Deadline
                </label>
                <input type="date" name="deadline" value="{{ old('deadline') }}"
                    class="w-full px-3 py-2.5 rounded-lg border-2 border-gray-200 focus:border-primary-amber focus:ring-2 focus:ring-primary-amber/20 transition-all duration-300 outline-none text-sm">
                @error('deadline') 
                    <p class="text-sm text-red-500 mt-1 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                    </p> 
                @enderror
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end gap-3 mt-6 pt-4 border-t border-gray-200">
                <a href="{{ route('admin.challenge.index') }}"
                    class="px-4 py-2.5 rounded-lg border-2 border-gray-300 text-gray-600 hover:bg-gray-50 hover:border-gray-400 transition-all duration-300 text-center font-medium text-sm">
                    <i class="fas fa-times mr-2"></i>Batal
                </a>
                <button type="submit"
                    class="px-6 py-2.5 rounded-lg bg-gradient-to-r from-primary-amber to-orange-500 text-white hover:from-orange-500 hover:to-primary-amber transition-all duration-300 font-semibold shadow-md hover:shadow-lg text-sm">
                    <i class="fas fa-save mr-2"></i>Buat Challenge
                </button>
            </div>
        </form>
    </div>
</div>
