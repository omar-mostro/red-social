<?php

namespace Tests\Browser;


use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Throwable;

class LoginTest extends DuskTestCase
{
    Use DatabaseMigrations;

    /**
     * A Dusk test example.
     *
     * @return void
     * @test
     * @throws \Throwable
     */
    public function registered_users_can_login()
    {
        $user = factory(User::class)->create();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit(route('login'))
                ->type('email', $user->email)
                ->type('password', 'password')
                ->screenshot('test')
                ->press('@login-btn')
                ->assertUrlIs(route('index').'/')
                ->assertAuthenticated();
        });
    }

    /**
     ** @test
     *
     * @throws Throwable
     */
    public function user_can_not_login_with_invalid_information()
    {
        $this->browse(function (Browser $browser){
            $browser->visit(route('login'))
                ->type('email', '')
                ->press('@login-btn')
                ->assertUrlIs(route('login'))
                ->assertPresent('@validation-errors')
            ;
        });
    }
}
