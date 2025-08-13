<div class="bg-white rounded-xl shadow-md p-4">
    <h3 class="text-lg font-semibold text-slate-900 mb-4 border-b pb-2">
        📢 Pengumuman
    </h3>

    @if ($pengumumanGlobals->isEmpty())
        <div
            class="rounded-lg border border-light-amber/50 bg-light-amber/50 p-4 min-h-[150px] text-primary-amber flex items-center justify-center text-center shadow-sm">
            <p class="text-sm">Belum ada pengumuman terbaru.</p>
        </div>
    @else
        {{-- Scroll area --}}
        <div class="space-y-3 max-h-64 overflow-y-auto pr-1 scrollbar-thin scrollbar-thumb-amber-400 scrollbar-track-amber-100">
            @foreach ($pengumumanGlobals as $pengumuman)
                <div class="p-3 border border-light-amber/50 bg-light-amber/30 rounded-lg shadow-sm hover:shadow-md transition">
                    <h4 class="font-semibold text-primary-amber text-sm mb-1">
                        {{ $pengumuman->judul }}
                    </h4>
                    <p class="text-xs text-gray-700 mb-1">
                        {{ \Illuminate\Support\Str::limit($pengumuman->isi, 60) }}
                    </p>
                    <span class="text-[10px] text-gray-500 block">
                        {{ optional($pengumuman->created_at)->format('d M Y') ?? '-' }}
                    </span>
                </div>
            @endforeach
        </div>
    @endif
</div>
