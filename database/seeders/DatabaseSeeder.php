<?php

namespace Database\Seeders;

use App\Models\Pbb;
use App\Models\Aset;
use App\Models\Sporadik;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Warga;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->admin()->create();
        Aset::factory()->create();
        Pbb::factory()->create();
        Sporadik::factory()->create();

    }
}
