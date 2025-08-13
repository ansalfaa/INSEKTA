@extends('layouts.admin.app')

@section('title', 'Daftar Postingan')

@section('content')
<h1>Daftar Postingan</h1>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table>
    <thead>
        <tr>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Komentar</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($postingan as $post)
            <tr>
                <td>{{ $post->judul }}</td>
                <td>{{ $post->user->name }}</td>
                <td>{{ $post->komentar->count() }}</td>
                <td>
                    <a href="{{ route('admin.konten.show', $post->id) }}">Detail</a>
                    <form action="{{ route('admin.konten.destroy', $post->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Yakin ingin hapus postingan ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{{ $postingan->links() }} {{-- Pagination --}}
@endsection
