<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Jurnal extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'kategori_id',
        'tanggal',
        'judul',
        'deskripsi',
        'status',
        'kendala',
        'lampiran',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

public function komentars()
{
    return $this->hasMany(Komentar::class)->latest();
}

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class);
    }
}