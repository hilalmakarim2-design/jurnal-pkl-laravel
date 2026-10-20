<?php

namespace App\Http\Controllers;

use App\Models\Jurnal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JurnalController extends Controller
{
    public function index()
    {
        $jurnals = Auth::user()->jurnals()->latest()->get();
        return view('jurnal.index', compact('jurnals'));
    }

    public function create()
    {
        return view('jurnal.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'status' => 'required|in:todo,proses,selesai',
            'kendala' => 'nullable|string',
        ]);

        Auth::user()->jurnals()->create($request->all());

        return redirect()->route('jurnal.index')->with('success', 'Jurnal berhasil ditambahkan!');
    }

    public function edit(Jurnal $jurnal)
    {
        if ($jurnal->user_id !== Auth::id()) {
            abort(403);
        }
        return view('jurnal.edit', compact('jurnal'));
    }

    public function update(Request $request, Jurnal $jurnal)
    {
        if ($jurnal->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'tanggal' => 'required|date',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'status' => 'required|in:todo,proses,selesai',
            'kendala' => 'nullable|string',
        ]);

        $jurnal->update($request->all());

        return redirect()->route('jurnal.index')->with('success', 'Jurnal berhasil diperbarui!');
    }

    public function destroy(Jurnal $jurnal)
    {
        if ($jurnal->user_id !== Auth::id()) {
            abort(403);
        }

        $jurnal->delete();
        return redirect()->route('jurnal.index')->with('success', 'Jurnal berhasil dihapus!');
    }
}