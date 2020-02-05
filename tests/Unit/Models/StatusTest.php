<?php

namespace Tests\Unit\Models;

use App\Models\Comment;
use App\Models\Status;
use App\Traits\HasLikesTrait;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StatusTest extends TestCase
{
    use RefreshDatabase;

    private $status;

    protected function setUp() :void
    {
        parent::setUp();
        $this->status = factory(Status::class)->create();


    }


    /**
     * @test
     */
    public function a_status_belongs_to_a_user()
    {
        $this->assertInstanceOf(User::class, $this->status->user);
    }


    /**
     * @test
     */
    public function a_status_has_many_comments()
    {


        factory(Comment::class)->create(['status_id' => $this->status->id]);

        $this->assertInstanceOf(Comment::class, $this->status->comments->first());
    }

    /**
     ** @test
     **/
    public function a_status_model_must_use_the_trait_has_likes()
    {
        $this->assertClassUsesTrait(HasLikesTrait::class, Status::class);
    }


}
