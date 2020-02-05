<?php

namespace Tests\Unit\Http\resources;

use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentsResourceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function a_comment_resource_must_have_the_necessary_fields()
    {
        $comment = factory(Comment::class)->create();

        $commentResource = CommentResource::make($comment)->resolve();

        $this->assertEquals(6, count($commentResource), 'El recurso CommentResource contiene el valor incorrecto de parametros');

        $this->assertEquals($comment->body, $commentResource['body']);
        $this->assertEquals($comment->user->name, $commentResource['user_name']);
        $this->assertEquals('https://aprendible.com/images/default-avatar.jpg', $commentResource['user_avatar']);
        $this->assertEquals(0, $commentResource['likes_count']);
        $this->assertEquals(false, $commentResource['is_liked']);
        $this->assertEquals($comment->id, $commentResource['id']);



    }
}
