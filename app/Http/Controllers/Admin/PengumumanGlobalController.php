<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PengumumanGlobal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengumumanGlobalController extends Controller
{
  // Simpan pengumuman global baru
  public function store(Request $request)
  {
    $validated = $request->validate([
      'judul' => 'required|string|max:255',
      'isi'   => 'required|string|max:1000',
    ]);

    PengumumanGlobal::create([
      'user_id' => Auth::id(),
      ...$validated
    ]);

    return redirect()->route('admin.pengumuman.index')
      ->with('success', 'Pengumuman Global berhasil dipublikasikan!');
  }

  // Hapus pengumuman
  public function destroy($id)
  {
    $pengumuman = PengumumanGlobal::findOrFail($id);
    $pengumuman->delete();

    return redirect()->route('admin.pengumuman.index')
      ->with('success', 'Pengumuman Global berhasil dihapus!');
  }

  // daftar pengumuman global dengan pagination + search
  public function index(Request $request)
  {
    $query = PengumumanGlobal::query();

    // filter kalau ada pencarian
    if ($request->has('search') && $request->search) {
      $query->where(function ($q) use ($request) {
        $q->where('judul', 'like', '%' . $request->search . '%')
          ->orWhere('isi', 'like', '%' . $request->search . '%');
      });
    }

    $pengumumanGlobals = $query->latest()->paginate(10);

    // biar pagination nggak reset pencarian
    $pengumumanGlobals->appends(['search' => $request->search]);

    return view('admin.pages.pengumuman.index', compact('pengumumanGlobals'));
  }


  public function create()
  {
    return view('admin.pages.pengumuman.create');
  }

  public function edit($id)
  {
    $pengumuman = PengumumanGlobal::findOrFail($id);
    return view('admin.pages.pengumuman.edit', compact('pengumuman'));
  }

  public function update(Request $request, $id)
  {
    $validated = $request->validate([
      'judul' => 'required|string|max:255',
      'isi'   => 'required|string|max:1000',
    ]);

    $pengumuman = PengumumanGlobal::findOrFail($id);
    $pengumuman->update($validated);

    return redirect()->route('admin.pengumuman.index')
      ->with('success', 'Pengumuman Global berhasil diperbarui!');
  }

  
}
