<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Destinations;

use App\Models\BuGit;
use App\Models\Property;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DestinationsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_all_destinations_list()
    {
        $allDestinations = Destinations::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.all-destinations.index'));

        $response->assertOk()->assertSee($allDestinations[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_destinations()
    {
        $data = Destinations::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.all-destinations.store'), $data);

        unset($data['bu_git_id']);

        $this->assertDatabaseHas('destinations', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_destinations()
    {
        $destinations = Destinations::factory()->create();

        $property = Property::factory()->create();
        $buGit = BuGit::factory()->create();

        $data = [
            'name' => $this->faker->name,
            'property_id' => $property->id,
            'bu_git_id' => $buGit->id,
        ];

        $response = $this->putJson(
            route('api.all-destinations.update', $destinations),
            $data
        );

        unset($data['bu_git_id']);

        $data['id'] = $destinations->id;

        $this->assertDatabaseHas('destinations', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_destinations()
    {
        $destinations = Destinations::factory()->create();

        $response = $this->deleteJson(
            route('api.all-destinations.destroy', $destinations)
        );

        $this->assertModelMissing($destinations);

        $response->assertNoContent();
    }
}
