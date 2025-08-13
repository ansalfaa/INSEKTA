<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReaksiKomentar extends Model
{
    protected $table = 'reaksi_komentars';

    protected $fillable = [
        'comment_id',
        'user_id',
        'type',
    ];

    public function komentar(): BelongsTo
    {
        return $this->belongsTo(Komentar::class, 'comment_id'); // Keep 'comment_id' as foreign key name
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
