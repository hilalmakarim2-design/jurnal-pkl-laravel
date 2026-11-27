<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
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

    public function scopeFilter(Builder $query, array $filters): void
    {
        $query->when($filters['search'] ?? false, function (Builder $query, $search) {
            $query->where('judul', 'like', '%'.$search.'%');
        });

        $query->when($filters['tanggal'] ?? false, function (Builder $query, $tanggal) {
            $query->whereDate('tanggal', $tanggal);
        });

        $query->when($filters['status'] ?? false, function (Builder $query, $status) {
            $query->where('status', $status);
        });

        $query->when($filters['kategori_id'] ?? false, function (Builder $query, $kategoriId) {
            $query->where('kategori_id', $kategoriId);
        });

        $query->when($filters['user_id'] ?? false, function (Builder $query, $userId) {
            $query->where('user_id', $userId);
        });
    }

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
