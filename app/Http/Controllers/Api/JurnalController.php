<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreJurnalRequest;
use App\Http\Requests\UpdateJurnalRequest;
use App\Models\Jurnal;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class JurnalController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request)
    {
        $this->authorize('viewAny', Jurnal::class);

        $user = auth()->user();
        $filters = $request->only(['search', 'tanggal', 'status', 'kategori_id', 'user_id']);

        if ($user->isPeserta()) {
            $filters['user_id'] = $user->id;
        }

        $jurnals = Jurnal::with(['kategori', 'user'])
            ->filter($filters)
            ->latest('tanggal')
            ->paginate(10);

        return response()->json([
            'status' => 'success',
            'data' => $jurnals,
        ]);
    }

    public function store(StoreJurnalRequest $request)
    {
        $this->authorize('create', Jurnal::class);

        $validated = $request->validated();
        $validated['user_id'] = auth()->id();

        $jurnal = Jurnal::create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Jurnal berhasil dibuat',
            'data' => $jurnal,
        ], 201);
    }

    public function show(Jurnal $jurnal)
    {
        $this->authorize('view', $jurnal);

        return response()->json([
            'status' => 'success',
            'data' => $jurnal->load(['kategori', 'user', 'komentars']),
        ]);
    }

    public function update(UpdateJurnalRequest $request, Jurnal $jurnal)
    {
        $this->authorize('update', $jurnal);

        $jurnal->update($request->validated());

        return response()->json([
            'status' => 'success',
            'message' => 'Jurnal berhasil diperbarui',
            'data' => $jurnal,
        ]);
    }

    public function destroy(Jurnal $jurnal)
    {
        $this->authorize('delete', $jurnal);

        $jurnal->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Jurnal berhasil dihapus',
        ]);
    }
}
