<aside id="search-sidebar"
    class="fixed right-0 top-0 h-full w-80 bg-white shadow-lg border-l border-gray-200 z-50
           transform translate-x-full transition-transform duration-300 ease-in-out">
    <div class="p-4 flex justify-between items-center border-b">
        <h2 class="text-lg font-semibold">Cari Konten</h2>
        <button id="close-search-sidebar" class="text-gray-600 hover:text-gray-900" aria-label="Tutup Pencarian">
            ✕
        </button>
    </div>
    <div class="p-4">
        <form action="{{ route('search') }}" method="GET" role="search">
            <input
                type="text"
                name="q"
                placeholder="Cari postingan, komentar, forum..."
                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-primary-amber"
            />
            <button
                type="submit"
                class="mt-3 w-full bg-primary-amber hover:bg-accent-amber text-white px-4 py-2 rounded-md font-semibold"
            >
                Cari
            </button>
        </form>
    </div>
</aside>
