<?php

namespace Database\Factories;

use App\Models\Aset;
use App\Models\Warga;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Saparodik>
 */
class SaparodikFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'pemilik_lama_id' => Warga::factory(),
            'pemilik_baru_id' => Warga::factory(),
            'aset_id' => Aset::factory(),
            'no_surat' => fake()->word,
            'jenis_surat' => fake()->randomElement(['tanah', 'bangunan']),
            'tanggal_surat' => fake()->date(),
        ];
    }
}
