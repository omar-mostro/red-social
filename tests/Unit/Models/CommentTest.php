<?php

namespace Tests\Unit\Models;

use App\Models\Comment;
use App\Traits\HasLikesTrait;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    private $comment;

    protected function setUp(): void
    {
        parent::setUp();

        $this->comment = factory(Comment::class)->create();
    }

    /**
     * @test
     */
    public function a_comment_belongs_to_a_user()
    {


        $this->assertInstanceOf(User::class, $this->comment->user);
    }

    /**
     ** @test
     **/
    public function a_comment_model_must_use_the_trait_has_likes()
    {
        $this->assertClassUsesTrait(HasLikesTrait::class, Comment::class);
    }


}
