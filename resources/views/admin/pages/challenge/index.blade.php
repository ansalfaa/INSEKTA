@extends('layouts.admin.app', ['hideSidebarRight' => true])

@section('content')
    {{-- Toast Notifikasi --}}
    @if (session('success'))
        <div id="toastSuccess"
            class="fixed top-5 right-5 bg-gradient-to-r from-amber-500 to-orange-500 text-white px-4 py-3 rounded-lg shadow-lg flex items-center space-x-2 z-50 animate-slide-in">
            <i class="fas fa-check-circle"></i>
            <span>{{ session('success') }}</span>
        </div>

        <script>
            setTimeout(() => {
                document.getElementById('toastSuccess').classList.add('hidden');
            }, 3000);
        </script>

        <style>
            @keyframes slide-in {
                from {
                    opacity: 0;
                    transform: translateX(100%);
                }

                to {
                    opacity: 1;
                    transform: translateX(0);
                }
            }

            .animate-slide-in {
                animation: slide-in 0.4s ease-out;
            }
        </style>
    @endif

    <!-- Header -->
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div class="flex items-center">
            <div class="inline-flex items-center justify-center w-10 h-10 bg-primary-amber rounded-lg mr-3">
                <i class="fas fa-trophy text-white text-lg"></i>
            </div>
            <div>
                <h1 class="text-xl sm:text-2xl font-bold text-gray-800">Daftar Challenge</h1>
                <p class="text-sm text-gray-600">Kelola semua challenge yang tersedia</p>
            </div>
        </div>

        {{-- Tombol Tambah --}}
        <button onclick="openCreateChallenge()"
            class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-primary-amber to-orange-500 text-white rounded-lg hover:from-orange-500 hover:to-primary-amber transition-all duration-300 font-medium shadow-md hover:shadow-lg text-sm">
            <i class="fas fa-plus mr-2"></i>Tambah Challenge
        </button>
    </div>

    <!-- Konten -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        @if ($challenges->isEmpty())
            {{-- Empty state --}}
            <div class="text-center py-12">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 rounded-full mb-4">
                    <i class="fas fa-trophy text-2xl text-gray-400"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Belum Ada Challenge</h3>
                <p class="text-gray-600 mb-4 text-sm">Mulai buat challenge pertama untuk meningkatkan engagement</p>
                <button onclick="openCreateChallenge()"
                    class="inline-flex items-center px-4 py-2 bg-primary-amber text-white rounded-lg hover:bg-orange-500 transition-all duration-300 font-medium text-sm">
                    <i class="fas fa-plus mr-2"></i>Buat Challenge Pertama
                </button>
            </div>
        @else
            <!-- Table Header -->
            <div class="bg-gradient-to-r from-primary-amber to-orange-500 p-4">
                <h2 class="text-lg font-semibold text-white flex items-center">
                    <i class="fas fa-list mr-2"></i>
                    Semua Challenge ({{ $challenges->total() }})
                </h2>
            </div>

            <!-- Desktop Table -->
            <div class="hidden lg:block overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-amber-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700">#</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700">Challenge</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700">Deskripsi</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700">Poin</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700">Deadline</th>
                            <th class="px-4 py-3 text-center text-xs font-semibold text-gray-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($challenges as $challenge)
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $loop->iteration }}</td>
                                <td class="px-4 py-3 font-semibold text-gray-800 text-sm">{{ $challenge->judul }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600 max-w-xs">
                                    {{ Str::limit($challenge->deskripsi, 60) }}
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $challenge->poin }} XP</td>
                                <td class="px-4 py-3 text-sm text-gray-600">
                                    {{ \Carbon\Carbon::parse($challenge->deadline)->format('d M Y') }}
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <div class="flex items-center justify-center space-x-2">
                                        <a href="{{ route('admin.challenge.show', $challenge->id) }}"
                                            class="text-blue-600 hover:text-blue-800" title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <button class="text-amber-600 hover:text-amber-800" title="Edit"
                                            onclick="openEditChallenge(this)" data-id="{{ $challenge->id }}"
                                            data-judul="{{ $challenge->judul }}"
                                            data-deskripsi="{{ e($challenge->deskripsi) }}"
                                            data-poin="{{ $challenge->poin }}" data-deadline="{{ $challenge->deadline }}">
                                            <i class="fas fa-edit"></i>
                                        </button>


                                        <button type="button"
                                            onclick="openDeleteChallenge({{ $challenge->id }}, '{{ $challenge->judul }}')"
                                            class="text-red-600 hover:text-red-800" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- Pagination --}}
                <div class="p-4">
                    {{ $challenges->links() }}
                </div>
            </div>

            <!-- Mobile Card -->
            <div class="lg:hidden p-4 space-y-3">
                @foreach ($challenges as $c)
                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                        <div class="flex items-center justify-between mb-3">
                            <h3 class="font-semibold text-gray-800 text-sm">{{ $c->judul }}</h3>
                            <span class="text-xs text-gray-500">{{ $c->poin }} XP</span>
                        </div>
                        <p class="text-sm text-gray-600 mb-3">{{ Str::limit($c->deskripsi, 80) }}</p>
                        <div class="flex justify-between items-center text-xs text-gray-500">
                            <span>Deadline: {{ \Carbon\Carbon::parse($c->deadline)->format('d M Y') }}</span>
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.challenge.show', $c->id) }}"
                                    class="text-blue-600 hover:text-blue-800">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <button class="text-amber-600 hover:text-amber-800" title="Edit"
                                    onclick="openEditChallenge(this)" data-id="{{ $c->id }}"
                                    data-judul="{{ $c->judul }}" data-deskripsi="{{ e($c->deskripsi) }}"
                                    data-poin="{{ $c->poin }}" data-deadline="{{ $c->deadline }}">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button onclick="openDeleteChallenge({{ $c->id }}, '{{ $c->judul }}')"
                                    class="text-red-600 hover:text-red-800">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    {{-- Modal Create --}}
    <div id="createChallengeModal" class="fixed inset-0 bg-black/50 hidden flex items-center justify-center z-50">
        @include('admin.pages.challenge.create')
    </div>

    {{-- Modal Edit --}}
    <div id="editChallengeModal" class="fixed inset-0 bg-black/50 hidden flex items-center justify-center z-50">
        @include('admin.pages.challenge.edit')
    </div>

    {{-- Modal Delete --}}
    <div id="deleteChallengeModal" class="fixed inset-0 bg-black/50 hidden flex items-center justify-center z-50">
        @include('admin.pages.challenge.delete')
    </div>


