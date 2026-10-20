@extends('layouts.app')

@section('title', 'Beranda User - PKL PT Metanouva Informatika')

@section('content')
    <div class="hero-section">
        <h1>Selamat Datang di Beranda, {{ Auth::user()->name }}! 👋</h1>
        <p>Anda berhasil masuk ke <strong>Portal Proyek PKL PT Metanouva Informatika</strong> menggunakan akun email <strong>{{ Auth::user()->email }}</strong>.</p>
        <div style="margin-top: 20px;">
            <a href="{{ url('/tentang') }}" class="btn-primary">Pelajari Lebih Lanjut</a>
        </div>
    </div>

    <div class="features-grid">
        <div class="card">
            <h3>Terstruktur (MVC)</h3>
            <p>Pemisahan logika aplikasi, tampilan, dan rute request membuat kode lebih rapi dan efisien.</p>
        </div>
        <div class="card">
            <h3>Blade Templating</h3>
            <p>Memudahkan pembuatan layout yang reusable tanpa harus menulis ulang header/footer.</p>
        </div>
        <div class="card">
            <h3>Aman & Mudah Dirawat</h3>
            <p>Laravel menyediakan proteksi standar seperti CSRF protection dan penanganan rute yang aman.</p>
        </div>
    </div>
@endsection