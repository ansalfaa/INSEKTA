@extends('layouts.admin.app')

@section('title', 'Tambah Pengumuman')

@section('content')
{{-- Removed header section and improved container styling --}}
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Simplified Title Section --}}
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
            <div class="text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-amber-100 mb-4">
                    <svg class="h-6 w-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
                    </svg>
                </div>
                <h1 class="text-2xl font-bold text-gray-900 mb-2">Buat Pengumuman Baru</h1>
                <p class="text-gray-600">Sampaikan informasi penting kepada semua pengguna sistem</p>
            </div>
        </div>

        {{-- Enhanced Form Container --}}
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            @include('components.admin.create-pengumuman', [
                'pengumuman' => null,
                'action' => route('admin.pengumuman.store'),
                'method' => 'POST'
            ])
        </div>

        {{-- Added helpful tips section --}}
        <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-blue-800">Tips Pengumuman Efektif</h3>
                    <div class="mt-2 text-sm text-blue-700">
                        <ul class="list-disc list-inside space-y-1">
                            <li>Gunakan judul yang jelas dan menarik perhatian</li>
                            <li>Sertakan tanggal berlaku jika pengumuman bersifat sementara</li>
                            <li>Gunakan bahasa yang mudah dipahami semua pengguna</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
