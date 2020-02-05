<?php

namespace Tests\Feature;

use App\Models\Comment;
use App\Models\Status;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CanLikeCommentsTest extends TestCase
{
    use RefreshDatabase;

    private $comment;


    protected function setUp(): void
    {
        parent::setUp();
        $this->comment = factory(Comment::class)->create();
    }


    /**
     ** @test
     **/
    public function guests_can_not_like_comments()
    {

        $response = $this->postJson(route('comments.likes.store', $this->comment));

        $response->assertStatus(401);
    }

    /**
     ** @test
     **/
    public function an_authenticated_user_can_like_and_unlike_comments()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
        $this->actingAs($user);

        $this->assertCount(0, $this->comment->likes);

        $this->postJson(route('comments.likes.store', $this->comment));

        $this->assertCount(1, $this->comment->fresh()->likes);

        $this->assertDatabaseHas('likes', [
            'user_id' => $user->id,
        ]);

        //se inserta el segundo like con un usuario diferente
        $this->flushSession();

        $user = factory(User::class)->create();
        $this->actingAs($user);

        $this->postJson(route('comments.likes.store', $this->comment));

        $this->assertCount(2, $this->comment->fresh()->likes);

        //se elimina el like del usuario actual autenticado y solo queda un solo like
        $this->deleteJson(route('comments.likes.destroy', $this->comment));

        $this->assertCount(1, $this->comment->fresh()->likes);
        $this->assertDatabaseMissing('likes', [
            'user_id' => $user->id,
        ]);


    }
}
