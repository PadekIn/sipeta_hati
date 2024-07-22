<?php

namespace Database\Factories;

use App\Models\Warga;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Aset>
 */
class AsetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'warga_id' => Warga::factory(),
            'jenis_barang' => fake()->randomElement(['tanah', 'bangunan']),
            'luas' => fake()->randomFloat(2, 1, 100),
            'alamat' => fake()->address,
        ];
    }
}
