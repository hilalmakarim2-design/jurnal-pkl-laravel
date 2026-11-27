<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJurnalRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'kategori_id' => 'nullable|exists:kategoris,id',
            'tanggal' => 'required|date',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'status' => 'required|in:todo,proses,selesai',
            'kendala' => 'nullable|string',
            'lampiran' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }
}
