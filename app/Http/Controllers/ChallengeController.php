<?php

namespace App\Http\Controllers;

use App\Models\Challenge;
use Illuminate\Http\Request;

class ChallengeController extends Controller
{
  /**
   * Menampilkan daftar challenge.
   */
  public function index()
  {
    $challenges = Challenge::latest()->get();
    return view('admin.pages.challenge.index', compact('challenges'));
  }

  /**
   * Menampilkan form tambah challenge.
   */
  public function create()
  {
    return view('admin.pages.challenge.create');
  }

  /**
   * Menyimpan challenge baru ke database.
   */
  public function store(Request $request)
  {
    // Validasi input
    $validated = $request->validate([
      'judul'     => 'required|string|max:255',
      'deskripsi' => 'required|string',
      'deadline'  => 'required|date',
      'poin'      => 'required|integer|min:0',
    ]);

    // Simpan data ke database
    Challenge::create($validated);

    // Redirect ke index dengan pesan sukses
    return redirect()->route('admin.challenge.index')
      ->with('success', 'Challenge berhasil dibuat.');
  }

  /**
   * Menampilkan form edit challenge.
   */
  public function edit(Challenge $challenge)
  {
    return view('admin.pages.challenge.edit', compact('challenge'));
  }

  /**
   * Update data challenge.
   */
  public function update(Request $request, Challenge $challenge)
  {
    $validated = $request->validate([
      'judul'     => 'required|string|max:255',
      'deskripsi' => 'required|string',
      'deadline'  => 'required|date',
      'poin'      => 'required|integer|min:0',
    ]);

    $challenge->update($validated);

    return redirect()->route('admin.challenge.index')
      ->with('success', 'Challenge berhasil diperbarui.');
  }

  /**
   * Hapus challenge dari database.
   */
  public function destroy(Challenge $challenge)
  {
    $challenge->delete();

    return redirect()->route('admin.challenge.index')
      ->with('success', 'Challenge berhasil dihapus.');
  }

  public function show(Challenge $challenge)
  {
    return view('admin.pages.challenge.show', compact('challenge'));
  }
  
}
