<?php

namespace Database\Factories;

use App\Models\Aset;
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
            'aset_id' => Aset::factory(),
            'no_surat' => fake()->word,
            'tanggal_surat' => fake()->date(),
            'perihal' => fake()->word,
            'keterangan' => fake()->word,
            'user_id' => User::factory(),
        ];
    }
}