@endsection

@push('scripts')
    <script>
        function openCreateChallenge() {
            toggleModal('createChallengeModal', true);
        }

        function closeCreateChallenge() {
            toggleModal('createChallengeModal', false);
        }

        function openEditChallenge(el) {
            document.getElementById('editChallengeId').value = el.dataset.id;
            document.getElementById('editChallengeJudul').value = el.dataset.judul;
            document.getElementById('editChallengeDeskripsi').value = el.dataset.deskripsi;
            document.getElementById('editChallengePoin').value = el.dataset.poin;
            document.getElementById('editChallengeDeadline').value = el.dataset.deadline ? el.dataset.deadline.substring(0,
                10) : '';
            document.getElementById('editChallengeForm').action = '/admin/challenge/' + el.dataset.id;
            toggleModal('editChallengeModal', true);
        }
        function closeEditChallenge() {
            toggleModal('editChallengeModal', false);
        }


        function openDeleteChallenge(id, judul) {
            document.getElementById('deleteChallengeId').value = id;
            document.getElementById('deleteChallengeJudul').textContent = judul;
            document.getElementById('deleteChallengeForm').action = `/admin/challenge/${id}`;
            toggleModal('deleteChallengeModal', true);
        }

        function closeDeleteChallenge() {
            toggleModal('deleteChallengeModal', false);
        }

        function toggleModal(id, show = true) {
            const modal = document.getElementById(id);
            if (!modal) return;
            if (show) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            } else {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }
        }
    </script>
@endpush
