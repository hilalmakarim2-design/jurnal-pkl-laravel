<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Komentar extends Model
{
    use HasFactory;

    protected $fillable = [
        'jurnal_id',
        'user_id',
        'isi',
    ];

    public function jurnal(): BelongsTo
    {
        return $this->belongsTo(Jurnal::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}