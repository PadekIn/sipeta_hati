<?php

namespace Database\Factories;

use App\Models\Aset;
use App\Models\Warga;
use App\Models\Pengajuan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Saparodik>
 */
class SporadikFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'jenis_barang' => $this->faker->randomElement(['tanah', 'bangunan']),
            'luas' => $this->faker->randomFloat(2, 0, 999.99),
            'alamat' => $this->faker->word(),
            'no_surat' => $this->faker->word(),
            'jenis_surat' => $this->faker->word(),
            'tanggal_surat' => $this->faker->date(),
            'lampiran' => $this->faker->word(),
            'pengajuan_id' => Pengajuan::factory(),
            'pemilik_lama_id' => Warga::factory(),
            'pemilik_baru_id' => Warga::factory(),
        ];
    }
}
