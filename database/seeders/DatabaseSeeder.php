<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Adding an admin user
        $user = \App\Models\User::factory()
            ->count(1)
            ->create([
                'email' => 'admin@admin.com',
                'password' => \Hash::make('admin'),
            ]);

        $this->call(BuGitSeeder::class);
        $this->call(DestinationsSeeder::class);
        $this->call(OwnerSeeder::class);
        $this->call(PropertySeeder::class);
        $this->call(UserSeeder::class);
    }
}
