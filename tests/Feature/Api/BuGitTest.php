<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\BuGit;

use App\Models\Owner;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BuGitTest extends TestCase
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
    public function it_gets_bu_gits_list()
    {
        $buGits = BuGit::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.bu-gits.index'));

        $response->assertOk()->assertSee($buGits[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_bu_git()
    {
        $data = BuGit::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.bu-gits.store'), $data);

        $this->assertDatabaseHas('bu_gits', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(route('api.bu-gits.update', $buGit), $data);

        $data['id'] = $buGit->id;

        $this->assertDatabaseHas('bu_gits', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_bu_git()
    {
        $buGit = BuGit::factory()->create();

        $response = $this->deleteJson(route('api.bu-gits.destroy', $buGit));

        $this->assertModelMissing($buGit);

        $response->assertNoContent();
    }
}
