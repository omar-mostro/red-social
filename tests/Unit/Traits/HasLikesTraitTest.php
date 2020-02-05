<?php

namespace Tests\Unit\Traits;

use App\Models\Like;
use App\Traits\HasLikesTrait;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HasLikesTraitTest extends TestCase
{
    /**
     * @var ModelWithLikes
     */
    private $model;

    protected function setUp(): void
    {
        parent::setUp();

        $this->model = new ModelWithLikes(['id' => 1]);
    }

    use RefreshDatabase;

    /**
     * @test
     */
    public function a_model_morph_many_likes()
    {
        factory(Like::class)->create([
            'likeable_id' => $this->model->id,
            'likeable_type' => get_class($this->model)
        ]);

        $this->assertInstanceOf(Like::class, $this->model->likes->first());
    }

    /**
     ** @test
     **/
    public function a_model_can_be_like_and_unlike()
    {
        $this->actingAs(factory(User::class)->create());

        $this->model->like();

        $this->assertEquals(1, $this->model->likes()->count());

        $this->model->unlike();

        $this->assertEquals(0, $this->model->likes()->count());

    }

    /**
     ** @test
     **/
    public function a_model_can_be_liked_once()
    {


        $this->actingAs(factory(User::class)->create());

        $this->model->like();

        $this->assertEquals(1, $this->model->likes()->count());

        $this->model->like();

        $this->assertEquals(1, $this->model->likes()->count());

    }


    /**
     ** @test
     **/
    public function a_model_knows_if_it_has_been_liked()
    {

        $this->assertFalse($this->model->isLiked());

        $this->actingAs(factory(User::class)->create());

        $this->assertFalse($this->model->isLiked());

        $this->model->like();

        $this->assertTrue($this->model->isLiked());

    }

    /**
     ** @test
     **/
    public function a_model_knows_how_many_likes_it_has()
    {
        $this->assertEquals(0, $this->model->likesCount());

        factory(Like::class, 2)->create([
            'likeable_id' =>  $this->model->id,
            'likeable_type' => get_class( $this->model)
        ]);

        $this->assertEquals(2, $this->model->likesCount());
    }

    /**
     ** @test
     **/
    public function a_model_has_been_unlike()
    {
        $this->actingAs(factory(User::class)->create());

        $this->model->like();

        $this->assertTrue($this->model->isLiked());

        $this->model->unlike();

        $this->assertFalse($this->model->isLiked());

    }

}

class ModelWithLikes extends Model
{

    use HasLikesTrait;
    protected $fillable = ['id'];

}
