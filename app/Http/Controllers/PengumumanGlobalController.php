<?php

namespace App\Http\Controllers;

use App\Models\PengumumanGlobal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengumumanGlobalController extends Controller
{
  // Simpan pengumuman global baru
  public function store(Request $request)
  {
    $request->validate([
      'judul' => 'required|string|max:255',
      'isi'   => 'required|string|max:1000',
    ]);

    PengumumanGlobal::create([
      'user_id' => Auth::id(),
      'judul'   => $request->judul,
      'isi'     => $request->isi,
    ]);

    return redirect()->route('admin.dashboard')
      ->with('success', 'Pengumuman Global berhasil dipublikasikan!');
  }

  // Tampilkan daftar pengumuman global dengan pagination
  public function index()
  {
    $pengumumanGlobals = PengumumanGlobal::latest()->paginate(10);

    return view('admin.pages.pengumuman.index', compact('pengumumanGlobals'));
  }
  public function create()
  {
    return view('admin.pages.pengumuman.create');
  }
}
