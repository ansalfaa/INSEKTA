@props(['userAvatar', 'username', 'timeAgo', 'content', 'media' => []])

<div class="rounded-lg border border-light-blue/50 bg-white text-gray-800 shadow-sm">
    <!-- Header Postingan: Avatar, Username, Waktu, dan Opsi -->
    <div class="flex items-center justify-between p-4 pb-2">
        <div class="flex items-center space-x-3">
            <div class="relative h-10 w-10 flex-shrink-0 overflow-hidden rounded-full">
                <img src="{{ $userAvatar }}" alt="{{ $username }} Avatar" class="object-cover w-full h-full" />
            </div>
            <div class="flex flex-col">
                <span class="font-semibold text-lg text-slate-900">{{ $username }}</span>
                <span class="text-xs text-slate-500">{{ $timeAgo }}</span>
            </div>
        </div>
        <button type="button" aria-label="Opsi Postingan"
            class="p-2 rounded-full hover:bg-light-blue/50 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-more-horizontal">
                <circle cx="12" cy="12" r="1" />
                <circle cx="19" cy="12" r="1" />
                <circle cx="5" cy="12" r="1" />
            </svg>
        </button>
    </div>

    <!-- Konten Postingan: Teks dan Media -->
    <div class="p-4 pt-2 text-base text-gray-700">
        <!-- Konten teks dengan newline diubah jadi <br> -->
        <div class="post-content max-w-full whitespace-pre-wrap break-words" style="text-indent: 0;">
            {!! nl2br(e($content)) !!}
        </div>

        <!-- Media jika ada -->
        @php
            // Pastikan media dalam bentuk array
            $mediaList = is_array($media) ? $media : json_decode($media, true);
        @endphp

        @if (!empty($mediaList))
            <div class="mt-4 grid grid-cols-2 gap-2">
                @foreach ($mediaList as $file)
                    @php
                        $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                        $isImage = in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp']);
                        $isVideo = in_array($ext, ['mp4', 'avi', 'mov', 'webm']);
                        $baseName = pathinfo($file, PATHINFO_FILENAME);
                    @endphp

                    @if ($isImage)
                        <!-- Tampilkan gambar -->
                        <img src="{{ asset('storage/' . $file) }}" alt="Media Gambar"
                            class="w-full h-auto rounded-lg shadow" />
                    @elseif ($isVideo)
                        <!-- Tampilkan video dengan kontrol dan subtitle jika ada -->
                        <video controls class="w-full rounded-lg shadow">
                            <source src="{{ asset('storage/' . $file) }}" type="video/{{ $ext }}">
                            <track src="{{ asset('storage/subtitles/' . $baseName . '.vtt') }}" kind="subtitles"
                                srclang="id" label="Bahasa Indonesia" default>
                            Browser tidak mendukung video tag.
                        </video>
                    @endif
                @endforeach
            </div>
        @endif
    </div>
</div>
