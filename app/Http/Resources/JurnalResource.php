<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JurnalResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'kategori_id' => $this->kategori_id,
            'kategori' => $this->kategori?->nama_kategori ?? $this->kategori?->nama ?? null,
            'tanggal' => $this->tanggal?->format('Y-m-d'),
            'judul' => $this->judul,
            'deskripsi' => $this->deskripsi,
            'status' => $this->status,
            'kendala' => $this->kendala,
            'lampiran_url' => $this->lampiran ? asset('storage/'.$this->lampiran) : null,
            'dibuat_pada' => $this->created_at?->toDateTimeString(),
            'diperbarui_pada' => $this->updated_at?->toDateTimeString(),
        ];
    }
}
