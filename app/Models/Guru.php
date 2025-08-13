<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Guru extends Model
{
    protected $fillable = [
        'user_id',
        'nip',
        'nama_lengkap',
        'mata_pelajaran',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
