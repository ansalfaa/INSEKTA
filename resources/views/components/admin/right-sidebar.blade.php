<aside
    class="w-full max-w-full lg:w-96 p-4 lg:p-6 bg-gradient-to-br from-amber-50 to-orange-50 rounded-xl shadow-lg border border-amber-200 flex flex-col gap-6 order-1 lg:order-2 overflow-x-hidden">

    {{-- Search Input --}}
    <div class="relative">
        <!-- Updated search styling to amber theme -->
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </div>
        <input type="text" placeholder="Cari user, aktivitas..."
            class="w-full h-12 pl-10 pr-4 rounded-xl border-2 border-amber-200 bg-white text-sm placeholder:text-amber-400
                   focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-amber-400 transition-all duration-300
                   shadow-sm hover:shadow-lg hover:border-amber-300">
    </div>

    {{-- Pengumuman Section --}}
    <div class="bg-white rounded-xl p-6 shadow-md border border-amber-100">
        <!-- Enhanced header with amber theme and better styling -->
        <div class="flex items-center justify-between mb-5">
            <div class="flex items-center gap-3">
                <div
                    class="w-10 h-10 bg-gradient-to-br from-amber-400 to-orange-500 rounded-xl flex items-center justify-center shadow-md">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z">
                        </path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-slate-800">Pengumuman Terbaru</h3>
            </div>
            <a href="{{ route('admin.pengumuman.index') }}"
                class="inline-flex items-center gap-1 text-xs text-amber-700 hover:text-amber-800 font-semibold bg-amber-100 px-3 py-2 rounded-lg hover:bg-amber-200 transition-all duration-200 shadow-sm hover:shadow-md">
                Lihat Semua
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>
        <div class="max-h-96 overflow-y-auto space-y-4 custom-scrollbar">
            @forelse ($pengumumanGlobals ?? [] as $pengumuman)
                <!-- Enhanced announcement cards with amber theme and better visual hierarchy -->
                <div
                    class="group p-5 rounded-xl border-2 border-amber-100 bg-gradient-to-r from-white to-amber-50 hover:from-amber-50 hover:to-orange-50 hover:border-amber-300 hover:shadow-lg transition-all duration-300 cursor-pointer transform hover:-translate-y-1">
                    <div class="flex items-start justify-between mb-3">
                        <h4 class="text-sm font-bold text-slate-800 line-clamp-2 group-hover:text-amber-800">
                            {{ $pengumuman->judul ?? 'Tanpa Judul' }}
                        </h4>
                        @if (isset($pengumuman->priority) && $pengumuman->priority !== 'normal')
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold ml-2 flex-shrink-0 shadow-sm
                                {{ $pengumuman->priority === 'urgent' ? 'bg-red-100 text-red-700 border-2 border-red-200' : 'bg-amber-100 text-amber-700 border-2 border-amber-200' }}">
                                @if ($pengumuman->priority === 'urgent')
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                @endif
                                {{ ucfirst($pengumuman->priority) }}
                            </span>
                        @endif
                    </div>
                    <p class="text-slate-600 text-sm break-words whitespace-normal line-clamp-3 leading-relaxed mb-4">
                        {{ Str::limit(strip_tags($pengumuman->isi ?? '-'), 120) }}
                    </p>
                    <!-- Enhanced footer with amber theme and better styling -->
                    <div class="flex items-center justify-between pt-3 border-t-2 border-amber-100">
                        <div class="flex items-center gap-2 text-xs text-amber-600 font-medium">
                            <div class="w-5 h-5 bg-amber-100 rounded-lg flex items-center justify-center">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                            <span>{{ $pengumuman->created_at?->format('d M Y') ?? 'Tanpa tanggal' }}</span>
                        </div>
                        <div class="flex items-center gap-2 text-xs text-orange-600 font-medium">
                            <div class="w-5 h-5 bg-orange-100 rounded-lg flex items-center justify-center">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                    </path>
                                </svg>
                            </div>
                            <span>{{ $pengumuman->views ?? 0 }}</span>
                        </div>
                    </div>
                </div>
            @empty
                <!-- Enhanced empty state with amber theme -->
                <div
                    class="text-center py-10 bg-gradient-to-br from-amber-50 to-orange-50 rounded-xl border-2 border-dashed border-amber-300">
                    <div
                        class="w-16 h-16 bg-gradient-to-br from-amber-400 to-orange-500 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                    </div>
                    <p class="text-slate-700 text-base font-bold mb-2">Belum ada pengumuman</p>
                    <p class="text-amber-600 text-sm mb-4">Mulai dengan membuat pengumuman pertama</p>
                    <a href="{{ route('admin.pengumuman.create') }}"
                        class="inline-flex items-center gap-2 text-sm text-white font-bold bg-gradient-to-r from-amber-500 to-orange-600 px-4 py-3 rounded-xl hover:from-amber-600 hover:to-orange-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                            </path>
                        </svg>
                        Buat Pengumuman
                    </a>
                </div>
            @endforelse
        </div>
    </div>
    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Updated custom scrollbar styling to amber theme */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: #fef3c7;
            border-radius: 3px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #f59e0b;
            border-radius: 3px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #d97706;
        }
    </style>
