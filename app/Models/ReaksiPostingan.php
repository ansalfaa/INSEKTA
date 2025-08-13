<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReaksiPostingan extends Model
{
    protected $table = 'reaksi_postingans';

    protected $fillable = [
        'post_id',
        'user_id',
        'type',
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
