<?php

namespace Database\Seeders;

use App\Models\Destinations;
use Illuminate\Database\Seeder;

class DestinationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Destinations::factory()
            ->count(5)
            ->create();
    }
}
