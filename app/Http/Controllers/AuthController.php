<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan halaman form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Proses login user
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return $this->redirectByRole(); // langsung panggil redirectByRole
        }

        return back()
            ->withErrors(['username' => 'Username atau password salah.'])
            ->onlyInput('username');
    }


    // Redirect sesuai role user
    public function redirectByRole()
    {
        $user = Auth::user();
        $role = strtolower(str_replace(' ', '_', $user->role->nama_role));

        // Super Admin & Admin → dashboard admin
        if (in_array($role, ['super_admin', 'admin', 'administrator'])) {
            return redirect()->route('admin.dashboard');
        }

        // Guru → dashboard guru
        if ($role === 'guru') {
            return redirect()->route('guru.dashboard');
        }

        // Siswa → cek data tambahan
        if ($role === 'siswa') {
            $siswa = $user->siswa; // pastikan relasi siswa() ada di model User

            if (is_null($siswa->no_hp) || is_null($siswa->rencana)) {
                return redirect()->route('siswa.dashboard')->with('loginSuccess', true);
            }

            return redirect()->route('siswa.dashboard');
        }

        // Default kalau role tidak dikenali
        return redirect('/');
    }



    // Proses logout user
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
