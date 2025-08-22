<?php

namespace App\Http\Controllers\Guru;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth; // Untuk mengakses autentikasi user

class GuruController extends Controller
{
    // Menampilkan halaman dashboard guru
    public function index()
    {
        $guru = Auth::user()->guru; // Mengambil data guru yang sedang login
        return view('guru.guru', compact('guru')); // Mengirim data guru ke view
    }
}
