<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bookmark extends Model
{
    protected $table = 'bookmarks';

    protected $fillable = [
        'post_id',
        'user_id',
    ];

    public function postingan(): BelongsTo
    {
        return $this->belongsTo(Postingan::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
