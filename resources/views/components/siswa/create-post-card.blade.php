<form action="{{ route('siswa.postingan.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="bg-white shadow-md rounded-xl p-4 space-y-4 w-full">
        {{-- 🔹 Profil dan Username --}}
        <div class="flex items-center space-x-4">
            <img src="{{ asset('storage/profil/' . Auth::user()->foto) }}" alt="Foto Profil"
                class="w-10 h-10 rounded-full object-cover">
            <span class="font-semibold text-gray-800 text-base">
                {{ Auth::user()->username }}
            </span>
        </div>

        {{-- 🔹 Area input dan preview media --}}
        <div class="border border-gray-300 rounded-md p-3 space-y-3 focus-within:ring-2 focus-within:ring-primary-amber">
            {{-- Textarea --}}
            <textarea name="caption" placeholder="Apa yang ingin anda bagikan?" rows="2"
                class="w-full border-none focus:outline-none resize-none placeholder-gray-500 text-sm"></textarea>

            {{-- Preview media --}}
            <div id="media-preview" class="flex flex-wrap gap-3"></div>
        </div>

        {{-- 🔹 Aksi Tombol --}}
        <div class="flex justify-between items-center">
            <div class="flex items-center gap-3">
                {{-- Tombol upload media --}}
                <label for="media" class="cursor-pointer flex items-center gap-1 text-primary-amber hover:text-dark-amber">
                    📎
                    <span class="text-sm">Tambah Media</span>
                </label>
                <input type="file" id="media" name="media[]" multiple accept="image/*,video/*" class="hidden">

                {{-- Dropdown tipe postingan --}}
                <select name="kategori" class="border border-gray-300 rounded-md text-sm focus:ring-primary-amber focus:border-primary-amber">
                    <option value="">Pilih kategori</option>
                    <option value="umum">Umum</option>
                    <option value="kelas">Kelas</option>
                    <option value="jurusan">Jurusan</option>
                </select>
            </div>

            {{-- Tombol Kirim --}}
            <button type="submit"
                class="bg-primary-amber text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-dark-amber transition">
                Kirim
            </button>
        </div>
    </div>
</form>

{{-- Script Preview Media --}}
<script>
    const mediaInput = document.getElementById('media');
    const previewContainer = document.getElementById('media-preview');

    mediaInput.addEventListener('change', function () {
        previewContainer.innerHTML = '';
        [...this.files].forEach(file => {
            const reader = new FileReader();
            reader.onload = e => {
                let preview;
                if (file.type.startsWith('image/')) {
                    preview = `<img src="${e.target.result}" class="w-20 h-20 object-cover rounded-md border" />`;
                } else if (file.type.startsWith('video/')) {
                    preview = `<video src="${e.target.result}" class="w-20 h-20 rounded-md border" controls></video>`;
                }
                previewContainer.innerHTML += preview;
            };
            reader.readAsDataURL(file);
        });
    });
</script>
