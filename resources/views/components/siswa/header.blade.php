<header class="flex h-16 shrink-0 items-center gap-2 border-b border-dark-amber/40 bg-primary-amber text-white px-4">
    <!-- Sidebar Trigger (Mobile) -->
    <button id="sidebar-toggle" class="md:hidden p-2 rounded-md hover:bg-accent-amber/30" aria-label="Toggle Sidebar">
        <!-- Icon Hamburger -->
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor"
            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-menu">
            <line x1="4" x2="20" y1="12" y2="12" />
            <line x1="4" x2="20" y1="6" y2="6" />
            <line x1="4" x2="20" y1="18" y2="18" />
        </svg>
        <span class="sr-only">Toggle Sidebar</span>
    </button>

    <!-- Judul Halaman -->
    <h2 class="text-xl font-semibold pl-4">Dashboard Siswa</h2>

    @php
        // Ambil filter saat ini dari query string
        $currentFilter = request()->query('filter');
    @endphp

    <!-- Dropdown Filter Kategori -->
    <div class="ml-auto relative">
        <button id="dropdown-toggle"
            class="flex items-center bg-white text-primary-amber px-4 py-2 rounded-md shadow hover:bg-light-amber transition duration-200">
            Kategori
            <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
            </svg>
        </button>

        <!-- Menu Dropdown Kategori -->
        <div id="dropdown-menu"
            class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-md shadow-lg hidden z-50">
            <a href="/siswa/dashboard"
                class="block px-4 py-2 text-sm {{ !$currentFilter ? 'font-semibold bg-light-amber/40' : 'text-gray-700 hover:bg-light-amber/60' }}">
                Semua
            </a>
            <a href="/siswa/dashboard?filter=jurusan"
                class="block px-4 py-2 text-sm {{ $currentFilter == 'jurusan' ? 'font-semibold bg-light-amber/40' : 'text-gray-700 hover:bg-light-amber/60' }}">
                Jurusan
            </a>
            <a href="/siswa/dashboard?filter=kelas"
                class="block px-4 py-2 text-sm {{ $currentFilter == 'kelas' ? 'font-semibold bg-light-amber/40' : 'text-gray-700 hover:bg-light-amber/60' }}">
                Kelas
            </a>
        </div>
    </div>

    <!-- Script untuk Toggle Dropdown -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggle = document.getElementById('dropdown-toggle');
            const menu = document.getElementById('dropdown-menu');

            // Toggle menu dropdown saat tombol diklik
            toggle.addEventListener('click', () => {
                menu.classList.toggle('hidden');
            });

            // Tutup dropdown jika klik di luar area tombol dan menu
            document.addEventListener('click', (e) => {
                if (!toggle.contains(e.target) && !menu.contains(e.target)) {
                    menu.classList.add('hidden');
                }
            });
        });
    </script>
</header>
