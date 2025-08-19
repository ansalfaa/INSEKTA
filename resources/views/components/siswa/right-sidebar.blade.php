<div class="space-y-6">
    <!-- Pengumuman Card -->
    <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-lg border border-amber-100/50 p-6">
        <div class="flex items-center mb-4">
            <svg class="w-6 h-6 text-amber-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
            </svg>
            <h3 class="text-lg font-bold text-gray-900">Pengumuman</h3>
        </div>

        @if (isset($pengumumanGlobals) && $pengumumanGlobals->isNotEmpty())
            <div class="space-y-3 max-h-80 overflow-y-auto scrollbar-thin scrollbar-thumb-amber-400 scrollbar-track-amber-100">
                @foreach ($pengumumanGlobals as $pengumuman)
                    <div class="p-4 bg-gradient-to-r from-amber-50 to-amber-100/50 rounded-xl border border-amber-200/50 hover:shadow-md transition-all duration-200">
                        <h4 class="font-semibold text-amber-800 text-sm mb-2">
                            {{ $pengumuman->judul }}
                        </h4>
                        <p class="text-xs text-gray-700 mb-2 leading-relaxed">
                            {{ \Illuminate\Support\Str::limit($pengumuman->isi, 80) }}
                        </p>
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-amber-600 font-medium">
                                {{ optional($pengumuman->created_at)->format('d M Y') ?? '-' }}
                            </span>
                            <button class="text-xs text-amber-600 hover:text-amber-800 font-medium">
                                Baca Selengkapnya
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-8">
                <div class="bg-amber-50 rounded-xl p-6 border border-amber-200">
                    <svg class="w-12 h-12 text-amber-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                    </svg>
                    <p class="text-sm text-amber-600">Belum ada pengumuman terbaru</p>
                </div>
            </div>
        @endif
    </div>

    <!-- Trending Topics -->
    <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-lg border border-amber-100/50 p-6">
        <div class="flex items-center mb-4">
            <svg class="w-6 h-6 text-amber-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
            </svg>
            <h3 class="text-lg font-bold text-gray-900">Trending</h3>
        </div>
        
        <div class="space-y-3">
            <div class="p-3 bg-gradient-to-r from-amber-50 to-amber-100/30 rounded-lg border border-amber-200/30">
                <p class="text-sm font-semibold text-amber-800">#ChallengeBulanIni</p>
                <p class="text-xs text-gray-600">1.2k postingan</p>
            </div>
            <div class="p-3 bg-gradient-to-r from-amber-50 to-amber-100/30 rounded-lg border border-amber-200/30">
                <p class="text-sm font-semibold text-amber-800">#BelajarBersama</p>
                <p class="text-xs text-gray-600">856 postingan</p>
            </div>
            <div class="p-3 bg-gradient-to-r from-amber-50 to-amber-100/30 rounded-lg border border-amber-200/30">
                <p class="text-sm font-semibold text-amber-800">#TipsSehat</p>
                <p class="text-xs text-gray-600">642 postingan</p>
            </div>
        </div>
    </div>

    
</div>
