<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; // Untuk menangani request HTTP
use App\Models\Postingan; // Model untuk postingan
use App\Models\User; // Model untuk user
use App\Models\Forum; // Model untuk forum
use App\Models\Polling; // Model untuk polling
use App\Models\Challenge; // Model untuk challenge

class SearchController extends Controller
{
  // Method untuk melakukan pencarian di beberapa model
  public function index(Request $request)
  {
    // Ambil query pencarian dari input
    $query = $request->input('q');

    // Cari postingan berdasarkan caption
    $postingans = Postingan::where('caption', 'like', '%' . $query . '%')->get();

    // Cari user berdasarkan username
    $users = User::where('username', 'like', '%' . $query . '%')->get();

    // Cari forum berdasarkan judul
    $forums = Forum::where('judul', 'like', '%' . $query . '%')->get();

    // Cari polling berdasarkan pertanyaan
    $pollings = Polling::where('pertanyaan', 'like', '%' . $query . '%')->get();

    // Cari challenge berdasarkan judul
    $challenges = Challenge::where('judul', 'like', '%' . $query . '%')->get();

    // Kirim semua data hasil pencarian ke view
    return view('siswa.pages.search-results', compact(
      'query',
      'postingans',
      'users',
      'forums',
      'pollings',
      'challenges'
    ));
  }
}
