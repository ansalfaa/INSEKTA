@extends('layouts.siswa.app')

@section('title', 'Dashboard Siswa')

@section('content')
    <x-siswa.create-post-card />

    @foreach ($postingan as $post)
        <x-siswa.post-card
            user-avatar="{{ asset('storage/profil/' . $post->user->foto) }}"
            username="{{ $post->user->username }}"
            time-ago="{{ $post->created_at->diffForHumans() }}"
            content="{{ $post->caption }}"
            :media="$post->media_url" />
    @endforeach
@endsection
