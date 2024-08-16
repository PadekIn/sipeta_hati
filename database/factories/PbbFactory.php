<?php

namespace Database\Factories;

use App\Models\Aset;
use App\Models\Pengajuan;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pbb>
 */
class PbbFactory extends Factory
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
            'tanggal_surat' => $this->faker->date(),
            'lampiran' => $this->faker->word(),
            'pengajuan_id' => Pengajuan::factory(),
        ];
    }
}
