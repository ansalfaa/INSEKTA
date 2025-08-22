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
            // otomatis hilang setelah 3 detik
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
        <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 mb-2">📢 Daftar Pengumuman</h1>
                <p class="text-gray-600">Berikut adalah semua pengumuman yang sudah ditambahkan.</p>
            </div>
            <div class="mt-4 sm:mt-0">
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
                    @foreach ($pengumumanGlobals as $p)
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
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Modal Create --}}
    <div id="createPengumumanModal" class="fixed inset-0 bg-black/50 hidden flex items-center justify-center z-50">
        @include('admin.pages.pengumuman.create')
    </div>

    {{-- Modal Edit --}}
    <div id="editPengumumanModal" class="fixed inset-0 bg-black/50 hidden flex items-center justify-center z-50">
        @include('admin.pages.pengumuman.edit')
    </div>

    {{-- Modal Show --}}
    <div id="showPengumumanModal" class="fixed inset-0 bg-black/50 hidden flex items-center justify-center z-50">
        @include('admin.pages.pengumuman.show')
    </div>

    {{-- Modal Delete --}}
    <div id="deletePengumumanModal" class="fixed inset-0 bg-black/50 hidden flex items-center justify-center z-50">
        @include('admin.pages.pengumuman.delete')
    </div>
@endsection


@push('scripts')
    <script>
        // Buka Modal Create
        function openCreatePengumuman() {
            document.getElementById('createPengumumanModal').classList.remove('hidden');
            document.getElementById('createPengumumanModal').classList.add('flex');
        }

        function closeCreatePengumuman() {
            document.getElementById('createPengumumanModal').classList.add('hidden');
            document.getElementById('createPengumumanModal').classList.remove('flex');
        }

        // Buka Modal Edit
        function openEditPengumuman(p) {
            document.getElementById('editPengumumanId').value = p.id;
            document.getElementById('editJudul').value = p.judul;
            document.getElementById('editIsi').value = p.isi;

            // set action form edit
            document.getElementById('editPengumumanForm').action = '/admin/pengumuman/' + p.id;

            // munculin modal
            document.getElementById('editPengumumanModal').classList.remove('hidden');
            document.getElementById('editPengumumanModal').classList.add('flex');
        }

        //Tutup Modal Edit
        function closeEditPengumuman() {
            document.getElementById('editPengumumanModal').classList.add('hidden');
            document.getElementById('editPengumumanModal').classList.remove('flex');
        }

        // Buka Modal Show
        function openShowPengumuman(p) {
            document.getElementById('showPengumumanId').value = p.id;
            document.getElementById('showJudul').innerText = p.judul;
            document.getElementById('showIsi').innerText = p.isi;

            document.getElementById('showPengumumanModal').classList.remove('hidden');
            document.getElementById('showPengumumanModal').classList.add('flex');
        }

        // Tutup Modal Show
        function closeShowPengumuman() {
            document.getElementById('showPengumumanModal').classList.add('hidden');
            document.getElementById('showPengumumanModal').classList.remove('flex');
        }

        // Buka Modal Delete
        function openDeletePengumuman(id, judul) {
            document.getElementById('deleteJudul').innerText = judul;
            document.getElementById('deletePengumumanForm').action = '/admin/pengumuman/' + id;

            document.getElementById('deletePengumumanModal').classList.remove('hidden');
            document.getElementById('deletePengumumanModal').classList.add('flex');
        }
        
        // Buka Modal Delete
        function closeDeletePengumuman() {
            document.getElementById('deletePengumumanModal').classList.add('hidden');
            document.getElementById('deletePengumumanModal').classList.remove('flex');
        }
    </script>
@endpush
