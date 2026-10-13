@extends('layouts.app')

@section('title', 'Kontak - PKL PT Metanouva Informatika')

@section('content')
    <div class="page-header">
        <h1>Hubungi Kami</h1>
        <p>Jika ada pertanyaan terkait proyek atau program PKL, silakan kirimkan pesan melalui formulir di bawah ini.</p>
    </div>

    <div class="contact-wrapper">
        <form action="#" method="POST" class="contact-form" onsubmit="event.preventDefault(); alert('Ini adalah halaman contoh statis.');">
            <div class="form-group">
                <label for="nama">Nama Lengkap</label>
                <input type="text" id="nama" name="nama" placeholder="Masukkan nama Anda" required>
            </div>

            <div class="form-group">
                <label for="email">Alamat Email</label>
                <input type="email" id="email" name="email" placeholder="nama@email.com" required>
            </div>

            <div class="form-group">
                <label for="pesan">Pesan / Masukan</label>
                <textarea id="pesan" name="pesan" rows="5" placeholder="Tuliskan pesan Anda di sini..." required></textarea>
            </div>

            <button type="submit" class="btn-primary">Kirim Pesan</button>
        </form>

        <div class="contact-info">
            <h3>Informasi Kantor</h3>
            <p><strong>PT Metanouva Informatika</strong></p>
            <p>Program Praktik Kerja Lapangan (PKL)</p>
            <p>Email: pkl@metanouva.com</p>
        </div>
    </div>
@endsection