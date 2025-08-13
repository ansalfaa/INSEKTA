<?php

namespace App\Http\Controllers;

use App\Models\Postingan;
use Illuminate\Http\Request;

class PostinganController extends Controller
{
  // Tampilkan daftar semua postingan (untuk admin)
  public function index()
  {
    // Ambil semua postingan beserta user, komentar, dan laporan (relasi)
    $postingan = Postingan::with(['user', 'komentar', 'laporan'])->latest()->paginate(10);

    return view('admin.pages.konten.index', compact('postingan'));
  }

  // Tampilkan detail postingan beserta komentar dan laporan
  public function show($id)
  {
    $postingan = Postingan::with(['user', 'komentar', 'laporan'])->findOrFail($id);

    return view('admin.pages.konten.show', compact('postingan'));
  }

  // Hapus postingan (misal kalau admin ingin menghapus karena melanggar)
  public function destroy($id)
  {
    $postingan = Postingan::findOrFail($id);
    $postingan->delete();

    return redirect()->route('admin.konten.index')->with('success', 'Postingan berhasil dihapus.');
  }

  // Kalau kamu butuh buat create dan update postingan lewat admin, bisa ditambahkan method create, store, edit, update juga
}
