
<div class="bg-white/95 backdrop-blur-sm rounded-2xl shadow-lg border border-amber-100/50 p-6 transition-all duration-300 hover:shadow-xl hover:border-amber-200/70">
    <div class="flex items-start space-x-4">
        <!-- User Avatar -->
        <div class="flex-shrink-0">
            <div class="h-12 w-12 rounded-full overflow-hidden ring-2 ring-amber-200/50">
                <img src="{{ asset('storage/profil/' . auth()->user()->foto ?? 'default-avatar.png') }}" 
                     alt="Your Avatar" 
                     class="w-full h-full object-cover" />
            </div>
        </div>
        
        <!-- Post Input Area -->    
        <div class="flex-1">
            <form action="{{ route('siswa.postingan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                
                <!-- Text Input -->
                <div class="relative">
                    <textarea name="caption" 
                              placeholder="Apa yang sedang kamu pikirkan, {{ auth()->user()->username ?? 'Siswa' }}?"
                              class="w-full p-4 bg-gradient-to-r from-amber-50/50 to-amber-100/30 border border-amber-200/50 rounded-xl resize-none focus:outline-none focus:ring-2 focus:ring-amber-300 focus:border-transparent transition-all duration-200 placeholder-gray-500"
                              rows="3"></textarea>
                </div>
                
                <!-- Media Preview Area -->
                <div id="media-preview" class="hidden">
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3 p-4 bg-amber-50/30 rounded-xl border border-amber-200/30">
                        <!-- Media previews will be inserted here -->
                    </div>
                </div>
                
                <!-- Visibility Settings -->
                <div class="flex items-center space-x-4 text-sm">
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="radio" name="visibilitas" value="semua" checked 
                               class="text-amber-500 focus:ring-amber-300">
                        <span class="text-gray-700">Semua</span>
                    </label>
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="radio" name="visibilitas" value="jurusan" 
                               class="text-amber-500 focus:ring-amber-300">
                        <span class="text-gray-700">Jurusan</span>
                    </label>
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="radio" name="visibilitas" value="kelas" 
                               class="text-amber-500 focus:ring-amber-300">
                        <span class="text-gray-700">Kelas</span>
                    </label>
                </div>
                
                <!-- Action Buttons -->
                <div class="flex items-center justify-between pt-2">
                    <div class="flex items-center space-x-3">
                        <!-- Media Upload -->
                        <label class="cursor-pointer group">
                            <input type="file" name="media[]" multiple accept="image/*,video/*" class="hidden" id="media-input">
                            <div class="flex items-center space-x-2 px-3 py-2 rounded-lg hover:bg-amber-100/50 transition-colors group-hover:text-amber-700">
                                <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span class="text-sm font-medium">Media</span>
                            </div>
                        </label>
                        
                        <!-- Emoji Button -->
                        <button type="button" class="flex items-center space-x-2 px-3 py-2 rounded-lg hover:bg-amber-100/50 transition-colors hover:text-amber-700">
                            <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10" />
                                <path d="M8 14s1.5 2 4 2 4-2 4-2" />
                                <line x1="9" y1="9" x2="9.01" y2="9" />
                                <line x1="15" y1="9" x2="15.01" y2="9" />
                            </svg>
                            <span class="text-sm font-medium">Emoji</span>
                        </button>
                    </div>
                    
                    <!-- Post Button -->
                    <button type="submit" 
                            class="px-6 py-2 bg-gradient-to-r from-amber-500 to-amber-600 text-white font-semibold rounded-lg hover:from-amber-600 hover:to-amber-700 focus:outline-none focus:ring-2 focus:ring-amber-300 focus:ring-offset-2 transition-all duration-200 transform hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed">
                        Posting
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('media-input').addEventListener('change', function(e) {
    const files = Array.from(e.target.files);
    const preview = document.getElementById('media-preview');
    
    if (files.length > 0) {
        preview.classList.remove('hidden');
        const previewContainer = preview.querySelector('div');
        previewContainer.innerHTML = '';
        
        files.forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const div = document.createElement('div');
                div.className = 'relative group';
                
                if (file.type.startsWith('image/')) {
                    div.innerHTML = `
                        <img src="${e.target.result}" class="w-full h-24 object-cover rounded-lg">
                        <button type="button" onclick="removeMedia(${index})" class="absolute -top-2 -right-2 w-6 h-6 bg-red-500 text-white rounded-full text-xs opacity-0 group-hover:opacity-100 transition-opacity">×</button>
                    `;
                } else if (file.type.startsWith('video/')) {
                    div.innerHTML = `
                        <video src="${e.target.result}" class="w-full h-24 object-cover rounded-lg"></video>
                        <button type="button" onclick="removeMedia(${index})" class="absolute -top-2 -right-2 w-6 h-6 bg-red-500 text-white rounded-full text-xs opacity-0 group-hover:opacity-100 transition-opacity">×</button>
                    `;
                }
                
                previewContainer.appendChild(div);
            };
            reader.readAsDataURL(file);
        });
    } else {
        preview.classList.add('hidden');
    }
});

function removeMedia(index) {
    // Implementation for removing specific media file
    console.log('Remove media at index:', index);
}
</script>
