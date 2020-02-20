<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Throwable;

class UsersCanRegisterTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     ** @test
     *
     * @throws Throwable
     */
    public function user_can_register()
    {
        $this->browse(function (Browser $browser){
            $browser->visit(route('register'))
                ->type('name', 'OmarSanchez')
                ->type('first_name', 'Omar')
                ->type('last_name', 'Sanchez')
                ->type('email', 'omar@psd.com')
                ->type('password', 'secret123')
                ->type('password_confirmation', 'secret123')
                ->press('@register-btn')
                ->assertUrlIs(route('index').'/')
                ->assertAuthenticated()
            ;
        });
    }

    /**
     ** @test
     *
     * @throws Throwable
     */
    public function user_can_not_register_with_invalid_information()
    {
        $this->browse(function (Browser $browser){
            $browser->visit(route('register'))
                ->type('name', '')
                ->press('@register-btn')
                ->assertUrlIs(route('register'))
                ->assertPresent('@validation-errors')
            ;
        });
    }

}
