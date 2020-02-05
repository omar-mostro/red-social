<?php

namespace Tests\Feature;

use App\Models\Status;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateCommentsTest extends TestCase
{
    use RefreshDatabase;

    private $status;

    protected function setUp(): void
    {
        parent::setUp();

        $this->status = factory(Status::class)->create();
    }


    /**
     * @test
     */

    public function guest_users_cannot_create_comments()
    {
        $user = factory(User::class)->create();

        $comment = ['body' => 'Mi primer comentario'];
        $response = $this->postJson(route('statuses.comments.store', $this->status->id), $comment);

        $response->assertStatus(401);

    }

    /**
     * @test
     */
    public function authenticated_users_can_comment_statuses()
    {

        $this->withoutExceptionHandling();

        $this->actingAs($user = factory(User::class)->create());

        $comment = ['body' => 'Mi primer comentario'];
        $response = $this->postJson(route('statuses.comments.store', $this->status->id), $comment);

        $response->assertJson([
            'data' => [
                'body' => $comment['body']
            ]
        ]);

        $this->assertDatabaseHas('comments', [
            'user_id' => $user->id,
            'status_id' => $this->status->id,
            'body' => $comment['body']
        ]);
    }

    /**
     ** @test
     **/
    public function a_comment_requires_a_body()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $response = $this->postJson(route('statuses.comments.store', $this->status->id), ['body' => '']);

        $response->assertStatus(422);

        $response->assertJsonStructure([
            'message', 'errors' => ['body']
        ]);
    }


}
