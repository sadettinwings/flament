<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\Destinations;
use Illuminate\Database\Eloquent\Factories\Factory;

class DestinationsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Destinations::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'property_id' => \App\Models\Property::factory(),
            'bu_git_id' => \App\Models\BuGit::factory(),
        ];
    }
}
