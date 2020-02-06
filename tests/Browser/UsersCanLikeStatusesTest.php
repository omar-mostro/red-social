<?php

namespace Tests\Browser;

use App\Models\Status;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class UsersCanLikeStatusesTest extends DuskTestCase
{
    use DatabaseMigrations;


    /**
     * @test
     */
    public function users_can_like_and_unlike_statuses()
    {
        $user = factory(User::class)->create();
        $status = factory(Status::class)->create();

        $this->browse(function (Browser $browser) use ($user, $status) {
            $browser->loginAs($user)
                ->visit(route('index'))
                ->waitForText($status->body)
                ->assertSeeIn('@likes-count', 0)
                ->press('@like-btn')
                ->assertSee('TE GUSTA')
                ->waitForText('1')
                ->assertSeeIn('@likes-count', 1)
                ->press('@like-btn')
                ->assertSee('Me Gusta')
                ->waitForText('0')
                ->assertSeeIn('@likes-count', 0);
        });
    }


    /**
     * @test
     */
    public function guest_users_can_not_like_statuses()
    {
        $status = factory(Status::class)->create();

        $this->browse(function (Browser $browser) use ($status) {
            $browser
                ->visit(route('index'))
                ->waitForText($status->body)
                ->press('@like-btn')
                ->assertUrlIs(route('login'));
        });
    }
}
