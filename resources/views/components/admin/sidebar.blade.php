{{-- Logo --}}
<div class="flex justify-center items-center p-6 border-b border-amber-100">
    <div class="text-center">
        <img src="{{ asset('images/insekgam.png') }}" alt="Logo INSEKTA"
            class="w-12 h-12 rounded-xl mx-auto mb-2 object-cover ring-2 ring-amber-200">
        <h1 class="text-lg font-semibold text-gray-900">INSEKTA</h1>
        <p class="text-xs text-amber-600">Admin Panel</p>
    </div>
</div>

{{-- Navigation --}}
<nav class="flex-1 overflow-auto p-4">
    <div class="text-xs font-medium mb-3 uppercase text-gray-400 tracking-wider">Navigasi</div>
    <ul class="space-y-1">
{{-- Menu Sidebar --}}
<ul class="space-y-1">
    {{-- Dashboard --}}
    <li>
        <a href="{{ route('admin.dashboard') }}"
            class="flex items-center px-2.5 py-2 rounded-md transition-all duration-200
            {{ request()->routeIs('admin.dashboard') ? 'bg-light-amber text-dark-amber font-medium border-r-2 border-primary-amber' : 'hover:bg-amber-50 text-gray-700 hover:text-gray-900' }}">
            <svg class="w-3.5 h-3.5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M3 9.75L12 3l9 6.75v10.5a.75.75 0 01-.75.75H3.75a.75.75 0 01-.75-.75V9.75z" />
            </svg>
            <span class="text-xs font-medium">Dashboard</span>
        </a>
    </li>

    {{-- Manajemen User --}}
    <li>
        <a href="{{ route('admin.users.index') }}"
            class="flex items-center px-2.5 py-2 rounded-md transition-all duration-200
            {{ request()->routeIs('admin.users.*') ? 'bg-light-amber text-dark-amber font-medium border-r-2 border-primary-amber' : 'hover:bg-amber-50 text-gray-700 hover:text-gray-900' }}">
            <svg class="w-3.5 h-3.5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
            </svg>
            <span class="text-xs font-medium">Manajemen User</span>
        </a>
    </li>

    {{-- Pengumuman --}}
    <li>
        <a href="{{ route('admin.pengumuman.index') }}"
            class="flex items-center px-2.5 py-2 rounded-md transition-all duration-200
            {{ request()->routeIs('admin.pengumuman.*') ? 'bg-light-amber text-dark-amber font-medium border-r-2 border-primary-amber' : 'hover:bg-amber-50 text-gray-700 hover:text-gray-900' }}">
            <svg class="w-3.5 h-3.5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
            </svg>
            <span class="text-xs font-medium">Pengumuman</span>
        </a>
    </li>

    {{-- Challenge --}}
    <li>
        <a href="{{ route('admin.challenge.index') }}"
            class="flex items-center px-2.5 py-2 rounded-md transition-all duration-200 hover:bg-amber-50 text-gray-700 hover:text-gray-900">
            <svg class="w-3.5 h-3.5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
            </svg>
            <span class="text-xs font-medium">Challenge</span>
        </a>
    </li>

    {{-- Konten --}}
    <li>
        <a href="{{ route('admin.konten.index') }}"
            class="flex items-center px-2.5 py-2 rounded-md transition-all duration-200 hover:bg-amber-50 text-gray-700 hover:text-gray-900">
            <svg class="w-3.5 h-3.5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H15" />
            </svg>
            <span class="text-xs font-medium">Konten</span>
        </a>
    </li>

    {{-- Diskusi --}}
    <li>
        <a href="#"
            class="flex items-center px-2.5 py-2 rounded-md transition-all duration-200 hover:bg-amber-50 text-gray-700 hover:text-gray-900">
            <svg class="w-3.5 h-3.5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
            </svg>
            <span class="text-xs font-medium">Diskusi</span>
        </a>
    </li>

    {{-- Polling --}}
    <li>
        <a href="#"
            class="flex items-center px-2.5 py-2 rounded-md transition-all duration-200 hover:bg-amber-50 text-gray-700 hover:text-gray-900">
            <svg class="w-3.5 h-3.5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
            </svg>
            <span class="text-xs font-medium">Polling</span>
        </a>
    </li>

    {{-- Monitoring --}}
    <li>
        <a href="#"
            class="flex items-center px-2.5 py-2 rounded-md transition-all duration-200 hover:bg-amber-50 text-gray-700 hover:text-gray-900">
            <svg class="w-3.5 h-3.5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
            </svg>
            <span class="text-xs font-medium">Monitoring</span>
        </a>
    </li>

    {{-- Pengaturan --}}
    <li>
        <a href="#"
            class="flex items-center px-2.5 py-2 rounded-md transition-all duration-200 hover:bg-amber-50 text-gray-700 hover:text-gray-900">
            <svg class="w-3.5 h-3.5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            <span class="text-xs font-medium">Pengaturan</span>
        </a>
    </li>
</ul>

{{-- Aksi Cepat --}}
<div class="border-t border-amber-100 mt-4 pt-3">
    <div class="text-[10px] font-semibold mb-2 uppercase text-gray-400 tracking-wider">Aksi Cepat</div>
    <ul class="space-y-1">
        <li>
            <a href="#buat"
                class="flex items-center px-2.5 py-2 rounded-md transition-all duration-200 hover:bg-amber-50 text-gray-700 hover:text-gray-900">
                <svg class="w-3.5 h-3.5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                <span class="text-xs font-medium">Buat Pengumuman</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.users.create') }}"
                class="flex items-center px-2.5 py-2 rounded-md transition-all duration-200 hover:bg-amber-50 text-gray-700 hover:text-gray-900">
                <svg class="w-3.5 h-3.5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                <span class="text-xs font-medium">Tambah User</span>
            </a>
        </li>
    </ul>
</div>

{{-- Logout --}}
<div class="p-3 border-t border-amber-100 mt-3">
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit"
            class="flex items-center w-full px-2.5 py-2 rounded-md transition-all duration-200 hover:bg-red-50 text-gray-700 hover:text-red-600">
            <svg class="w-3.5 h-3.5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
            </svg>
            <span class="text-xs font-medium">Logout</span>
        </button>
    </form>
</div>
