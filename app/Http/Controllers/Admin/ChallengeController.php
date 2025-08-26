<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Challenge;
use Illuminate\Http\Request;

class ChallengeController extends Controller
{
  /**
   * Tampilkan daftar challenge.
   */
  public function index()
  {
    $challenges = Challenge::withCount('peserta')
      ->latest()
      ->paginate(10);

    return view('admin.pages.challenge.index', compact('challenges'));
  }

  /**
   * Tampilkan form tambah challenge.
   */
  public function create()
  {
    return view('admin.pages.challenge.create');
  }

  /**
   * Simpan challenge baru.
   */
  public function store(Request $request)
  {
    $validated = $request->validate([
      'judul'     => 'required|string|max:255',
      'deskripsi' => 'required|string',
      'deadline'  => 'required|date',
      'poin'      => 'required|integer|min:0',
    ]);

    Challenge::create($validated);

    return redirect()->route('admin.challenge.index')
      ->with('success', 'Challenge berhasil dibuat.');
  }

  /**
   * Tampilkan form edit challenge.
   */
  public function edit(Challenge $challenge)
  {
    return view('admin.pages.challenge.edit', compact('challenge'));
  }

  /**
   * Update challenge.
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
   * Hapus challenge.
   */
  public function destroy(Challenge $challenge)
  {
    try {
      $challenge->delete();
      return redirect()->route('admin.challenge.index')
        ->with('success', 'Challenge berhasil dihapus.');
    } catch (\Throwable $e) {
      return redirect()->route('admin.challenge.index')
        ->with('error', 'Challenge gagal dihapus, mungkin ada data terkait.');
    }
  }

  /**
   * Detail challenge (peserta & statistik).
   */
  public function show(Challenge $challenge)
  {
    $peserta = $challenge->peserta; // User collection
    $submissions = $challenge->submissions; // PartisipasiChallenge collection

    $totalPeserta = $peserta->count();
    $sudahSubmit  = $submissions->count();
    $belumSubmit  = $totalPeserta - $sudahSubmit;

    return view('admin.pages.challenge.show', compact(
      'challenge',
      'peserta',
      'submissions',
      'totalPeserta',
      'sudahSubmit',
      'belumSubmit'
    ));
  }
}
