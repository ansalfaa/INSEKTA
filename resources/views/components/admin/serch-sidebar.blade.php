<aside id="search-sidebar"
    class="fixed right-0 top-0 h-full w-80 bg-white shadow-lg border-l border-gray-200 z-50
           transform translate-x-full transition-transform duration-300 ease-in-out">

    {{-- Header: Judul dan Tombol Tutup --}}
    <div class="p-4 flex justify-between items-center border-b">
        <h2 class="text-lg font-semibold">Cari Data Admin</h2>
        <button id="close-search-sidebar" class="text-gray-600 hover:text-gray-900" aria-label="Tutup Sidebar">
            ✕
        </button>
    </div>

    {{-- Konten Utama --}}
    <div class="p-4">
        {{-- Form Pencarian --}}
        <form action="{{ route('admin.users.index') }}" method="GET">
            <input type="text" name="q" placeholder="Cari user, aktivitas, pengaturan..."
                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
            <button type="submit" class="mt-3 w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
                Cari
            </button>
        </form>

        {{-- Kategori Pencarian Cepat --}}
        <div class="mt-6">
            <h3 class="text-sm font-semibold text-gray-700 mb-3">Kategori Pencarian</h3>
            <div class="space-y-2">
                <a href="{{ route('admin.users.index') }}" class="block text-sm text-blue-600 hover:text-blue-800">
                    👥 Manajemen User
                </a>
                <a href="#" class="block text-sm text-blue-600 hover:text-blue-800">
                    📊 Statistik Sistem
                </a>
                <a href="#" class="block text-sm text-blue-600 hover:text-blue-800">
                    ⚙️ Pengaturan
                </a>
                <a href="#" class="block text-sm text-blue-600 hover:text-blue-800">
                    📝 Log Aktivitas
                </a>
            </div>
        </div>
    </div>
</aside>
