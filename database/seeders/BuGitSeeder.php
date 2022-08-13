<?php

namespace Database\Seeders;

use App\Models\BuGit;
use Illuminate\Database\Seeder;

class BuGitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BuGit::factory()
            ->count(5)
            ->create();
    }
}
