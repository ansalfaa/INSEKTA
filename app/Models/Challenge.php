<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Challenge extends Model
{
    use HasFactory;

    protected $table = 'challenges';

    protected $fillable = [
        'judul',
        'deskripsi',
        'deadline',
        'poin',
    ];

    protected $casts = [
        'deadline' => 'date',
        'poin' => 'integer',
    ];

    /**
     * Relasi ke PartisipasiChallenge (semua peserta challenge ini)
     */
    public function partisipasi(): HasMany
    {
        return $this->hasMany(PartisipasiChallenge::class, 'challenge_id');
    }
}
