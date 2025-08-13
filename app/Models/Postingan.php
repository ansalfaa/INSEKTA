<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Postingan extends Model
{
    protected $table = 'postingans';

    protected $fillable = [
        'user_id',
        'caption',
        'media_url',
        'visibility',
        'jurusan_id',
        'kelas_id',
        'is_active',
    ];

    protected $casts = [
        'media_url' => 'array',
        'is_active' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function komentars(): HasMany
    {
        return $this->hasMany(Komentar::class);
    }

    public function reaksiPostingans(): HasMany
    {
        return $this->hasMany(ReaksiPostingan::class);
    }

    public function bookmarks(): HasMany
    {
        return $this->hasMany(Bookmark::class);
    }

    // Helper methods
    public function getReactionCount($type = null)
    {
        if ($type) {
            return $this->reaksiPostingans()->where('type', $type)->count();
        }
        return $this->reaksiPostingans()->count();
    }

    public function isBookmarkedBy($userId)
    {
        return $this->bookmarks()->where('user_id', $userId)->exists();
    }

    public function getUserReaction($userId)
    {
        return $this->reaksiPostingans()->where('user_id', $userId)->first();
    }

    // Scope for visibility
    public function scopeVisibleTo($query, $user)
    {
        return $query->where(function ($q) use ($user) {
            $q->where('visibility', 'umum')
                ->orWhere(function ($subQ) use ($user) {
                    $subQ->where('visibility', 'jurusan')
                        ->where('jurusan_id', $user->jurusan_id);
                })
                ->orWhere(function ($subQ) use ($user) {
                    $subQ->where('visibility', 'kelas')
                        ->where('kelas_id', $user->kelas_id);
                })
                ->orWhere('user_id', $user->id);
        });
    }
}
