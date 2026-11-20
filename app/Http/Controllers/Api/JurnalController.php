<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\JurnalResource;
use App\Models\Jurnal;
use Illuminate\Http\Request;

class JurnalController extends Controller
{
    public function index(Request $request)
    {
        $jurnals = Jurnal::with('kategori')
            ->where('user_id', $request->user()->id)
            ->latest()
            ->get();

        return response()->json([
            'status' => true,
            'message' => 'Daftar jurnal berhasil diambil',
            'data' => JurnalResource::collection($jurnals),
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'tanggal' => 'required|date',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'status' => 'nullable|in:todo,proses,selesai,disetujui,ditolak',
            'kendala' => 'nullable|string',
        ]);

        $validated['user_id'] = $request->user()->id;
        $validated['status'] = $validated['status'] ?? 'proses';

        $jurnal = Jurnal::create($validated);

        return response()->json([
            'status' => true,
            'message' => 'Jurnal berhasil ditambahkan',
            'data' => new JurnalResource($jurnal->load('kategori')),
        ], 201);
    }

    public function show(Request $request, $id)
    {
        $jurnal = Jurnal::with('kategori')->find($id);

        if (!$jurnal) {
            return response()->json(['status' => false, 'message' => 'Jurnal tidak ditemukan'], 404);
        }

        if ($jurnal->user_id !== $request->user()->id) {
            return response()->json(['status' => false, 'message' => 'Akses ditolak. Bukan jurnal milik Anda.'], 403);
        }

        return response()->json([
            'status' => true,
            'message' => 'Detail jurnal berhasil diambil',
            'data' => new JurnalResource($jurnal),
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $jurnal = Jurnal::find($id);

        if (!$jurnal) {
            return response()->json(['status' => false, 'message' => 'Jurnal tidak ditemukan'], 404);
        }

        if ($jurnal->user_id !== $request->user()->id) {
            return response()->json(['status' => false, 'message' => 'Akses ditolak. Bukan jurnal milik Anda.'], 403);
        }

        $validated = $request->validate([
            'kategori_id' => 'sometimes|required|exists:kategoris,id',
            'tanggal' => 'sometimes|required|date',
            'judul' => 'sometimes|required|string|max:255',
            'deskripsi' => 'sometimes|required|string',
            'status' => 'nullable|in:todo,proses,selesai,disetujui,ditolak',
            'kendala' => 'nullable|string',
        ]);

        $jurnal->update($validated);

        return response()->json([
            'status' => true,
            'message' => 'Jurnal berhasil diperbarui',
            'data' => new JurnalResource($jurnal->load('kategori')),
        ], 200);
    }

    public function destroy(Request $request, $id)
    {
        $jurnal = Jurnal::find($id);

        if (!$jurnal) {
            return response()->json(['status' => false, 'message' => 'Jurnal tidak ditemukan'], 404);
        }

        if ($jurnal->user_id !== $request->user()->id) {
            return response()->json(['status' => false, 'message' => 'Akses ditolak. Bukan jurnal milik Anda.'], 403);
        }

        $jurnal->delete();

        return response()->json([
            'status' => true,
            'message' => 'Jurnal berhasil dihapus',
        ], 200);
    }
}