<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Kolom yang bisa diisi secara mass-assignment
    protected $fillable = [
        'username',
        'nama_lengkap',
        'password',
        'role_id',
    ];

    // Kolom yang akan disembunyikan saat serialisasi
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Casting atribut ke tipe data tertentu
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relasi ke tabel roles (Setiap user punya satu role)
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    // Relasi ke tabel siswa (User bisa punya satu data siswa)
    public function siswa(): HasOne
    {
        return $this->hasOne(Siswa::class);
    }

    // Relasi ke tabel guru (User bisa punya satu data guru)
    public function guru(): HasOne
    {
        return $this->hasOne(Guru::class);
    }
}
