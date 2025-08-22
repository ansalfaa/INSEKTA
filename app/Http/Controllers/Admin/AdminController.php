<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\PengumumanGlobal;
use App\Models\Challenge;

class AdminController extends Controller
{
    /**
     * Menampilkan halaman dashboard admin.
     */
    public function dashboard()
    {
        // Hitung jumlah berdasarkan role
        $totalAdmin = User::where('role_id', 1)->count();
        $totalGuru = User::where('role_id', 2)->count();
        $totalSiswa = User::where('role_id', 3)->count();

        // Data pendukung untuk dashboard
        $pengumuman = PengumumanGlobal::latest()->take(5)->get();
        $totalChallenge = Challenge::count();

        return view('admin.dashboard', [
            'totalAdmin' => $totalAdmin,
            'totalGuru'  => $totalGuru,
            'totalSiswa' => $totalSiswa,
            'pengumumans' => $pengumuman, // kumpulan pengumuman untuk list
            'pengumuman' => null,         // kosong untuk form create
            'totalChallenge' => $totalChallenge,
        ]);
    }
}
