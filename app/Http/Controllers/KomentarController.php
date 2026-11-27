<?php

namespace App\Http\Controllers;

use App\Models\Jurnal;
use App\Models\Komentar;
use Illuminate\Http\Request;

class KomentarController extends Controller
{
    public function store(Request $request, Jurnal $jurnal)
    {
        if (! auth()->user()->isPembimbing()) {
            abort(403, 'Hanya pembimbing yang dapat memberikan catatan.');
        }

        $request->validate([
            'isi' => 'required|string|max:1000',
        ]);

        Komentar::create([
            'jurnal_id' => $jurnal->id,
            'user_id' => auth()->id(),
            'isi' => $request->isi,
        ]);

        return back()->with('success', 'Catatan pembimbing berhasil ditambahkan.');
    }
}
