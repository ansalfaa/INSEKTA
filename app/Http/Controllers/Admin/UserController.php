<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Hash, Auth, DB, Log};
use Illuminate\Validation\Rule;

class UserController extends Controller
{
  const ROLE_SUPER_ADMIN = 1;
  const ROLE_ADMIN = 2;
  const ROLE_GURU  = 3;
  const ROLE_SISWA = 4;


  // =========================
  // LIST USERS + FILTER + SEARCH
  // =========================
  public function index(Request $request)
  {
    $query = User::with('role', 'siswa.kelas', 'siswa.jurusan', 'guru')
      ->when(
        $request->role,
        fn($q) =>
        $q->whereHas('role', fn($r) => $r->where('nama_role', $request->role))
      )
      ->when(
        $request->search,
        fn($q) =>
        $q->where(
          fn($sub) =>
          $sub->where('username', 'like', "%{$request->search}%")
            ->orWhere('nama_lengkap', 'like', "%{$request->search}%")
        )
      )
      ->when(
        $request->role === 'siswa' && $request->filled('jurusan'),
        fn($q) =>
        $q->whereHas('siswa.jurusan', fn($j) => $j->where('id', $request->jurusan))
      )
      ->when(
        $request->role === 'siswa' && $request->filled('kelas'),
        fn($q) =>
        $q->whereHas('siswa.kelas', fn($k) => $k->where('id', $request->kelas))
      );

    $users = $query->paginate(10)->appends($request->query());

    $rolesCount = [
      'admin' => User::where('role_id', self::ROLE_ADMIN)->count(),
      'guru'  => User::where('role_id', self::ROLE_GURU)->count(),
      'siswa' => User::where('role_id', self::ROLE_SISWA)->count(),
    ];

    return view('admin.pages.users.index', [
      'users' => $users,
      'roles' => Role::all(),
      'jurusans' => Jurusan::all(),
      'kelases' => Kelas::all(),
      'rolesCount' => $rolesCount,
      'totalUsers' => User::count(),
    ]);
  }

  // =========================
  // CREATE USER FORM
  // =========================
  public function create()
  {
    return view('admin.pages.users.create', [
      'roles' => Role::all(),
      'jurusans' => Jurusan::all(),
      'kelases' => Kelas::all(),
    ]);
  }

  // =========================
  // STORE NEW USER
  // =========================
  public function store(Request $request)
  {
    Log::info('User creation attempt started', [
      'request_data' => $request->all(),
      'user_agent' => $request->userAgent(),
      'ip' => $request->ip()
    ]);

    try {
      $rules = [
        'username'     => 'required|unique:users|min:3|max:50',
        'password'     => 'required|min:6|confirmed',
        'role_id'      => 'required|exists:roles,id',
        'nama_lengkap' => 'required|string|max:100',
      ];

      $roleId = (int) $request->role_id;

      Log::info('Role ID detected', ['role_id' => $roleId]);

      if ($roleId == self::ROLE_SISWA) {
        $rules['nis'] = 'required|unique:siswas,nis|string|max:20';
        $rules['jurusan_id'] = 'required|exists:jurusans,id';
        $rules['kelas_id'] = 'required|exists:kelas,id';
        Log::info('Added siswa validation rules');
      } elseif ($roleId == self::ROLE_GURU) {
        $rules['nip'] = 'required|unique:gurus,nip|string|max:20';
        $rules['mata_pelajaran'] = 'required|string|max:100';
        Log::info('Added guru validation rules');
      }

      Log::info('Validation rules prepared', ['rules' => array_keys($rules)]);

      $validated = $request->validate($rules);

      Log::info('Validation passed successfully', [
        'validated_fields' => array_keys($validated)
      ]);

      DB::beginTransaction();

      Log::info('Database transaction started');

      $user = User::create([
        'username'     => $validated['username'],
        'password'     => Hash::make($validated['password']),
        'role_id'      => $validated['role_id'],
        'nama_lengkap' => $validated['nama_lengkap'],
      ]);

      if (!$user) {
        throw new \Exception('Failed to create user record');
      }

      Log::info('User created successfully', [
        'user_id' => $user->id,
        'username' => $user->username,
        'role_id' => $user->role_id
      ]);

      if ($user->role_id == self::ROLE_SISWA) {
        if (!isset($validated['nis']) || !isset($validated['kelas_id']) || !isset($validated['jurusan_id'])) {
          throw new \Exception('Missing required siswa data');
        }

        $siswa = Siswa::create([
          'user_id'     => $user->id,
          'nis'         => $validated['nis'],
          'kelas_id'    => $validated['kelas_id'],
          'jurusan_id'  => $validated['jurusan_id'],
          'nama_lengkap' => $validated['nama_lengkap'],
        ]);

        if (!$siswa) {
          throw new \Exception('Failed to create siswa record');
        }

        Log::info('Siswa data created successfully', [
          'siswa_id' => $siswa->id,
          'nis' => $siswa->nis
        ]);
      } elseif ($user->role_id == self::ROLE_GURU) {
        if (!isset($validated['nip']) || !isset($validated['mata_pelajaran'])) {
          throw new \Exception('Missing required guru data');
        }

        $guru = Guru::create([
          'user_id'        => $user->id,
          'nip'            => $validated['nip'],
          'mata_pelajaran' => $validated['mata_pelajaran'],
          'nama_lengkap'   => $validated['nama_lengkap'],
        ]);

        if (!$guru) {
          throw new \Exception('Failed to create guru record');
        }

        Log::info('Guru data created successfully', [
          'guru_id' => $guru->id,
          'nip' => $guru->nip
        ]);
      }

      DB::commit();
      Log::info('Transaction committed successfully', ['user_id' => $user->id]);

      return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan.');
    } catch (\Illuminate\Validation\ValidationException $e) {
      Log::error('Validation failed', [
        'errors' => $e->errors(),
        'input' => $request->all()
      ]);
      return redirect()->back()->withErrors($e->errors())->withInput();
    } catch (\Throwable $e) {
      DB::rollBack();
      Log::error('User creation failed with exception', [
        'error' => $e->getMessage(),
        'file' => $e->getFile(),
        'line' => $e->getLine(),
        'trace' => $e->getTraceAsString(),
        'input' => $request->all()
      ]);

      return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
    }
  }

