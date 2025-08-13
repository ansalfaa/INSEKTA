<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController,
    AdminController,
    GuruController,
    SiswaController,
    SearchController,
    PengumumanGlobalController,
    ChallengeController,
};

// Halaman utama
Route::get('/', fn() => view('beranda'));

// Autentikasi
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Redirect setelah login
Route::get('/redirect', [AuthController::class, 'redirectByRole'])->middleware('auth')->name('redirect');

// Route yang membutuhkan login
Route::middleware(['auth'])->group(function () {

    // Route Admin
    Route::prefix('admin')->name('admin.')->group(function () {

        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        // CRUD Users (Admin, Guru, Siswa)
        Route::get('/users', [AdminController::class, 'index'])->name('users.index');
        Route::get('/users/create', [AdminController::class, 'create'])->name('users.create');
        Route::post('/users', [AdminController::class, 'store'])->name('users.store');
        Route::get('/users/{id}/edit', [AdminController::class, 'edit'])->name('users.edit');
        Route::put('/users/{id}', [AdminController::class, 'update'])->name('users.update');
        Route::delete('/users/{id}', [AdminController::class, 'destroy'])->name('users.destroy');

        // Filter users by role
        Route::get('/users/role/{role}', [AdminController::class, 'filterByRole'])->name('users.filter');

        // CRUD Pengumuman
        Route::get('/pengumuman', [PengumumanGlobalController::class, 'index'])->name('pengumuman.index');
        Route::get('/pengumuman/create', [PengumumanGlobalController::class, 'create'])->name('pengumuman.create');
        Route::post('/pengumuman', [PengumumanGlobalController::class, 'store'])->name('pengumuman.store');
        Route::get('/pengumuman/{id}/edit', [PengumumanGlobalController::class, 'edit'])->name('pengumuman.edit');
        Route::put('/pengumuman/{id}', [PengumumanGlobalController::class, 'update'])->name('pengumuman.update');
        Route::delete('/pengumuman/{id}', [PengumumanGlobalController::class, 'destroy'])->name('pengumuman.destroy');

        // CRUD Challenge
        Route::prefix('challenge')->name('challenge.')->group(function () {
            Route::get('/', [ChallengeController::class, 'index'])->name('index');
            Route::get('/create', [ChallengeController::class, 'create'])->name('create');
            Route::post('/', [ChallengeController::class, 'store'])->name('store');
            Route::get('/{challenge}', [ChallengeController::class, 'show'])->name('show');
            Route::get('/{challenge}/edit', [ChallengeController::class, 'edit'])->name('edit');
            Route::put('/{challenge}', [ChallengeController::class, 'update'])->name('update');
            Route::delete('/{challenge}', [ChallengeController::class, 'destroy'])->name('destroy');
        });
        // Route untuk konten (postingan)
        Route::get('/konten', [App\Http\Controllers\PostinganController::class, 'index'])->name('konten.index');
        Route::get('/konten/{id}', [App\Http\Controllers\PostinganController::class, 'show'])->name('konten.show');
        Route::delete('/konten/{id}', [App\Http\Controllers\PostinganController::class, 'destroy'])->name('konten.destroy');
    });

    // Route Guru
    Route::get('/guru/dashboard', [GuruController::class, 'index'])->name('guru.dashboard');

    // Route Search
    Route::get('/search', [SearchController::class, 'index'])->name('search');

    // Route Siswa
    Route::prefix('siswa')->name('siswa.')->group(function () {
        Route::get('/dashboard', [SiswaController::class, 'index'])->name('dashboard');
        Route::post('/postingan', [SiswaController::class, 'storePostingan'])->name('postingan.store');
        Route::get('/notifikasi', [SiswaController::class, 'notifikasi'])->name('pages.notifikasi');
        Route::get('/pesan', [SiswaController::class, 'pesan'])->name('pages.pesan');
        Route::get('/forum', [SiswaController::class, 'forum'])->name('pages.forum');
        Route::get('/challenge', [SiswaController::class, 'challenge'])->name('pages.challenge');
        Route::get('/polling', [SiswaController::class, 'polling'])->name('pages.polling');
        Route::get('/leaderboard', [SiswaController::class, 'leaderboard'])->name('pages.leaderboard');
    });
});
