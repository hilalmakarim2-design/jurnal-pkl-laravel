<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jurnal extends Model
{
  protected $fillable = ['user_id', 'tanggal', 'judul', 'deskripsi', 'status', 'kendala'];

public function user()
{
    return $this->belongsTo(User::class);
}
}
