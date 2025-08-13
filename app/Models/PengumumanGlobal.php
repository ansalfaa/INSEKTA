<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PengumumanGlobal extends Model
{
    use HasFactory;

    protected $table = 'pengumuman_globals'; // Nama tabel
    protected $primaryKey = 'id_pengumuman'; // Primary Key
    public $incrementing = true; // Pastikan auto-increment aktif
    public $timestamps = true; // Hanya ada created_at

    protected $fillable = [
        'user_id',
        'judul',
        'isi',
    ];

    /**
     * Get the user that created the announcement.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
