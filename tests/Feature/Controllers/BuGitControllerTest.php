<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\BuGit;

use App\Models\Owner;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BuGitControllerTest extends TestCase
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
    public function it_displays_index_view_with_bu_gits()
    {
        $buGits = BuGit::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('bu-gits.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.bu_gits.index')
            ->assertViewHas('buGits');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_bu_git()
    {
        $response = $this->get(route('bu-gits.create'));

        $response->assertOk()->assertViewIs('app.bu_gits.create');
    }

    /**
     * @test
     */
    public function it_stores_the_bu_git()
    {
        $data = BuGit::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('bu-gits.store'), $data);

        $this->assertDatabaseHas('bu_gits', $data);

        $buGit = BuGit::latest('id')->first();

        $response->assertRedirect(route('bu-gits.edit', $buGit));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_bu_git()
    {
        $buGit = BuGit::factory()->create();

        $response = $this->get(route('bu-gits.show', $buGit));

        $response
            ->assertOk()
            ->assertViewIs('app.bu_gits.show')
            ->assertViewHas('buGit');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_bu_git()
    {
        $buGit = BuGit::factory()->create();

        $response = $this->get(route('bu-gits.edit', $buGit));

        $response
            ->assertOk()
            ->assertViewIs('app.bu_gits.edit')
            ->assertViewHas('buGit');
    }

    /**
     * @test
     */
    public function it_updates_the_bu_git()
    {
        $buGit = BuGit::factory()->create();

        $owner = Owner::factory()->create();

        $data = [
            'owner_id' => $owner->id,
        ];

        $response = $this->put(route('bu-gits.update', $buGit), $data);

        $data['id'] = $buGit->id;

        $this->assertDatabaseHas('bu_gits', $data);

        $response->assertRedirect(route('bu-gits.edit', $buGit));
    }

    /**
     * @test
     */
    public function it_deletes_the_bu_git()
    {
        $buGit = BuGit::factory()->create();

        $response = $this->delete(route('bu-gits.destroy', $buGit));

        $response->assertRedirect(route('bu-gits.index'));

        $this->assertModelMissing($buGit);
    }
}
