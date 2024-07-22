<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Warga>
 */
class WargaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'nama' => fake()->name,
            'alamat' => fake()->address,
            'no_telp' => fake()->phoneNumber,
            'jenis_kelamin' => fake()->randomElement(['laki-laki', 'perempuan']),
            'tanggal_lahir' => fake()->date(),
        ];
    }
}
