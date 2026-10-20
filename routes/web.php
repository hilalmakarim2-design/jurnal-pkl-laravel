<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JurnalController;
use Illuminate\Support\Facades\Route;

// Halaman Publik (Tamu & User Terdaftar Bisa Akses)
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/tentang', function () {
    return view('tentang');
})->name('tentang');

Route::get('/kontak', function () {
    return view('kontak');
})->name('kontak');

// Halaman Khusus Pengguna Terautentikasi (Wajib Login)
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // CRUD Jurnal Harian PKL
    Route::resource('jurnal', JurnalController::class);

    // Profile Management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';