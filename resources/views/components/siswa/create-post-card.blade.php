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

        {{-- 🔹 Area input dan preview media dalam satu container --}}
        <div class="border border-gray-300 rounded-md p-3 space-y-3 focus-within:ring-2 focus-within:ring-primary-amber">
            {{-- Textarea untuk caption --}}
            <textarea name="caption" placeholder="Apa yang ingin anda bagikan?" rows="2"
                class="w-full border-none focus:outline-none resize-none placeholder-gray-500 text-sm"></textarea>

            {{-- Preview media (gambar/video) yang dipilih akan muncul di sini --}}
            <div id="media-preview" class="flex flex-wrap gap-3"></div>
        </div>

        {{-- 🔹 Aksi tombol: Upload media, dropdow
