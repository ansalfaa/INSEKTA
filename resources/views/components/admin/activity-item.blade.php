@props(['icon', 'title', 'description', 'time', 'color' => 'blue'])

<div class="flex items-start space-x-3 p-4 hover:bg-gray-50 rounded-xl transition-colors duration-200">
    {{-- Icon Container --}}
    <div class="w-10 h-10 bg-{{ $color }}-100 rounded-xl flex items-center justify-center flex-shrink-0">
        <i class="{{ $icon }} text-{{ $color }}-600 text-sm"></i>
    </div>

    {{-- Text Content --}}
    <div class="flex-1 min-w-0">
        {{-- Title --}}
        <p class="text-sm font-medium text-gray-900">{{ $title }}</p>

        {{-- Description --}}
        <p class="text-sm text-gray-600 mt-1">{{ $description }}</p>

        {{-- Timestamp --}}
        <p class="text-xs text-gray-500 mt-2">{{ $time }}</p>
    </div>
</div>
