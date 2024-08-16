<?php

namespace Database\Factories;

use App\Models\Warga;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pengajuan>
 */
class PengajuanFactory extends Factory
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
            'jenis_surat' => $this->faker->randomElement(['pbb', 'sporadik']),
            'tanggal' => $this->faker->date(),
            'perihal' => $this->faker->word(),
            'keterangan' => $this->faker->word(),
            'lampiran' => $this->faker->word(),
            'status' => $this->faker->randomElement(['Diterima', 'Ditolak', 'Diproses']),
            'pesan' => $this->faker->word(),
        ];
    }
}
