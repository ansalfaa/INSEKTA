<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Jurusan;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Role terlebih dahulu
        $adminRole = Role::create(['nama_role' => 'admin']);
        $guruRole = Role::create(['nama_role' => 'guru']);
        $siswaRole = Role::create(['nama_role' => 'siswa']);

        // 2. Buat Data Kelas
        $kelasList = ['X', 'XI', 'XII', 'XIII'];
        foreach ($kelasList as $nama) {
            Kelas::create(['nama_kelas' => $nama]);
        }

        // 3. Buat Data Jurusan
        $jurusanList = ['SIJA', 'TAV', 'TKR', 'TP', 'DPIB'];
        foreach ($jurusanList as $nama) {
            Jurusan::create(['nama_jurusan' => $nama]);
        }

        // 4. Buat Users dengan role_id sesuai Role yang dibuat
        User::create([
            'nama_lengkap' => 'Administrator',
            'username' => 'admin',
            'password' => Hash::make('admin123'),
            'role_id' => $adminRole->id,
        ]);

        User::create([
            'nama_lengkap' => 'Guru Contoh',
            'username' => 'guru1',
            'password' => Hash::make('guru123'),
            'role_id' => $guruRole->id,
        ]);

        User::create([
            'nama_lengkap' => 'Siswa Contoh',
            'username' => 'siswa1',
            'password' => Hash::make('siswa123'),
            'role_id' => $siswaRole->id,
        ]);
    }
}
