<?php

namespace Database\Factories;

use App\Models\BuGit;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class BuGitFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BuGit::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'owner_id' => \App\Models\Owner::factory(),
        ];
    }
}
