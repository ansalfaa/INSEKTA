<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Komentar extends Model
{
    protected $table = 'komentars';

    protected $fillable = [
        'post_id',
        'user_id',
        'comment',
    ];

    public function postingan(): BelongsTo
    {
        return $this->belongsTo(Postingan::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function reaksiKomentars(): HasMany
    {
        return $this->hasMany(ReaksiKomentar::class, 'komentar_id'); // Note: foreign key is 'comment_id' in migration, but 'komentar_id' in model
    }

    public function getReactionCount($type = null)
    {
        if ($type) {
            return $this->reaksiKomentars()->where('type', $type)->count();
        }
        return $this->reaksiKomentars()->count();
    }

    public function getUserReaction($userId)
    {
        return $this->reaksiKomentars()->where('user_id', $userId)->first();
    }
}
