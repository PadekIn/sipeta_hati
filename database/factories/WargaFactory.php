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
            'nama' => fake()->lastName,
            'alamat' => fake()->sentence(2),
            'no_telp' => fake()->e164PhoneNumber,
            'jenis_kelamin' => fake()->randomElement(['laki-laki', 'perempuan']),
            'tanggal_lahir' => fake()->date(),
        ];
    }
}
