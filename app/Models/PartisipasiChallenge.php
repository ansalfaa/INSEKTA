<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PartisipasiChallenge extends Model
{
    use HasFactory;

    protected $table = 'partisipasi_challenges';

    protected $fillable = [
        'challenge_id',
        'user_id',
        'bukti',
        'status',
        'poin',
    ];

    /**
     * Relasi ke Challenge
     */
    public function challenge(): BelongsTo
    {
        return $this->belongsTo(Challenge::class, 'challenge_id');
    }

    /**
     * Relasi ke User
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
