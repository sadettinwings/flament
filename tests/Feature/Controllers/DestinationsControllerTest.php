<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Destinations;

use App\Models\Property;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DestinationsControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_all_destinations()
    {
        $allDestinations = Destinations::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('all-destinations.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.all_destinations.index')
            ->assertViewHas('allDestinations');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_destinations()
    {
        $response = $this->get(route('all-destinations.create'));

        $response->assertOk()->assertViewIs('app.all_destinations.create');
    }

    /**
     * @test
     */
    public function it_stores_the_destinations()
    {
        $data = Destinations::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('all-destinations.store'), $data);

        $this->assertDatabaseHas('destinations', $data);

        $destinations = Destinations::latest('id')->first();

        $response->assertRedirect(
            route('all-destinations.edit', $destinations)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_destinations()
    {
        $destinations = Destinations::factory()->create();

        $response = $this->get(route('all-destinations.show', $destinations));

        $response
            ->assertOk()
            ->assertViewIs('app.all_destinations.show')
            ->assertViewHas('destinations');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_destinations()
    {
        $destinations = Destinations::factory()->create();

        $response = $this->get(route('all-destinations.edit', $destinations));

        $response
            ->assertOk()
            ->assertViewIs('app.all_destinations.edit')
            ->assertViewHas('destinations');
    }

    /**
     * @test
     */
    public function it_updates_the_destinations()
    {
        $destinations = Destinations::factory()->create();

        $property = Property::factory()->create();

        $data = [
            'name' => $this->faker->name,
            'property_id' => $property->id,
        ];

        $response = $this->put(
            route('all-destinations.update', $destinations),
            $data
        );

        $data['id'] = $destinations->id;

        $this->assertDatabaseHas('destinations', $data);

        $response->assertRedirect(
            route('all-destinations.edit', $destinations)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_destinations()
    {
        $destinations = Destinations::factory()->create();

        $response = $this->delete(
            route('all-destinations.destroy', $destinations)
        );

        $response->assertRedirect(route('all-destinations.index'));

        $this->assertModelMissing($destinations);
    }
}
