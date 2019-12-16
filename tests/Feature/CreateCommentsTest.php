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

    /**
     * @test
     */

    public function guest_users_cannot_create_comments()
    {
        $status = factory(Status::class)->create();
        $user = factory(User::class)->create();

        $comment = ['body' => 'Mi primer comentario'];
        $response = $this->postJson(route('statuses.comments.store', $status->id), $comment);

        $response->assertStatus(401);

    }

    /**
     * @test
     */
    public function authenticated_users_can_comment_statuses()
    {

        $this->withoutExceptionHandling();

        $status = factory(Status::class)->create();
        $this->actingAs($user = factory(User::class)->create());

        $comment = ['body' => 'Mi primer comentario'];
        $response = $this->postJson(route('statuses.comments.store', $status->id), $comment);

        $response->assertJson([
            'data' => [
                'body' => $comment['body']
            ]
        ]);

        $this->assertDatabaseHas('comments', [
            'user_id' => $user->id,
            'status_id' => $status->id,
            'body' => $comment['body']
        ]);
    }
}
