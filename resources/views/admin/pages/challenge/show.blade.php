    @extends('layouts.admin.app', [
        'hideHeader' => true,
        'hideSidebarRight' => true,
    ])

    @section('title', 'Detail Challenge')

    @section('content')
        <div class="p-4 sm:p-6 lg:p-8">

            <!-- Header Challenge -->
            <div class="flex flex-col sm:flex-row items-start sm:items-center sm:space-x-4 mb-6">
                <!-- Icon -->
                <div
                    class="flex items-center justify-center w-16 h-16 rounded-xl bg-primary-amber/20 text-primary-amber mb-4 sm:mb-0">
                    <i class="fas fa-trophy text-3xl"></i>
                </div>

                <!-- Judul + Deskripsi -->
                <div class="flex-1">
                    <h1 class="text-2xl font-bold text-gray-800">{{ $challenge->judul }}</h1>
                    <p class="text-gray-600 mt-2">{{ $challenge->deskripsi }}</p>

                    <!-- Status, Poin, Deadline -->
                    <div class="mt-4 flex flex-wrap gap-2 sm:gap-4">
                        <!-- Status -->
                        <span
                            class="px-3 py-1 text-sm font-medium rounded-full
                        @if (\Carbon\Carbon::now()->lessThan($challenge->deadline)) bg-green-100 text-green-700 
                        @else bg-red-100 text-red-700 @endif">
                            {{ \Carbon\Carbon::now()->lessThan($challenge->deadline) ? 'Sedang Berjalan' : 'Sudah Berakhir' }}
                        </span>

                        <!-- Poin -->
                        <span class="px-3 py-1 text-sm font-medium rounded-full bg-amber-100 text-amber-700">
                            <i class="fas fa-star mr-1"></i>{{ $challenge->poin }} Poin
                        </span>

                        <!-- Deadline -->
                        <span class="px-3 py-1 text-sm font-medium rounded-full bg-gray-100 text-gray-700">
                            <i class="fas fa-clock mr-1"></i>
                            {{ \Carbon\Carbon::parse($challenge->deadline)->format('d M Y H:i') }}
                            ({{ \Carbon\Carbon::parse($challenge->deadline)->diffForHumans() }})
                        </span>
                    </div>
                </div>
            </div>

            <!-- Statistik Peserta -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                <div class="bg-white rounded-xl shadow p-6 border flex flex-col items-center">
                    <p class="text-sm text-gray-500 mb-2">Total Peserta</p>
                    <p class="text-3xl font-bold text-blue-600">{{ $totalPeserta ?? 0 }}</p>
                </div>

                <div class="bg-white rounded-xl shadow p-6 border flex flex-col items-center">
                    <p class="text-sm text-gray-500 mb-2">Sudah Submit</p>
                    <p class="text-3xl font-bold text-green-600">{{ $sudahSubmit ?? 0 }}</p>
                </div>

                <div class="bg-white rounded-xl shadow p-6 border flex flex-col items-center">
                    <p class="text-sm text-gray-500 mb-2">Belum Submit</p>
                    <p class="text-3xl font-bold text-red-600">{{ $belumSubmit ?? 0 }}</p>
                </div>
            </div>


            <!-- Tab Navigasi -->
            <div x-data="{ tab: 'peserta' }" class="mt-8">
                <div class="flex justify-center">
                    <div class="flex rounded-full bg-gray-200 p-1">
                        <!-- Tab Peserta -->
                        <button @click="tab = 'peserta'"
                            :class="tab === 'peserta'
                                ?
                                'bg-primary-amber text-white font-semibold shadow' :
                                'text-gray-600 hover:text-gray-800'"
                            class="px-6 py-2 text-sm rounded-full transition flex items-center">
                            <i class="fas fa-users mr-2"></i> Peserta & Submission
                        </button>

                        <!-- Tab Galeri -->
                        <button @click="tab = 'galeri'"
                            :class="tab === 'galeri'
                                ?
                                'bg-primary-amber text-white font-semibold shadow' :
                                'text-gray-600 hover:text-gray-800'"
                            class="px-6 py-2 text-sm rounded-full transition flex items-center">
                            <i class="fas fa-images mr-2"></i> Galeri Media
                        </button>
                    </div>
                </div>

                <!-- Konten Peserta -->
                <div x-show="tab === 'peserta'" x-transition class="mt-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">
                        Daftar Peserta ({{ $totalPeserta ?? 0 }})
                    </h2>
                    @if (($totalPeserta ?? 0) > 0)
                        <div class="bg-white rounded-xl border p-4 shadow divide-y">
                            @foreach ($peserta as $user)
                                <div class="flex items-center justify-between py-2">
                                    <div class="flex items-center space-x-4">
                                        <div
                                            class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center text-gray-500">
                                            {{ strtoupper(substr($user->nama_lengkap, 0, 1)) }}
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-800">{{ $user->nama_lengkap }}</p>
                                            <p class="text-sm text-gray-500">{{ $user->username }}</p>
                                        </div>
                                    </div>
                                    <div>
                                        @php
                                            $submission = $submissions->firstWhere('user_id', $user->id);
                                        @endphp

                                        @if ($submission)
                                            <span
                                                class="px-3 py-1 text-sm font-medium rounded-full bg-green-100 text-green-700">
                                                Sudah Submit
                                            </span>
                                        @else
                                            <span class="px-3 py-1 text-sm font-medium rounded-full bg-red-100 text-red-700">
                                                Belum Submit
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="bg-white rounded-xl border p-6 shadow text-center text-gray-500">
                            <i class="fas fa-user-slash text-3xl mb-2"></i>
                            <p>Belum ada peserta</p>
                        </div>
                    @endif
                </div>

                <!-- Konten Galeri -->
                <div x-show="tab === 'galeri'" x-transition class="mt-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Galeri Media</h2>
                    @if (($sudahSubmit ?? 0) > 0)
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            <div class="bg-gray-100 h-32 rounded-lg flex items-center justify-center text-gray-400">
                                Preview media
                            </div>
                        </div>
                    @else
                        <div class="bg-white rounded-xl border p-6 shadow text-center text-gray-500">
                            <i class="fas fa-folder-open text-3xl mb-2"></i>
                            <p>Belum ada pengumpulan</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endsection
