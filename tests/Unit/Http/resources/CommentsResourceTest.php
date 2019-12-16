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

        $this->assertEquals(1, count($commentResource), 'El recurso CommentResource solo puede retornar 1 valor');

        $this->assertEquals($comment->body, $commentResource['body']);


    }
}
