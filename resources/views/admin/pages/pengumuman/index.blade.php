@extends('layouts.admin.app', [
    'hideSidebarRight' => true,
])

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

    <div class="p-4 sm:p-6 lg:p-8">
        <!-- Header Halaman -->
        <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 mb-2">📢 Daftar Pengumuman</h1>
                <p class="text-gray-600">Berikut adalah semua pengumuman yang sudah ditambahkan.</p>
            </div>

            <div class="flex flex-col sm:flex-row items-center gap-3">

                <!-- Form Search -->
                <form method="GET" action="{{ route('admin.pengumuman.index') }}" class="relative w-64">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                        <i class="fas fa-search"></i>
                    </span>
                    <input id="searchInput" type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari pengumuman..."
                        class="pl-10 pr-4 py-2 border rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 text-sm" />
                </form>


                <!-- Tombol Tambah -->
                <button onclick="openCreatePengumuman()"
                    class="px-4 py-2 bg-gradient-to-r from-amber-500 to-orange-500 text-white rounded-lg shadow hover:from-amber-600 hover:to-orange-600">
                    <i class="fas fa-plus mr-2"></i> Tambah Pengumuman
                </button>
            </div>
        </div>

        <!-- Tabel -->
        <div class="overflow-x-auto">
            <table class="w-full border border-gray-200 rounded-lg min-w-[700px] table-auto">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-3 border-b text-left text-sm w-1/4">Judul</th>
                        <th class="px-4 py-3 border-b text-left text-sm w-1/2">Isi</th>
                        <th class="px-4 py-3 border-b text-left text-sm w-1/6">Tanggal</th>
                        <th class="px-4 py-3 border-b text-center text-sm w-1/6">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pengumumanGlobals as $p)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-3 text-sm font-medium text-gray-800">{{ $p->judul }}</td>
                            <td class="px-4 py-3 text-sm">
                                <span class="line-clamp-2">{{ $p->isi }}</span>
                                @if (strlen($p->isi) > 100)
                                    <button onclick='openShowPengumuman(@json($p))'
                                        class="text-amber-600 hover:underline text-xs ml-2">
                                        Lihat Selengkapnya
                                    </button>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-600">
                                {{ \Carbon\Carbon::parse($p->created_at)->translatedFormat('d M Y, H:i') }}
                            </td>
                            <td class="px-4 py-3 text-center">
                                <div class="flex items-center justify-center space-x-4">
                                    <button onclick='openShowPengumuman(@json($p))'
                                        class="text-amber-600 hover:text-amber-800" title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button onclick='openEditPengumuman(@json($p))'
                                        class="text-amber-600 hover:text-amber-800" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button type="button"
                                        onclick="openDeletePengumuman({{ $p->id }}, '{{ $p->judul }}')"
                                        class="text-red-600 hover:text-red-800" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-6 text-center text-gray-500">
                                Belum ada pengumuman.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $pengumumanGlobals->links() }}
        </div>
    </div>

    {{-- Modal --}}
    <div id="createPengumumanModal" class="fixed inset-0 bg-black/50 hidden flex items-center justify-center z-50">
        @include('admin.pages.pengumuman.create')
    </div>

    <div id="editPengumumanModal" class="fixed inset-0 bg-black/50 hidden flex items-center justify-center z-50">
        @include('admin.pages.pengumuman.edit')
    </div>

    <div id="showPengumumanModal" class="fixed inset-0 bg-black/50 hidden flex items-center justify-center z-50">
        @include('admin.pages.pengumuman.show')
    </div>

    <div id="deletePengumumanModal" class="fixed inset-0 bg-black/50 hidden flex items-center justify-center z-50">
        @include('admin.pages.pengumuman.delete')
    </div>
@endsection

@push('scripts')
    <script>
        // Buka Modal Create
        function openCreatePengumuman() {
            toggleModal('createPengumumanModal', true);
        }

        function closeCreatePengumuman() {
            toggleModal('createPengumumanModal', false);
        }

        // Buka Modal Edit
        function openEditPengumuman(p) {
            document.getElementById('editPengumumanId').value = p.id;
            document.getElementById('editJudul').value = p.judul;
            document.getElementById('editIsi').value = p.isi;
            document.getElementById('editPengumumanForm').action = '/admin/pengumuman/' + p.id;
            toggleModal('editPengumumanModal', true);
        }

        function closeEditPengumuman() {
            toggleModal('editPengumumanModal', false);
        }

        // Buka Modal Show
        function openShowPengumuman(p) {
            document.getElementById('showPengumumanId').value = p.id;
            document.getElementById('showJudul').innerText = p.judul;
            document.getElementById('showIsi').innerText = p.isi;
            toggleModal('showPengumumanModal', true);
        }

        function closeShowPengumuman() {
            toggleModal('showPengumumanModal', false);
        }

        // Buka Modal Delete
        function openDeletePengumuman(id, judul) {
            document.getElementById('deleteJudul').innerText = judul;
            document.getElementById('deletePengumumanForm').action = '/admin/pengumuman/' + id;
            toggleModal('deletePengumumanModal', true);
        }

        function closeDeletePengumuman() {
            toggleModal('deletePengumumanModal', false);
        }

        // Helper toggle modal
        function toggleModal(id, show = true) {
            const modal = document.getElementById(id);
            if (show) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            } else {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }
        }

        // 🔍 Auto submit search ketika ngetik 
        let timer;
        const searchInput = document.getElementById("searchInput");
        if (searchInput) {
            searchInput.addEventListener("input", function() {
                clearTimeout(timer);
                timer = setTimeout(() => {
                    this.form.submit();
                }, 500); // 0.5 detik setelah berhenti ngetik baru jalan
            });
        }
    </script>
@endpush
