<?php

namespace Database\Factories;

use App\Models\Jurnal;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class JurnalFactory extends Factory
{
    protected $model = Jurnal::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'kategori_id' => Kategori::inRandomOrder()->first()?->id ?? Kategori::factory(),
            'tanggal' => fake()->date(),
            'judul' => fake()->sentence(4),
            'deskripsi' => fake()->paragraph(),
            'status' => fake()->randomElement(['todo', 'proses', 'selesai']),
            'kendala' => fake()->optional()->sentence(),
        ];
    }
}
