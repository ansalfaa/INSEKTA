@extends('layouts.siswa.app')

@section('title', 'Cari Konten')

@section('content')
    <h1 class="text-2xl font-semibold mb-4">Hasil Pencarian untuk: "{{ $query }}"</h1>

    @if ($postingans->count())
        <div class="grid gap-4">
            @foreach ($postingans as $post)
                <div class="p-4 border rounded-lg shadow-sm bg-white">
                    <h2 class="text-lg font-semibold">{{ $post->judul ?? 'Tanpa Judul' }}</h2>
                    <p>{{ Str::limit($post->caption, 100) }}</p>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-gray-500">Tidak ada hasil ditemukan.</p>
    @endif
@endsection
