<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JurnalController;
use App\Http\Controllers\KomentarController;
use App\Http\Controllers\ExportController;
use App\Models\Jurnal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Tampilkan halaman Landing Page / Beranda Publik sebelum login
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    
    // Dashboard Agregasi Multi-Role
    Route::get('/dashboard', function (Request $request) {
        $user = auth()->user();
        $baseQuery = Jurnal::query();

        if ($user->isPeserta()) {
            $baseQuery->where('user_id', $user->id);
        }

        $totalJurnal = (clone $baseQuery)->count();
        $totalSelesai = (clone $baseQuery)->whereIn('status', ['selesai', 'SELESAI', 'Selesai'])->count();
        $totalProses = (clone $baseQuery)->whereIn('status', ['proses', 'PROSES', 'Proses', 'todo', 'TODO', 'Todo'])->count();

        $persentaseSelesai = $totalJurnal > 0 ? round(($totalSelesai / $totalJurnal) * 100) : 0;

        return view('dashboard', compact('totalJurnal', 'totalSelesai', 'totalProses', 'persentaseSelesai'));
    })->name('dashboard');

    // Route Resource Jurnal
    Route::resource('jurnal', JurnalController::class);

    // Route Komentar (Khusus Pembimbing)
    Route::post('/jurnal/{jurnal}/komentar', [KomentarController::class, 'store'])
        ->name('komentar.store');

    // Route Export PDF Rekap Jurnal
    Route::get('/export/jurnal-pdf', [ExportController::class, 'exportPdf'])
        ->name('jurnal.export_pdf');

    // Route Khusus Pembimbing (Monitoring All Peserta)
    Route::middleware('role:pembimbing')->group(function () {
        Route::get('/pembimbing/monitoring', function () {
            $pesertas = User::where('role', 'peserta')->get();
            return view('pembimbing.monitoring', compact('pesertas'));
        })->name('pembimbing.monitoring');
    });

    // Profile Management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';