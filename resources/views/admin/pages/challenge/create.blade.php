@extends('layouts.admin.app',['hideHeader' => true, 'hideSidebarRight' => true])

@section('title', 'Buat Challenge Baru')

@section('content')
<div class="p-4 sm:p-6 lg:p-8 max-w-4xl mx-auto">
    <!-- Replaced standalone HTML with admin layout extension and adjusted sizing -->
    <!-- Header Section -->
    <div class="mb-6 text-center">
        <div class="inline-flex items-center justify-center w-12 h-12 bg-primary-amber rounded-lg mb-3">
            <i class="fas fa-trophy text-white text-lg"></i>
        </div>
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-2">Buat Challenge Baru</h1>
        <p class="text-gray-600 text-sm">Buat tantangan menarik untuk meningkatkan engagement</p>
    </div>

    <!-- Main Form Card -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="bg-gradient-to-r from-primary-amber to-orange-500 p-4">
            <h2 class="text-lg font-semibold text-white flex items-center">
                <i class="fas fa-plus-circle mr-2"></i>
                Form Challenge Baru
            </h2>
        </div>

        <form action="{{ route('admin.challenge.store') }}" method="POST" enctype="multipart/form-data" class="p-4 sm:p-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Judul Challenge -->
                <div class="md:col-span-2">
                    <label class="flex items-center text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-heading text-primary-amber mr-2"></i>
                        Judul Challenge
                    </label>
                    <input type="text" name="judul" value="{{ old('judul') }}" 
                        placeholder="Masukkan judul challenge yang menarik..."
                        class="w-full px-3 py-2.5 rounded-lg border-2 border-gray-200 focus:border-primary-amber focus:ring-2 focus:ring-primary-amber/20 transition-all duration-300 outline-none text-sm">
                    @error('judul') 
                        <p class="text-sm text-red-500 mt-1 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </p> 
                    @enderror
                </div>

                <!-- Deskripsi -->
                <div class="md:col-span-2">
                    <label class="flex items-center text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-align-left text-primary-amber mr-2"></i>
                        Deskripsi Challenge
                    </label>
                    <textarea name="deskripsi" rows="4" 
                        placeholder="Jelaskan detail challenge, aturan, dan cara berpartisipasi..."
                        class="w-full px-3 py-2.5 rounded-lg border-2 border-gray-200 focus:border-primary-amber focus:ring-2 focus:ring-primary-amber/20 transition-all duration-300 outline-none resize-none text-sm">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi') 
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
                        class="w-full px-3 py-2.5 rounded-lg border-2 border-gray-200 focus:border-primary-amber focus:ring-2 focus:ring-primary-amber/20 transition-all duration-300 outline-none text-sm">
                    @error('deadline') 
                        <p class="text-sm text-red-500 mt-1 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </p> 
                    @enderror
                </div>

                <!-- Poin/XP -->
                <div>
                    <label class="flex items-center text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-star text-primary-amber mr-2"></i>
                        Poin / XP
                    </label>
                    <input type="number" name="poin" value="{{ old('poin') }}" 
                        placeholder="100"
                        class="w-full px-3 py-2.5 rounded-lg border-2 border-gray-200 focus:border-primary-amber focus:ring-2 focus:ring-primary-amber/20 transition-all duration-300 outline-none text-sm">
                    @error('poin') 
                        <p class="text-sm text-red-500 mt-1 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </p> 
                    @enderror
                </div>

                <!-- Reward Badge -->
                <div class="md:col-span-2">
                    <label class="flex items-center text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-medal text-primary-amber mr-2"></i>
                        Reward Badge
                    </label>
                    <div class="relative">
                        <input type="file" name="badge" id="badge-upload" accept="image/*"
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                        <div class="w-full px-4 py-6 rounded-lg border-2 border-dashed border-gray-300 hover:border-primary-amber transition-colors duration-300 text-center">
                            <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                            <p class="text-gray-600 text-sm">Klik untuk upload badge atau drag & drop</p>
                            <p class="text-xs text-gray-400 mt-1">PNG, JPG, GIF hingga 2MB</p>
                        </div>
                    </div>
                    @error('badge') 
                        <p class="text-sm text-red-500 mt-1 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </p> 
                    @enderror
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row justify-end gap-3 mt-6 pt-4 border-t border-gray-200">
                <a href="{{ route('admin.challenge.index') }}"
                    class="px-4 py-2.5 rounded-lg border-2 border-gray-300 text-gray-600 hover:bg-gray-50 hover:border-gray-400 transition-all duration-300 text-center font-medium text-sm">
                    <i class="fas fa-times mr-2"></i>Batal
                </a>
                <button type="submit"
                    class="px-6 py-2.5 rounded-lg bg-gradient-to-r from-primary-amber to-orange-500 text-white hover:from-orange-500 hover:to-primary-amber transition-all duration-300 font-semibold shadow-md hover:shadow-lg text-sm">
                    <i class="fas fa-save mr-2"></i>Simpan Challenge
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // File upload preview
    document.getElementById('badge-upload').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.createElement('img');
                preview.src = e.target.result;
                preview.className = 'w-16 h-16 object-cover rounded-lg mx-auto mt-2';
                
                const container = e.target.parentElement.querySelector('div');
                container.innerHTML = `
                    <i class="fas fa-check-circle text-3xl text-green-500 mb-2"></i>
                    <p class="text-green-600 font-medium text-sm">Badge berhasil dipilih</p>
                    <p class="text-xs text-gray-500">${file.name}</p>
                `;
                container.appendChild(preview);
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection
