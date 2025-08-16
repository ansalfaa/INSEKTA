<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Siswa; // Model Siswa
use App\Models\Guru;  // Model Guru
use App\Models\PengumumanGlobal; // Tambahkan ini
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Hash, Auth, DB}; // Hash pwd, Auth, DB transaction
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    // Konstanta ID Role
    const ROLE_ADMIN = 1;
    const ROLE_GURU  = 2;
    const ROLE_SISWA = 3;

    // Halaman Dashboard Admin
    public function dashboard()
    {
        $user = Auth::user(); // User yang login

        $stats = [
            'totalUsers'  => User::count(),
            'totalAdmins' => User::where('role_id', self::ROLE_ADMIN)->count(),
            'totalGurus'  => User::where('role_id', self::ROLE_GURU)->count(),
            'totalSiswa'  => User::where('role_id', self::ROLE_SISWA)->count(),
        ];

        // Ambil pengumuman terbaru (misal 5)
        $pengumumanGlobals = PengumumanGlobal::latest()->get();

        // Kirim semua data ke view sekaligus
        return view('admin.admin', compact('user', 'stats', 'pengumumanGlobals'));
    }

    // List Users + Filter + Search
    public function index(Request $request)
    {
        // Query + relasi siswa/guru + filter role + search
        $query = User::with('role', 'siswa.kelas', 'siswa.jurusan', 'guru')
            ->when($request->role, fn($q) => $q->whereHas('role', fn($r) => $r->where('nama_role', $request->role)))
            ->when($request->search, fn($q) => $q->where(
                fn($sub) =>
                $sub->where('username', 'like', "%{$request->search}%")
                    ->orWhere('nama_lengkap', 'like', "%{$request->search}%")
            ));

        $users = $query->paginate(10);

        // Ambil pengumuman terbaru juga supaya sidebar tidak error
        $pengumumanGlobals = PengumumanGlobal::latest()->take(5)->get();

        // Tambahkan perhitungan statistik (tidak terpengaruh filter)
        $rolesCount = [
            'admin' => User::where('role_id', self::ROLE_ADMIN)->count(),
            'guru'  => User::where('role_id', self::ROLE_GURU)->count(),
            'siswa' => User::where('role_id', self::ROLE_SISWA)->count(),
        ];

        $totalUsers = User::count();

        return view('admin.pages.users.index', [
            'users' => $users,
            'roles' => Role::all(),
            'jurusans' => Jurusan::all(),
            'kelases' => Kelas::all(),
            'pengumumanGlobals' => $pengumumanGlobals,
            'rolesCount' => $rolesCount,  // ⬅️ kirim ke view
            'totalUsers' => $totalUsers,  // ⬅️ kirim ke view
        ]);
    }


    // Filter User berdasarkan Role
    public function filterByRole($role)
    {
        // Tambahkan juga pengumuman supaya konsisten jika sidebar juga dipakai di view ini
        $pengumumanGlobals = PengumumanGlobal::latest()->take(5)->get();

        return view('admin.pages.users.index', [
            'users' => User::with('role', 'siswa.kelas', 'siswa.jurusan', 'guru')
                ->where('role_id', $role)->paginate(10),
            'roles' => Role::all(),
            'pengumumanGlobals' => $pengumumanGlobals,
        ]);
    }

    // Form Tambah User
    public function create()
    {
        // Kalau sidebar juga muncul di halaman create, bisa kirim pengumuman juga
        $pengumumanGlobals = PengumumanGlobal::latest()->take(5)->get();

        return view('admin.pages.users.create', [
            'roles'    => Role::all(),
            'jurusans' => Jurusan::all(),
            'kelases'  => Kelas::all(),
            'pengumumanGlobals' => $pengumumanGlobals,
        ]);
    }

    // Simpan User Baru
    public function store(Request $request)
    {
        // Validasi umum
        $rules = [
            'username'      => 'required|unique:users|min:3|max:50',
            'password'      => 'required|min:6|confirmed',
            'role_id'       => 'required|exists:roles,id',
            'nama_lengkap'  => 'required|string|max:100',
        ];

        // Validasi tambahan sesuai Role
        if ($request->role_id == self::ROLE_SISWA) {
            $rules['nis']        = 'required|unique:siswas,nis|string|max:20';
            $rules['jurusan_id'] = 'required|exists:jurusans,id';
            $rules['kelas_id']   = 'required|exists:kelas,id';
        } elseif ($request->role_id == self::ROLE_GURU) {
            $rules['nip']            = 'required|unique:gurus,nip|string|max:20';
            $rules['mata_pelajaran'] = 'required|string|max:100';
        }

        $request->validate($rules);

        // Simpan data dengan transaksi DB
        DB::transaction(function () use ($request) {
            // Buat akun user
            $user = User::create([
                'username'     => $request->username,
                'password'     => Hash::make($request->password),
                'role_id'      => $request->role_id,
                'nama_lengkap' => $request->nama_lengkap,
            ]);

            // Buat data siswa & guru
            if ($request->role_id == self::ROLE_SISWA) {
                Siswa::create([
                    'user_id'      => $user->id,
                    'nis'          => $request->nis,
                    'kelas_id'     => $request->kelas_id,
                    'jurusan_id'   => $request->jurusan_id,
                    'nama_lengkap' => $request->nama_lengkap,
                ]);
            } elseif ($request->role_id == self::ROLE_GURU) {
                Guru::create([
                    'user_id'        => $user->id,
                    'nip'            => $request->nip,
                    'mata_pelajaran' => $request->mata_pelajaran,
                    'nama_lengkap'   => $request->nama_lengkap,
                ]);
            }
        });

        return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan.');
    }

    // Form Edit User
    public function edit($id)
    {
        $user = User::with('siswa', 'guru')->findOrFail($id); // Ambil user + relasi

        $pengumumanGlobals = PengumumanGlobal::latest()->take(5)->get();

        return view('admin.pages.users.edit', [
            'user'     => $user,
            'roles'    => Role::all(),
            'jurusans' => Jurusan::all(),
            'kelases'  => Kelas::all(),
            'pengumumanGlobals' => $pengumumanGlobals,
        ]);
    }

    // Update User
    public function update(Request $request, $id)
    {
        $user = User::with('siswa', 'guru')->findOrFail($id); // User + relasi
        $currentRoleId = $user->role_id; // Role sebelum update

        // Validasi umum
        $rules = [
            'username'      => ['required', 'min:3', 'max:50', Rule::unique('users')->ignore($user->id)],
            'password'      => 'nullable|min:6|confirmed',
            'role_id'       => 'required|exists:roles,id',
            'nama_lengkap'  => 'required|string|max:100',
        ];

        // Validasi tambahan sesuai Role
        if ($request->role_id == self::ROLE_SISWA) {
            $rules['nis']        = ['required', 'string', 'max:20', Rule::unique('siswas', 'nis')->ignore($user->siswa->id ?? null)];
            $rules['jurusan_id'] = 'required|exists:jurusans,id';
            $rules['kelas_id']   = 'required|exists:kelas,id';
        } elseif ($request->role_id == self::ROLE_GURU) {
            $rules['nip']            = ['required', 'string', 'max:20', Rule::unique('gurus', 'nip')->ignore($user->guru->id ?? null)];
            $rules['mata_pelajaran'] = 'required|string|max:100';
        }

        $request->validate($rules);

        // Update data dengan transaksi DB
        DB::transaction(function () use ($request, $user, $currentRoleId) {
            // Update data user
            $data = $request->only('username', 'role_id', 'nama_lengkap');
            if ($request->filled('password')) {
                $data['password'] = Hash::make($request->password);
            }
            $user->update($data);

            // Jika role berubah → hapus data lama, buat data baru
            if ($request->role_id != $currentRoleId) {
                if ($currentRoleId == self::ROLE_SISWA && $user->siswa) $user->siswa->delete();
                if ($currentRoleId == self::ROLE_GURU && $user->guru)   $user->guru->delete();

                if ($request->role_id == self::ROLE_SISWA) {
                    Siswa::create([
                        'user_id'    => $user->id,
                        'nis'        => $request->nis,
                        'kelas_id'   => $request->kelas_id,
                        'jurusan_id' => $request->jurusan_id,
                    ]);
                } elseif ($request->role_id == self::ROLE_GURU) {
                    Guru::create([
                        'user_id'        => $user->id,
                        'nip'            => $request->nip,
                        'mata_pelajaran' => $request->mata_pelajaran,
                    ]);
                }
            } else {
                // Role sama → update data terkait
                if ($request->role_id == self::ROLE_SISWA) {
                    $user->siswa()->updateOrCreate(
                        ['user_id' => $user->id],
                        $request->only('nis', 'kelas_id', 'jurusan_id')
                    );
                } elseif ($request->role_id == self::ROLE_GURU) {
                    $user->guru()->updateOrCreate(
                        ['user_id' => $user->id],
                        $request->only('nip', 'mata_pelajaran')
                    );
                }
            }
        });

        return redirect()->route('admin.users.index')->with('success', 'Data user berhasil diperbarui.');
    }

    // Hapus User
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Cegah hapus akun sendiri
        if ($user->id === Auth::id()) {
            return redirect()->route('admin.users.index')->with('error', 'Tidak bisa hapus akun sendiri.');
        }

        // Hapus data dengan transaksi DB
        DB::transaction(function () use ($user) {
            if ($user->siswa) $user->siswa->delete();
            if ($user->guru)  $user->guru->delete();
            $user->delete();
        });

        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus.');
    }
}
