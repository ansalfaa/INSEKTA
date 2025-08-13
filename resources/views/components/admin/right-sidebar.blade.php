<aside class="w-full max-w-full lg:w-96 p-4 lg:p-6 bg-white rounded-xl shadow-lg flex flex-col gap-6 order-1 lg:order-2 overflow-x-hidden">

    {{-- Search Input --}}
    <div>
        <input type="text" placeholder="Cari user, aktivitas..."
            class="w-full h-10 rounded-md border border-gray-300 bg-gray-50 px-3 text-sm placeholder:text-gray-500
                   focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
    </div>

    {{-- Pengumuman Section --}}
    <div>
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-slate-900">Pengumuman Terbaru</h3>
            <a href="{{ route('admin.pengumuman.index') }}" 
               class="text-xs text-amber-600 hover:text-amber-700 font-medium">
                Lihat Semua
            </a>
        </div>
        <div class="max-h-96 overflow-y-auto space-y-3">
            @forelse ($pengumumanGlobals ?? [] as $pengumuman)
                <div class="p-4 rounded-lg border border-gray-200 bg-white shadow-sm hover:shadow-md transition-shadow duration-200">
                    <div class="flex items-start justify-between mb-2">
                        <h4 class="text-sm font-semibold text-gray-900 line-clamp-2">
                            {{ $pengumuman->judul ?? 'Tanpa Judul' }}
                        </h4>
                        @if (isset($pengumuman->priority) && $pengumuman->priority !== 'normal')
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium ml-2 flex-shrink-0
                                {{ $pengumuman->priority === 'urgent' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ ucfirst($pengumuman->priority) }}
                            </span>
                        @endif
                    </div>
                    <p class="text-gray-600 text-xs break-words whitespace-normal line-clamp-3">
                        {{ Str::limit(strip_tags($pengumuman->isi ?? '-'), 100) }}
                    </p>
                    <div class="flex items-center justify-between mt-3 text-xs text-gray-500">
                        <span>{{ $pengumuman->created_at?->format('d M Y') ?? 'Tanpa tanggal' }}</span>
                        <span>{{ $pengumuman->views ?? 0 }} views</span>
                    </div>
                </div>
            @empty
                <div class="text-center py-8">
                    <svg class="w-8 h-8 text-gray-300 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                    <p class="text-gray-500 text-sm">Belum ada pengumuman.</p>
                    <a href="{{ route('admin.pengumuman.create') }}" 
                       class="text-xs text-amber-600 hover:text-amber-700 font-medium mt-1 inline-block">
                        Buat pengumuman pertama
                    </a>
                </div>
            @endforelse
        </div>
    </div>

    {{-- Quick Stats --}}
    <div class="border-t border-gray-200 pt-4">
        <h3 class="text-sm font-semibold text-gray-900 mb-3">Statistik Cepat</h3>
        <div class="space-y-2">
            <div class="flex justify-between items-center text-sm">
                <span class="text-gray-600">Total Pengumuman</span>
                <span class="font-medium text-gray-900">{{ $totalPengumuman ?? 0 }}</span>
            </div>
            <div class="flex justify-between items-center text-sm">
                <span class="text-gray-600">Aktif Hari Ini</span>
                <span class="font-medium text-green-600">{{ $activePengumuman ?? 0 }}</span>
            </div>
            <div class="flex justify-between items-center text-sm">
                <span class="text-gray-600">Total Views</span>
                <span class="font-medium text-blue-600">{{ $totalViews ?? 0 }}</span>
            </div>
        </div>
    </div>
</aside>

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
</style>
