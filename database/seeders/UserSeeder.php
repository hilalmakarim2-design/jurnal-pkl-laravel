<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Akun Pembimbing
        User::firstOrCreate(
            ['email' => 'pembimbing@metanouva.co.id'],
            [
                'name' => 'Pembimbing PKL',
                'password' => 'password',
                'role' => 'pembimbing',
            ]
        );

        // Akun Peserta
        User::firstOrCreate(
            ['email' => 'peserta@metanouva.co.id'],
            [
                'name' => 'Hilal Makarim',
                'password' => 'password',
                'role' => 'peserta',
            ]
        );
    }
}
