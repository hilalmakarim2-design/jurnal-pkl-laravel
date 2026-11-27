# Aplikasi Jurnal Harian PKL — PT Metanouva Informatika

Aplikasi web dan REST API berbasis Laravel untuk pencatatan, pemantauan, evaluasi, dan pelaporan kegiatan harian peserta Praktik Kerja Lapangan (PKL).

## Fitur Utama

- **Autentikasi & Manajemen Role:** Pembagian hak akses antara **Peserta PKL** dan **Pembimbing PKL** (web session dan Laravel Sanctum token).
- **Manajemen Jurnal Harian:** Peserta dapat membuat, melihat, memperbarui, mencari/memfilter, dan menghapus catatan kegiatan harian berdasarkan kategori.
- **Evaluasi & Komentar Pembimbing:** Pembimbing dapat meninjau seluruh jurnal peserta, memberikan status evaluasi, serta menambahkan catatan/komentar.
- **Dashboard Statistik:** Ringkasan jumlah jurnal dan aktivitas sesuai masing-masing role.
- **Export Laporan:** Fitur unduh rekap laporan jurnal dalam format PDF untuk keperluan dokumentasi PKL.
- **REST API & Kontainerisasi Docker:** Endpoint API terproteksi Sanctum lengkap dengan koleksi Postman dan konfigurasi Docker Compose.

## Kebutuhan Sistem

- **Opsi Docker:** Docker Desktop (Docker Engine & Docker Compose)
- **Opsi Manual:** PHP >= 8.2, Composer, MySQL 8.0 / MariaDB, Node.js & NPM

---

## Cara Menjalankan Proyek

### 1. Menggunakan Docker (Direkomendasikan)

1. Pastikan **Docker Desktop** sudah berjalan dan layanan MySQL/Apache lokal (XAMPP) dalam keadaan nonaktif.
2. Salin konfigurasi environment:
   ```bash
   cp .env.example .env
