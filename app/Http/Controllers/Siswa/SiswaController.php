<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Postingan;
use App\Models\PengumumanGlobal;

class SiswaController extends Controller
{
    public function __construct()
    {
        // Middleware untuk memastikan pengguna sudah login
        $this->middleware('auth');

        // Middleware tambahan untuk memastikan role pengguna adalah siswa
        $this->middleware(function ($request, $next) {
            $user = Auth::user();
            if (!$user || !$user->role || $user->role->nama_role !== 'siswa') {
                abort(403, 'Unauthorized');
            }
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        // Ambil data siswa yang sedang login
        $siswa = Auth::user()->siswa;

        // Ambil filter dari query string (jurusan / kelas)
        $filter = $request->query('filter');

        // Query dasar untuk mengambil postingan dengan relasi user
        $query = Postingan::with('user');

        // Filter postingan berdasarkan jurusan
        if ($filter === 'jurusan') {
            $query->where('jurusan_id', $siswa->jurusan_id);
        }
        // Filter postingan berdasarkan kelas
        elseif ($filter === 'kelas') {
            $query->where('kelas_id', $siswa->kelas_id);
        }

        // Ambil semua postingan terbaru
        $postingan = $query->latest()->paginate(10);

        // Ambil semua pengumuman global terbaru
        $pengumumanGlobals = PengumumanGlobal::latest()->get();

        // Kirim data ke view siswa.siswa
        return view('siswa.siswa', compact('siswa', 'postingan', 'pengumumanGlobals'));
    }

    public function storePostingan(Request $request)
    {
        // Validasi input postingan
        $request->validate([
            'caption' => 'required|string',
            'media.*' => 'nullable|file|mimes:jpg,jpeg,png,mp4,avi,pdf,docx|max:5120',
        ]);

        // Ambil user yang sedang login
        $user = Auth::user();
        $mediaPaths = [];

        // Simpan file media jika ada
        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $file) {
                $path = $file->store('media_postingan', 'public');
                $mediaPaths[] = $path;
            }
        }

        // Simpan postingan baru ke database
        Postingan::create([
            'user_id'     => $user->id,
            'caption'     => $request->caption,
            'media_url'   => json_encode($mediaPaths),
            'visibilitas' => 'umum',
            'jurusan_id'  => $user->siswa->jurusan_id ?? null,
            'kelas_id'    => $user->siswa->kelas_id ?? null,
        ]);

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Postingan berhasil dibuat!');
    }

    public function notifikasi()
    {
        return view('siswa.pages.notifikasi');
    }

    public function pesan()
    {
        return view('siswa.pages.pesan');
    }

    public function forum()
    {
        return view('siswa.pages.forum');
    }

    public function challenge()
    {
        return view('siswa.pages.challenge');
    }

    public function polling()
    {
        return view('siswa.pages.polling');
    }

    public function leaderboard()
    {
        return view('siswa.pages.leaderboard');
    }

    public function profile()
    {
        return view('siswa.pages.profile');
    }
}
