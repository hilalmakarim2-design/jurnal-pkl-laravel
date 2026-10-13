<?php

use App\Http\Controllers\PageController;

Route::get('/', [PageController::class, 'beranda']);
Route::get('/tentang', [PageController::class, 'tentang']);
Route::get('/kontak', [PageController::class, 'kontak']);