  // =========================
  // EDIT USER FORM
  // =========================
  public function edit(User $user)
  {
    $user->load('siswa', 'guru');

    return view('admin.pages.users.edit', [
      'user' => $user,
      'roles' => Role::all(),
      'jurusans' => Jurusan::all(),
      'kelases' => Kelas::all(),
    ]);
  }

  // =========================
  // UPDATE USER
  // =========================
  public function update(Request $request, User $user)
  {
    $user->load('siswa', 'guru');
    $currentRoleId = $user->role_id;

    $rules = [
      'username' => ['required', 'min:3', 'max:50', Rule::unique('users')->ignore($user->id)],
      'password' => 'nullable|min:6|confirmed',
      'role_id' => 'required|exists:roles,id',
      'nama_lengkap' => 'required|string|max:100',
    ];

    if ($request->role_id == self::ROLE_SISWA) {
      $rules['nis'] = [
        'required',
        'string',
        'max:20',
        Rule::unique('siswas', 'nis')->ignore($user->siswa?->nis, 'nis'),
      ];
      $rules['jurusan_id'] = 'required|exists:jurusans,id';
      $rules['kelas_id'] = 'required|exists:kelas,id';
    } elseif ($request->role_id == self::ROLE_GURU) {
      $rules['nip'] = [
        'required',
        'string',
        'max:20',
        Rule::unique('gurus', 'nip')->ignore($user->guru?->nip, 'nip'),
      ];
      $rules['mata_pelajaran'] = 'required|string|max:100';
    }

    $request->validate($rules);

    DB::transaction(function () use ($request, $user, $currentRoleId) {
      // Update main User data
      $data = $request->only('username', 'role_id', 'nama_lengkap');
      if ($request->filled('password')) {
        $data['password'] = Hash::make($request->password);
      }
      $user->update($data);

      // Role berubah? hapus data lama & buat data baru
      if ($request->role_id != $currentRoleId) {
        if ($currentRoleId == self::ROLE_SISWA && $user->siswa) $user->siswa->delete();
        if ($currentRoleId == self::ROLE_GURU && $user->guru) $user->guru->delete();

        if ($request->role_id == self::ROLE_SISWA) {
          Siswa::create([
            'user_id' => $user->id,
            'nis' => $request->nis,
            'kelas_id' => $request->kelas_id,
            'jurusan_id' => $request->jurusan_id,
            'nama_lengkap' => $request->nama_lengkap,
          ]);
        } elseif ($request->role_id == self::ROLE_GURU) {
          Guru::create([
            'user_id' => $user->id,
            'nip' => $request->nip,
            'mata_pelajaran' => $request->mata_pelajaran,
            'nama_lengkap' => $request->nama_lengkap,
          ]);
        }
      } else {
        // Role sama -> update existing
        if ($request->role_id == self::ROLE_SISWA) {
          $user->siswa()->updateOrCreate(
            ['user_id' => $user->id],
            $request->only('nis', 'kelas_id', 'jurusan_id', 'nama_lengkap')
          );
        } elseif ($request->role_id == self::ROLE_GURU) {
          $user->guru()->updateOrCreate(
            ['user_id' => $user->id],
            $request->only('nip', 'mata_pelajaran', 'nama_lengkap')
          );
        }
      }
    });

    return redirect()->route('admin.users.index')->with('success', 'Data user berhasil diperbarui.');
  }

  // =========================
  // DELETE USER
  // =========================
  public function destroy(User $user)
  {
    if ($user->id === Auth::id()) {
      return redirect()->route('admin.users.index')->with('error', 'Tidak bisa hapus akun sendiri.');
    }

    if ($user->role_id == self::ROLE_SUPER_ADMIN) {
      return redirect()->route('admin.users.index')->with('error', 'Tidak bisa menghapus Super Admin.');
    }

    DB::transaction(function () use ($user) {
      if ($user->siswa) $user->siswa->delete();
      if ($user->guru) $user->guru->delete();
      $user->delete();
    });

    return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus.');
  }
}
