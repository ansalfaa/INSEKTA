@extends('layouts.admin.app', ['hideHeader' => true, 'hideSidebarRight' => true])

@section('title', 'Manajemen Pengumuman')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Mobile Menu Button --}}
        <div class="lg:hidden mb-4">
            <button id="sidebar-toggle"
                class="inline-flex items-center px-3 py-2 border border-amber-200 rounded-md text-sm leading-4 font-medium text-gray-700 bg-white hover:bg-amber-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
                Menu
            </button>
        </div>

        {{-- Success/Error Messages --}}
        @if (session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-green-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <p class="text-sm text-green-700">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-red-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    <p class="text-sm text-red-700">{{ session('error') }}</p>
                </div>
            </div>
        @endif

        {{-- Custom Header --}}
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6 gap-4">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-gray-900">Pengumuman</h1>
                <p class="text-sm text-gray-600 mt-1">Kelola pengumuman global sistem</p>
            </div>
            <div class="flex items-center space-x-3">
                {{-- Icon Notifikasi --}}
                <button title="Notifikasi"
                    class="p-2 text-gray-400 hover:text-amber-600 hover:bg-amber-50 rounded-lg transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                </button>

                {{-- Profil Bulat --}}
                <img src="{{ auth()->user()->avatar ?? 'https://i.pravatar.cc/40' }}" alt="Profil"
                    class="w-8 h-8 rounded-full object-cover border-2 border-amber-200">
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="flex flex-col sm:flex-row gap-3 mb-6">
            <a href="{{ route('admin.pengumuman.create') }}"
                class="inline-flex items-center px-4 py-2 bg-amber-600 hover:bg-amber-700 text-white text-sm font-medium rounded-lg transition-colors shadow-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Buat Pengumuman
            </a>
            <button
                class="inline-flex items-center px-4 py-2 bg-white hover:bg-amber-50 text-gray-700 text-sm font-medium rounded-lg border border-amber-200 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z">
                    </path>
                </svg>
                Filter
            </button>
        </div>

        {{-- Pengumuman List --}}
        <div class="space-y-4">
            @forelse ($pengumumanGlobals as $p)
                <article class="bg-white border border-amber-100 rounded-lg p-4 lg:p-6 hover:shadow-md hover:border-amber-200 transition-all duration-200">
                    <header class="flex flex-col sm:flex-row sm:justify-between sm:items-start mb-3 gap-3">
                        <div class="flex-1 min-w-0">
                            <h2 class="text-lg lg:text-xl font-semibold text-gray-900 break-words leading-tight">
                                {{ $p->judul }}</h2>
                            <div class="flex flex-wrap items-center gap-2 text-xs text-gray-500 mt-2">
                                <span class="inline-flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    {{ $p->author ?? 'Admin' }}
                                </span>
                                <span class="text-amber-300">•</span>
                                <span class="inline-flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    {{ $p->created_at->format('d M Y') }}
                                </span>
                                <span class="text-amber-300">•</span>
                                <span class="inline-flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                        </path>
                                    </svg>
                                    {{ $p->views ?? 0 }} views
                                </span>
                                @if (isset($p->priority) && $p->priority !== 'normal')
                                    <span class="text-amber-300">•</span>
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                        {{ $p->priority === 'urgent' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        {{ ucfirst($p->priority) }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        <nav class="flex items-center space-x-2 flex-shrink-0">
                            <button title="Lihat"
                                class="p-2 text-gray-400 hover:text-amber-600 hover:bg-amber-50 rounded-lg transition-colors"
                                onclick="viewAnnouncement({{ $p->id }})">
                                <i class="fa-solid fa-eye text-sm"></i>
                            </button>
                            <a href="{{ route('admin.pengumuman.edit', $p->id) }}" title="Edit"
                                class="p-2 text-gray-400 hover:text-amber-600 hover:bg-amber-50 rounded-lg transition-colors">
                                <i class="fa-solid fa-pen-to-square text-sm"></i>
                            </a>
                            <form action="{{ route('admin.pengumuman.destroy', $p->id) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus pengumuman ini?')" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" title="Hapus"
                                    class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                    <i class="fa-solid fa-trash text-sm"></i>
                                </button>
                            </form>
                        </nav>
                    </header>

                    <div class="prose prose-sm max-w-none text-gray-700 leading-relaxed">
                        <div class="line-clamp-3 overflow-hidden">
                            {!! Str::limit(strip_tags($p->isi), 200) !!}
                        </div>
                    </div>

                    @if (strlen(strip_tags($p->isi)) > 200)
                        <button class="text-amber-600 hover:text-amber-700 text-sm font-medium mt-2 transition-colors"
                                onclick="viewAnnouncement({{ $p->id }})">
                            Baca selengkapnya
                        </button>
                    @endif
                </article>
            @empty
                <div class="text-center py-12 bg-white rounded-lg border border-amber-100">
                    <svg class="w-12 h-12 text-amber-300 mx-auto mb-4" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                    <p class="text-gray-500 text-sm mb-4">Belum ada pengumuman.</p>
                    <a href="{{ route('admin.pengumuman.create') }}"
                        class="inline-flex items-center px-4 py-2 bg-amber-600 hover:bg-amber-700 text-white text-sm font-medium rounded-lg transition-colors shadow-sm">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                            </path>
                        </svg>
                        Buat Pengumuman Pertama
                    </a>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if (isset($pengumumanGlobals) && $pengumumanGlobals->hasPages())
            <div class="mt-8 flex justify-center">
                {{ $pengumumanGlobals->links() }}
            </div>
        @endif
    </div>

    {{-- View Modal --}}
    <div id="viewModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium text-gray-900" id="modalTitle">Detail Pengumuman</h3>
                    <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div id="modalContent" class="text-sm text-gray-700">
                    <!-- Content will be loaded here -->
                </div>
            </div>
        </div>
    </div>

    <style>
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        /* Custom pagination styling */
        .pagination .page-link {
            color: #D97706;
            border-color: #FBBF24;
        }
        
        .pagination .page-item.active .page-link {
            background-color: #D97706;
            border-color: #D97706;
        }
        
        .pagination .page-link:hover {
            color: #92400E;
            background-color: #FEF3C7;
            border-color: #FBBF24;
        }
    </style>

    <script>
        function viewAnnouncement(id) {
            // You can implement AJAX call here to fetch announcement details
            document.getElementById('viewModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('viewModal').classList.add('hidden');
        }

        // Auto-hide success/error messages after 5 seconds
        setTimeout(function() {
            const alerts = document.querySelectorAll('.bg-green-50, .bg-red-50');
            alerts.forEach(function(alert) {
                alert.style.transition = 'opacity 0.5s ease-out';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);
    </script>
@endsection
