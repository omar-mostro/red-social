<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CrateStatusTest extends TestCase
{
    use DatabaseMigrations;

    /**
     ** @test
     **/
    public function guest_users_can_not_create_statuses()
    {

        $response = $this->post(route('statuses.store'), ['body' => 'Mi primer status']);

        $response->assertRedirect('login');
    }

    /**
     * @test
     */
    public function an_authenticated_user_can_create_statuses()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $response = $this->post(route('statuses.store'), ['body' => 'Mi primer status']);

        $response->assertSuccessful();

        $response->assertJson([
            'data' => ['body' => 'Mi primer status']
        ]);

    }

    /**
     ** @test
     **/
    public function a_status_requires_a_body()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $response = $this->postJson(route('statuses.store'), ['body' => '']);

        $response->assertStatus(422);

        $response->assertJsonStructure([
            'message', 'errors' => ['body']
        ]);
    }

    /**
     ** @test
     **/
    public function a_status_body_requires_a_minimum_length(){
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $response = $this->postJson(route('statuses.store'), ['body' => 'asd']);

        $response->assertStatus(422);

        $response->assertJsonStructure([
            'message', 'errors' => ['body']
        ]);
    }
}
