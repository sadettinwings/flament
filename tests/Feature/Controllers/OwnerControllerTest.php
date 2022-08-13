<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Owner;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OwnerControllerTest extends TestCase
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
    public function it_displays_index_view_with_owners()
    {
        $owners = Owner::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('owners.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.owners.index')
            ->assertViewHas('owners');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_owner()
    {
        $response = $this->get(route('owners.create'));

        $response->assertOk()->assertViewIs('app.owners.create');
    }

    /**
     * @test
     */
    public function it_stores_the_owner()
    {
        $data = Owner::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('owners.store'), $data);

        $this->assertDatabaseHas('owners', $data);

        $owner = Owner::latest('id')->first();

        $response->assertRedirect(route('owners.edit', $owner));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_owner()
    {
        $owner = Owner::factory()->create();

        $response = $this->get(route('owners.show', $owner));

        $response
            ->assertOk()
            ->assertViewIs('app.owners.show')
            ->assertViewHas('owner');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_owner()
    {
        $owner = Owner::factory()->create();

        $response = $this->get(route('owners.edit', $owner));

        $response
            ->assertOk()
            ->assertViewIs('app.owners.edit')
            ->assertViewHas('owner');
    }

    /**
     * @test
     */
    public function it_updates_the_owner()
    {
        $owner = Owner::factory()->create();

        $data = [
            'name' => $this->faker->text,
        ];

        $response = $this->put(route('owners.update', $owner), $data);

        $data['id'] = $owner->id;

        $this->assertDatabaseHas('owners', $data);

        $response->assertRedirect(route('owners.edit', $owner));
    }

    /**
     * @test
     */
    public function it_deletes_the_owner()
    {
        $owner = Owner::factory()->create();

        $response = $this->delete(route('owners.destroy', $owner));

        $response->assertRedirect(route('owners.index'));

        $this->assertModelMissing($owner);
    }
}
