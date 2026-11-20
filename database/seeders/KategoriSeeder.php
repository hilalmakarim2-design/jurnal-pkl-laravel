<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $kategoris = ['Coding', 'Belajar', 'Meeting', 'Dokumentasi'];

        foreach ($kategoris as $nama) {
            Kategori::firstOrCreate(['nama' => $nama]);
        }
    }
}