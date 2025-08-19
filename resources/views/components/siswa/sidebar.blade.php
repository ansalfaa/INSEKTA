<aside id="sidebar-left"
    class="transform -translate-x-full transition-transform duration-300 ease-in-out 
           w-42 lg:w-52 flex-shrink-0 flex-col bg-dark-amber text-white z-50 
           fixed inset-y-0 left-0 md:translate-x-0">

    {{-- Logo --}}
    <div class="w-full flex justify-center items-center p-6 border-b border-primary-amber">
        <img src="{{ asset('images/logoputih.png') }}" alt="Logo Insekta"
            class="w-full max-w-[120px] h-auto object-contain" />
    </div>

    {{-- Navigasi --}}
    <nav class="flex-1 overflow-auto p-4">
        <div class="text-[11px] font-bold mb-3 uppercase text-primary-amber tracking-wide">Navigasi</div>
        <ul class="space-y-1 text-sm">

            {{-- Beranda --}}
            <li>
                <a href="{{ route('siswa.dashboard') }}"
                    class="flex items-center px-3 py-2 rounded-md transition duration-200
                        {{ request()->routeIs('siswa.dashboard') ? 'bg-amber-200 text-dark-amber font-bold' : 'hover:bg-accent-amber text-white' }}">
                    <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 9.75L12 3l9 6.75v10.5a.75.75 0 01-.75.75H3.75a.75.75 0 01-.75-.75V9.75z" />
                    </svg>
                    <span>Beranda</span>
                </a>
            </li>

            {{-- Cari --}}
            <li>
                <a href="{{ route('search') }}"
                    class="flex items-center px-3 py-2 rounded-md transition duration-200
                        {{ request()->routeIs('search') ? 'bg-amber-200 text-dark-amber font-bold' : 'hover:bg-accent-amber text-white' }}">
                    <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z" />
                    </svg>
                    <span>Cari</span>
                </a>
            </li>

            {{-- Notifikasi --}}
            <li>
                <a href="{{ route('siswa.pages.notifikasi') }}"
                    class="flex items-center px-3 py-2 rounded-md transition duration-200
                        {{ request()->routeIs('siswa.notifikasi') ? 'bg-amber-200 text-dark-amber font-bold' : 'hover:bg-accent-amber text-white' }}">
                    <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                        <path
                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 00-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h16z" />
                    </svg>
                    <span>Notifikasi</span>
                </a>
            </li>

            {{-- Pesan --}}
            <li>
                <a href="{{ route('siswa.pages.pesan') }}"
                    class="flex items-center px-3 py-2 rounded-md transition duration-200
                        {{ request()->routeIs('siswa.pesan') ? 'bg-amber-200 text-dark-amber font-bold' : 'hover:bg-accent-amber text-white' }}">
                    <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                        <path
                            d="M21 8.25v8.25a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 16.5V8.25M21 8.25l-9 5.25L3 8.25M21 8.25L12 3 3 8.25" />
                    </svg>
                    <span>Pesan</span>
                </a>
            </li>

            {{-- Forum --}}
            <li>
                <a href="{{ route('siswa.pages.forum') }}"
                    class="flex items-center px-3 py-2 rounded-md transition duration-200
                        {{ request()->routeIs('siswa.forum') ? 'bg-amber-200 text-dark-amber font-bold' : 'hover:bg-accent-amber text-white' }}">
                    <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 8h2a2 2 0 012 2v8l-4-4H7a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v2z" />
                    </svg>
                    <span>Forum</span>
                </a>
            </li>

            {{-- Challenge --}}
            <li>
                <a href="{{ route('siswa.pages.challenge') }}"
                    class="flex items-center px-3 py-2 rounded-md transition duration-200
                        {{ request()->routeIs('siswa.challenge') ? 'bg-amber-200 text-dark-amber font-bold' : 'hover:bg-accent-amber text-white' }}">
                    <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    <span>Challenge</span>
                </a>
            </li>

            {{-- Polling --}}
            <li>
                <a href="{{ route('siswa.pages.polling') }}"
                    class="flex items-center px-3 py-2 rounded-md transition duration-200
                        {{ request()->routeIs('siswa.polling') ? 'bg-amber-200 text-dark-amber font-bold' : 'hover:bg-accent-amber text-white' }}">
                    <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 6h16M4 12h8m-8 6h16" />
                    </svg>
                    <span>Polling</span>
                </a>
            </li>

            {{-- Leaderboard --}}
            <li>
                <a href="{{ route('siswa.pages.leaderboard') }}"
                    class="flex items-center px-3 py-2 rounded-md transition duration-200
                        {{ request()->routeIs('siswa.leaderboard') ? 'bg-amber-200 text-dark-amber font-bold' : 'hover:bg-accent-amber text-white' }}">
                    <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M8 17v-6m4 6v-4m4 4v-8M4 21h16" />
                    </svg>
                    <span>Leaderboard</span>
                </a>
            </li>

            {{-- Profile --}}
            <li>
                <a href="{{ route('siswa.pages.profile') }}"
                    class="flex items-center px-3 py-2 rounded-md transition duration-200
                        {{ request()->routeIs('siswa.profile') ? 'bg-amber-200 text-dark-amber font-bold' : 'hover:bg-accent-amber text-white' }}">
                    <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z" />
                    </svg>
                    <span>Profile</span>
                </a>
            </li>

        </ul>



        {{-- Aksi Cepat --}}
        <div class="border-t border-primary-amber mt-5 pt-3">
            <div class="text-[11px] font-bold mb-2 uppercase text-primary-amber tracking-wide">Aksi Cepat</div>
            <ul class="space-y-1 text-sm">
                <li>
                    <a href="#buat"
                        class="flex items-center px-3 py-2 rounded-md transition duration-200 hover:bg-accent-amber text-white">
                        <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 4v16m8-8H4" />
                        </svg>
                        <span>Buat Postingan</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</aside>
