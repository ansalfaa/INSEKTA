<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Jurusan extends Model
{
    protected $table = 'jurusans'; // Pastikan nama tabel sesuai
    protected $fillable = ['nama_jurusan'];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    // Tambahkan relasi ke postingan
    public function postingans(): HasMany
    {
        return $this->hasMany(Postingan::class);
    }
}
