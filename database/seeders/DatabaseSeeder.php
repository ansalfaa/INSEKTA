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
        // Buat Role
        $superAdminRole = Role::firstOrCreate(['nama_role' => 'super_admin']);
        $adminRole      = Role::firstOrCreate(['nama_role' => 'admin']);
        $guruRole       = Role::firstOrCreate(['nama_role' => 'guru']);
        $siswaRole      = Role::firstOrCreate(['nama_role' => 'siswa']);

        // Buat Data Kelas
        $kelasList = ['X', 'XI', 'XII', 'XIII'];
        foreach ($kelasList as $nama) {
            Kelas::firstOrCreate(['nama_kelas' => $nama]);
        }

        // Buat Data Jurusan
        $jurusanList = ['SIJA', 'TAV', 'TKR', 'TP', 'DPIB'];
        foreach ($jurusanList as $nama) {
            Jurusan::firstOrCreate(['nama_jurusan' => $nama]);
        }

        //  Buat Users

        // Super Admin
        User::firstOrCreate(
            ['username' => 'Administrator'],
            [
                'nama_lengkap' => 'Administrator',
                'password'     => Hash::make('super123'),
                'role_id'      => $superAdminRole->id,
            ]
        );

        // Admin
        User::firstOrCreate(
            ['username' => 'admin'],
            [
                'nama_lengkap' => 'Admin1',
                'password'     => Hash::make('admin123'),
                'role_id'      => $adminRole->id,
            ]
        );

        // Guru
        $guruUser = User::firstOrCreate(
            ['username' => 'guru1'],
            [
                'nama_lengkap' => 'Guru Contoh',
                'password'     => Hash::make('guru123'),
                'role_id'      => $guruRole->id,
            ]
        );

        // Tambahkan data guru ke tabel gurus
        $guruUser->guru()->firstOrCreate([
            'nip'            => '1987654321',
            'nama_lengkap'   => 'Guru Contoh',
            'mata_pelajaran' => 'Matematika',
        ]);

        // Siswa
        $siswaUser = User::firstOrCreate(
            ['username' => 'siswa1'],
            [
                'nama_lengkap' => 'Siswa Contoh',
                'password'     => Hash::make('siswa123'),
                'role_id'      => $siswaRole->id,
            ]
        );

        // Ambil kelas & jurusan contoh
        $kelasX   = Kelas::where('nama_kelas', 'X')->first();
        $jurusanS = Jurusan::where('nama_jurusan', 'SIJA')->first();

        // Tambahkan data siswa ke tabel siswas
        $siswaUser->siswa()->firstOrCreate([
            'nis'          => '1234567890',
            'nama_lengkap' => 'Siswa Contoh',
            'kelas_id'     => $kelasX?->id,
            'jurusan_id'   => $jurusanS?->id,
        ]);
    }
}
