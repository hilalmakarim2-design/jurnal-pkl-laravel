<?php

namespace App\Http\Controllers;

use App\Models\Jurnal;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function exportPdf(Request $request)
    {
        $user = auth()->user();
        $query = Jurnal::with(['user', 'kategori']);

        // Jika peserta, hanya download data sendiri. Jika pembimbing, bisa filter per peserta.
        if ($user->isPeserta()) {
            $query->where('user_id', $user->id);
        } elseif ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        // Filter Rentang Tanggal
        if ($request->filled('tgl_mulai') && $request->filled('tgl_selesai')) {
            $query->whereBetween('tanggal', [$request->tgl_mulai, $request->tgl_selesai]);
        }

        $jurnals = $query->orderBy('tanggal', 'asc')->get();

        $pdf = Pdf::loadView('exports.jurnal_pdf', compact('jurnals'));

        return $pdf->download('Rekap_Jurnal_PKL_'.date('Ymd_His').'.pdf');
    }
}
