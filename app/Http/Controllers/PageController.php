<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    // Halaman khusus Guest (Pengunjung)
    public function guestView()
    {
        return view('guest');
    }

    // Halaman Beranda khusus User yang sudah Login
    public function beranda()
    {
        return view('beranda');
    }

    public function tentang()
    {
        return view('tentang');
    }

    public function kontak()
    {
        return view('kontak');
    }
}