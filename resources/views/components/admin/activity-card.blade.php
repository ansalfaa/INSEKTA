@props(['userAvatar', 'username', 'timeAgo', 'content', 'type' => 'info', 'priority' => 'normal'])

<div class="rounded-lg border border-blue-100 bg-white text-gray-800 shadow-sm">
    {{-- Header Activity: menampilkan avatar, username, waktu, dan opsi --}}
    <div class="flex flex-row items-center justify-between p-4 pb-2 space-y-0">
        <div class="flex items-center space-x-3">
            {{-- Avatar user --}}
            <div class="relative flex h-10 w-10 shrink-0 overflow-hidden rounded-full">
                @if ($userAvatar)
                    <img class="aspect-square h-full w-full object-cover" src="{{ $userAvatar }}"
                        alt="{{ $username }} Avatar">
                @else
                    {{-- Default avatar jika userAvatar tidak tersedia --}}
                    <div
                        class="w-full h-full bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center">
                        <i class="fas fa-user-shield text-white text-sm"></i>
                    </div>
                @endif
            </div>

            {{-- Username dan waktu aktivitas --}}
            <div class="flex flex-col">
                <span class="font-semibold text-lg text-slate-900">{{ $username }}</span>
                <span class="text-xs text-slate-500">{{ $timeAgo }}</span>
            </div>
        </div>

        {{-- Badge prioritas, tampilkan jika bukan 'normal' --}}
        @if ($priority !== 'normal')
            <span
                class="px-2 py-1 text-xs font-semibold rounded-full
                    {{ $priority === 'urgent' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800' }}">
                {{ ucfirst($priority) }}
            </span>
        @endif

        {{-- Tombol opsi (misal dropdown menu) --}}
        <button class="p-2 rounded-full hover:bg-blue-50 transition-colors" type="button" aria-label="Opsi Activity">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-more-horizontal">
                <circle cx="12" cy="12" r="1" />
                <circle cx="19" cy="12" r="1" />
                <circle cx="5" cy="12" r="1" />
            </svg>
        </button>
    </div>

    {{-- Konten aktivitas --}}
    <div class="p-4 pt-2 text-base text-gray-700">
        <p>{{ $content }}</p>
    </div>
</div>
