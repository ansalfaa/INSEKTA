<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;

// Global 
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SearchController;

// Admin
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ChallengeController;
use App\Http\Controllers\Admin\PengumumanGlobalController;
use App\Http\Controllers\Admin\PostinganController;

// Guru
use App\Http\Controllers\Guru\GuruController;

// Siswa
use App\Http\Controllers\Siswa\SiswaController;

/*
|--------------------------------------------------------------------------
| Halaman Utama
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('beranda');
});

/*
|--------------------------------------------------------------------------
| Autentikasi
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/redirect', [AuthController::class, 'redirectByRole'])->name('redirect');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->middleware(['auth', RoleMiddleware::class . ':super_admin,administrator,admin'])->group(function () {

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Users (Admin, Guru, Siswa)
    Route::resource('users', UserController::class)->names('admin.users');
    Route::get('/users/role/{role}', [UserController::class, 'filterByRole'])->name('admin.users.filter');

    // Pengumuman Global
    Route::resource('pengumuman', PengumumanGlobalController::class)->names('admin.pengumuman');

    // Challenge
    Route::resource('challenge', ChallengeController::class)->names('admin.challenge');

    // Konten (Postingan)
    Route::resource('konten', PostinganController::class)->names('admin.konten');
});

/*
|--------------------------------------------------------------------------
| Guru Routes
|--------------------------------------------------------------------------
*/
Route::prefix('guru')->middleware(['auth', RoleMiddleware::class . ':guru'])->group(function () {
    Route::get('/dashboard', [GuruController::class, 'index'])->name('guru.dashboard');
});

/*
|--------------------------------------------------------------------------
| Search Routes
|--------------------------------------------------------------------------
*/
Route::get('/search', [SearchController::class, 'index'])->middleware('auth')->name('search');

/*
|--------------------------------------------------------------------------
| Siswa Routes
|--------------------------------------------------------------------------
*/
Route::prefix('siswa')->middleware(['auth', RoleMiddleware::class . ':siswa'])->group(function () {
    Route::get('/dashboard', [SiswaController::class, 'index'])->name('siswa.dashboard');
    Route::post('/postingan', [SiswaController::class, 'storePostingan'])->name('siswa.postingan.store');

    // Halaman siswa
    Route::get('/notifikasi', [SiswaController::class, 'notifikasi'])->name('siswa.pages.notifikasi');
    Route::get('/pesan', [SiswaController::class, 'pesan'])->name('siswa.pages.pesan');
    Route::get('/forum', [SiswaController::class, 'forum'])->name('siswa.pages.forum');
    Route::get('/challenge', [SiswaController::class, 'challenge'])->name('siswa.pages.challenge');
    Route::get('/polling', [SiswaController::class, 'polling'])->name('siswa.pages.polling');
    Route::get('/leaderboard', [SiswaController::class, 'leaderboard'])->name('siswa.pages.leaderboard');

    // Profile
    Route::get('/profile', [SiswaController::class, 'profile'])->name('siswa.pages.profile');
    Route::get('/profile/edit', [SiswaController::class, 'editProfile'])->name('siswa.profile.edit');
    Route::post('/profile/update', [SiswaController::class, 'updateProfile'])->name('siswa.profile.update');
});
