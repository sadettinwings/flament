<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Property;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PropertyControllerTest extends TestCase
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
    public function it_displays_index_view_with_properties()
    {
        $properties = Property::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('properties.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.properties.index')
            ->assertViewHas('properties');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_property()
    {
        $response = $this->get(route('properties.create'));

        $response->assertOk()->assertViewIs('app.properties.create');
    }

    /**
     * @test
     */
    public function it_stores_the_property()
    {
        $data = Property::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('properties.store'), $data);

        $this->assertDatabaseHas('properties', $data);

        $property = Property::latest('id')->first();

        $response->assertRedirect(route('properties.edit', $property));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_property()
    {
        $property = Property::factory()->create();

        $response = $this->get(route('properties.show', $property));

        $response
            ->assertOk()
            ->assertViewIs('app.properties.show')
            ->assertViewHas('property');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_property()
    {
        $property = Property::factory()->create();

        $response = $this->get(route('properties.edit', $property));

        $response
            ->assertOk()
            ->assertViewIs('app.properties.edit')
            ->assertViewHas('property');
    }

    /**
     * @test
     */
    public function it_updates_the_property()
    {
        $property = Property::factory()->create();

        $data = [
            'name' => $this->faker->text,
            'image' => $this->faker->text(255),
        ];

        $response = $this->put(route('properties.update', $property), $data);

        $data['id'] = $property->id;

        $this->assertDatabaseHas('properties', $data);

        $response->assertRedirect(route('properties.edit', $property));
    }

    /**
     * @test
     */
    public function it_deletes_the_property()
    {
        $property = Property::factory()->create();

        $response = $this->delete(route('properties.destroy', $property));

        $response->assertRedirect(route('properties.index'));

        $this->assertModelMissing($property);
    }
}
