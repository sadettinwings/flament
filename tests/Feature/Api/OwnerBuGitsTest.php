<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Owner;
use App\Models\BuGit;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OwnerBuGitsTest extends TestCase
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
    public function it_gets_owner_bu_gits()
    {
        $owner = Owner::factory()->create();
        $buGits = BuGit::factory()
            ->count(2)
            ->create([
                'owner_id' => $owner->id,
            ]);

        $response = $this->getJson(route('api.owners.bu-gits.index', $owner));

        $response->assertOk()->assertSee($buGits[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_owner_bu_gits()
    {
        $owner = Owner::factory()->create();
        $data = BuGit::factory()
            ->make([
                'owner_id' => $owner->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.owners.bu-gits.store', $owner),
            $data
        );

        $this->assertDatabaseHas('bu_gits', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $buGit = BuGit::latest('id')->first();

        $this->assertEquals($owner->id, $buGit->owner_id);
    }
}
