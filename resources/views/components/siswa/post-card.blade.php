@props(['userAvatar', 'username', 'timeAgo', 'content', 'media' => []])

<article class="bg-white/95 backdrop-blur-sm rounded-2xl shadow-lg border border-amber-100/50 overflow-hidden transition-all duration-300 hover:shadow-xl hover:border-amber-200/70">
    <!-- Header Postingan -->
    <header class="flex items-center justify-between p-6 pb-4">
        <div class="flex items-center space-x-4">
            <div class="relative">
                <div class="h-12 w-12 rounded-full overflow-hidden ring-2 ring-amber-200/50 transition-all duration-200 hover:ring-amber-300">
                    <img src="{{ $userAvatar }}" alt="{{ $username }} Avatar" class="w-full h-full object-cover" />
                </div>
                <!-- Online indicator (optional) -->
                <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-400 rounded-full border-2 border-white"></div>
            </div>
            <div class="flex flex-col">
                <h3 class="font-bold text-gray-900 text-base hover:text-amber-700 transition-colors cursor-pointer">
                    {{ $username }}
                </h3>
                <time class="text-sm text-gray-500 font-medium">{{ $timeAgo }}</time>
            </div>
        </div>
        
        <!-- Post Options -->
        <div class="relative">
            <button type="button" 
                    class="p-2 rounded-full hover:bg-amber-50 transition-all duration-200 group"
                    aria-label="Opsi Postingan">
                <svg class="w-5 h-5 text-gray-400 group-hover:text-amber-600 transition-colors" 
                     fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="1" />
                    <circle cx="19" cy="12" r="1" />
                    <circle cx="5" cy="12" r="1" />
                </svg>
            </button>
        </div>
    </header>

    <!-- Konten Postingan -->
    <div class="px-6 pb-4">
        <!-- Text Content -->
        @if($content)
            <div class="prose prose-sm max-w-none mb-4">
                <p class="text-gray-800 leading-relaxed whitespace-pre-wrap break-words">
                    {!! nl2br(e($content)) !!}
                </p>
            </div>
        @endif

        <!-- Media Content -->
        @php
            $mediaList = is_array($media) ? $media : json_decode($media, true);
        @endphp

        @if (!empty($mediaList))
            <div class="mt-4 rounded-xl overflow-hidden">
                @if(count($mediaList) == 1)
                    <!-- Single Media -->
                    @php
                        $file = $mediaList[0];
                        $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                        $isImage = in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp']);
                        $isVideo = in_array($ext, ['mp4', 'avi', 'mov', 'webm']);
                    @endphp
                    
                    @if ($isImage)
                        <img src="{{ asset('storage/' . $file) }}" 
                             alt="Media Postingan"
                             class="w-full h-auto max-h-96 object-cover rounded-xl shadow-md hover:shadow-lg transition-shadow cursor-pointer" />
                    @elseif ($isVideo)
                        <video controls class="w-full max-h-96 rounded-xl shadow-md">
                            <source src="{{ asset('storage/' . $file) }}" type="video/{{ $ext }}">
                            Browser tidak mendukung video tag.
                        </video>
                    @endif
                @else
                    <!-- Multiple Media Grid -->
                    <div class="grid grid-cols-2 gap-2 {{ count($mediaList) > 4 ? 'grid-rows-2' : '' }}">
                        @foreach (array_slice($mediaList, 0, 4) as $index => $file)
                            @php
                                $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                                $isImage = in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp']);
                                $isVideo = in_array($ext, ['mp4', 'avi', 'mov', 'webm']);
                            @endphp
                            
                            <div class="relative {{ $index == 0 && count($mediaList) == 3 ? 'row-span-2' : '' }}">
                                @if ($isImage)
                                    <img src="{{ asset('storage/' . $file) }}" 
                                         alt="Media {{ $index + 1 }}"
                                         class="w-full h-48 object-cover rounded-lg shadow hover:shadow-md transition-shadow cursor-pointer" />
                                @elseif ($isVideo)
                                    <video controls class="w-full h-48 object-cover rounded-lg shadow">
                                        <source src="{{ asset('storage/' . $file) }}" type="video/{{ $ext }}">
                                    </video>
                                @endif
                                
                                <!-- More indicator for 4+ images -->
                                @if($index == 3 && count($mediaList) > 4)
                                    <div class="absolute inset-0 bg-black/60 rounded-lg flex items-center justify-center">
                                        <span class="text-white font-bold text-lg">+{{ count($mediaList) - 4 }}</span>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        @endif
    </div>

    <!-- Post Actions -->
    <footer class="px-6 py-4 border-t border-amber-100/50 bg-gradient-to-r from-amber-50/30 to-transparent">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-6">
                <!-- Like Button -->
                <button class="flex items-center space-x-2 text-gray-600 hover:text-red-500 transition-colors group">
                    <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                    <span class="text-sm font-medium">Suka</span>
                </button>
                
                <!-- Comment Button -->
                <button class="flex items-center space-x-2 text-gray-600 hover:text-blue-500 transition-colors group">
                    <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    <span class="text-sm font-medium">Komentar</span>
                </button>
                
                <!-- Share Button -->
                <button class="flex items-center space-x-2 text-gray-600 hover:text-green-500 transition-colors group">
                    <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z" />
                    </svg>
                    <span class="text-sm font-medium">Bagikan</span>
                </button>
            </div>
            
            <!-- Bookmark Button -->
            <button class="text-gray-600 hover:text-amber-500 transition-colors group">
                <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                </svg>
            </button>
        </div>
    </footer>
</article>
