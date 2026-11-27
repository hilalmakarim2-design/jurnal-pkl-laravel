<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJurnalRequest;
use App\Http\Requests\UpdateJurnalRequest;
use App\Models\Jurnal;
use App\Models\Kategori;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JurnalController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request)
    {
        $this->authorize('viewAny', Jurnal::class);

        $user = auth()->user();
        $query = Jurnal::with(['kategori', 'user', 'komentars.user']);

        // Jika peserta, hanya bisa lihat milik sendiri. Jika pembimbing, bisa lihat semua / filter per peserta.
        if ($user->isPeserta()) {
            $query->where('user_id', $user->id);
        } elseif ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        // Search berdasarkan judul
        if ($request->filled('search')) {
            $query->where('judul', 'like', '%'.$request->search.'%');
        }

        // Filter berdasarkan tanggal
        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $request->tanggal);
        }

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan kategori
        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        $jurnals = $query->latest('tanggal')->paginate(10)->withQueryString();
        $kategoris = Kategori::all();

        return view('jurnal.index', compact('jurnals', 'kategoris'));
    }

    public function create()
    {
        $this->authorize('create', Jurnal::class);
        $kategoris = Kategori::all();

        return view('jurnal.create', compact('kategoris'));
    }

    public function store(StoreJurnalRequest $request)
    {
        $this->authorize('create', Jurnal::class);

        $validated = $request->validated();
        $validated['user_id'] = auth()->id();

        if ($request->hasFile('lampiran')) {
            $validated['lampiran'] = $request->file('lampiran')->store('lampiran_jurnal', 'public');
        }

        Jurnal::create($validated);

        return redirect()->route('jurnal.index')->with('success', 'Jurnal harian berhasil ditambahkan!');
    }

    public function edit(Jurnal $jurnal)
    {
        $this->authorize('update', $jurnal);

        $kategoris = Kategori::all();

        return view('jurnal.edit', compact('jurnal', 'kategoris'));
    }

    public function update(UpdateJurnalRequest $request, Jurnal $jurnal)
    {
        $this->authorize('update', $jurnal);

        $validated = $request->validated();

        if ($request->hasFile('lampiran')) {
            if ($jurnal->lampiran) {
                Storage::disk('public')->delete($jurnal->lampiran);
            }
            $validated['lampiran'] = $request->file('lampiran')->store('lampiran_jurnal', 'public');
        }

        $jurnal->update($validated);

        return redirect()->route('jurnal.index')->with('success', 'Jurnal harian berhasil diperbarui!');
    }

    public function destroy(Jurnal $jurnal)
    {
        $this->authorize('delete', $jurnal);

        if ($jurnal->lampiran) {
            Storage::disk('public')->delete($jurnal->lampiran);
        }

        $jurnal->delete();

        return redirect()->route('jurnal.index')->with('success', 'Jurnal harian berhasil dihapus!');
    }
}
