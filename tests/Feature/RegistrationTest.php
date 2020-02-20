<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    private $userData = [];

    protected function setUp(): void
    {
        parent::setUp();

        $this->userData = [
            'name' => 'OmarSanchezMartinez',
            'first_name' => 'Omar',
            'last_name' => 'SanchezMartienz',
            'email' => 'omar@gmail.com',
            'password' => 'secret@123',
            'password_confirmation' => 'secret@123',
        ];
    }


    /**
     ** @test
     **/
    public function users_can_register()
    {

        $this->get(route('register'))->assertSuccessful();

        $response = $this->post(route('register'), $this->userData);

        $response->assertRedirect('/');

        $this->assertDatabaseHas('users', [
            'name' => 'OmarSanchezMartinez',
            'first_name' => 'Omar',
            'last_name' => 'SanchezMartienz',
            'email' => 'omar@gmail.com',
        ]);

        $this->assertTrue(\Hash::check('secret@123', User::first()->password));
    }

    /**
     ** @test
     **/
    public function the_name_is_required()
    {
        $this->userData['name'] = null;
        $this->post(route('register'), $this->userData)
            ->assertSessionHasErrors('name');
    }

    /**
     ** @test
     **/
    public function the_name_must_be_a_string()
    {
        $this->userData['name'] = 123123123;
        $this->post(route('register'), $this->userData)
            ->assertSessionHasErrors('name');
    }

    /**
     ** @test
     **/
    public function name_must_have_at_least_3_characters()
    {
        $this->userData['name'] = 'a1';
        $this->post(route('register'), $this->userData)
            ->assertSessionHasErrors('name');
    }

    /**
     ** @test
     **/
    public function the_name_may_not_be_greater_than_255_characters()
    {
        $this->userData['name'] = Str::random(256);
        $this->post(route('register'), $this->userData)
            ->assertSessionHasErrors('name');
    }

    /**
     ** @test
     **/
    public function the_name_must_be_unique()
    {
        $user = factory(User::class)->create();

        $this->userData['name'] = $user->name;
        $this->post(route('register'), $this->userData)
            ->assertSessionHasErrors('name');
    }

    /**
     ** @test
     **/
    public function the_name_may_only_contain_letters_and_numbers()
    {

        $this->userData['name'] = 'Omar Sanxhez';
        $this->post(route('register'), $this->userData)
            ->assertSessionHasErrors('name');
    }

    /**
     ** @test
     **/
    public function the_first_name_is_required()
    {
        $this->userData['first_name'] = null;
        $this->post(route('register'), $this->userData)
            ->assertSessionHasErrors('first_name');
    }

    /**
     ** @test
     **/
    public function first_name_must_have_at_least_3_characters()
    {
        $this->userData['first_name'] = 'a1';
        $this->post(route('register'), $this->userData)
            ->assertSessionHasErrors('first_name');
    }

    /**
     ** @test
     **/
    public function the_first_name_must_be_a_string()
    {
        $this->userData['first_name'] = 123123123;
        $this->post(route('register'), $this->userData)
            ->assertSessionHasErrors('first_name');
    }

    /**
     ** @test
     **/
    public function the_first_name_may_not_be_greater_than_255_characters()
    {
        $this->userData['first_name'] = Str::random(256);
        $this->post(route('register'), $this->userData)
            ->assertSessionHasErrors('first_name');
    }

    /**
     ** @test
     **/
    public function the_last_name_is_required()
    {
        $this->userData['last_name'] = null;
        $this->post(route('register'), $this->userData)
            ->assertSessionHasErrors('last_name');
    }

    /**
     ** @test
     **/
    public function last_name_must_have_at_least_3_characters()
    {
        $this->userData['last_name'] = 'a1';
        $this->post(route('register'), $this->userData)
            ->assertSessionHasErrors('last_name');
    }

    /**
     ** @test
     **/
    public function the_last_name_must_be_a_string()
    {
        $this->userData['last_name'] = 123123123;
        $this->post(route('register'), $this->userData)
            ->assertSessionHasErrors('last_name');
    }

    /**
     ** @test
     **/
    public function the_last_name_may_not_be_greater_than_255_characters()
    {
        $this->userData['last_name'] = Str::random(256);
        $this->post(route('register'), $this->userData)
            ->assertSessionHasErrors('last_name');
    }

    /**
     ** @test
     **/
    public function the_email_is_required()
    {
        $this->userData['email'] = null;
        $this->post(route('register'), $this->userData)
            ->assertSessionHasErrors('email');
    }

    /**
     ** @test
     **/
    public function the_email_must_be_a_string()
    {
        $this->userData['email'] = 123123123;
        $this->post(route('register'), $this->userData)
            ->assertSessionHasErrors('email');
    }

    /**
     ** @test
     **/
    public function the_email_must_be_a_valid_email_address()
    {
        $this->userData['email'] = 'asdasdas';
        $this->post(route('register'), $this->userData)
            ->assertSessionHasErrors('email');
    }


    /**
     ** @test
     **/
    public function the_email_may_not_be_greater_than_255_characters()
    {
        $this->userData['email'] = Str::random(256);
        $this->post(route('register'), $this->userData)
            ->assertSessionHasErrors('email');
    }

    /**
     ** @test
     **/
    public function the_email_must_be_unique()
    {
        $user = factory(User::class)->create();

        $this->userData['email'] = $user->email;
        $this->post(route('register'), $this->userData)
            ->assertSessionHasErrors('email');
    }

    /**
     ** @test
     **/
    public function the_password_is_required()
    {
        $this->userData['password'] = null;
        $this->post(route('register'), $this->userData)
            ->assertSessionHasErrors('password');
    }

    /**
     ** @test
     **/
    public function the_password_must_be_a_string()
    {
        $this->userData['password'] = 123123123;
        $this->post(route('register'), $this->userData)
            ->assertSessionHasErrors('password');
    }

    /**
     ** @test
     **/
    public function the_password_may_be_at_least_8_characters()
    {
        $this->userData['password'] = Str::random(7);
        $this->post(route('register'), $this->userData)
            ->assertSessionHasErrors('password');
    }

    /**
     ** @test
     **/
    public function the_password_must_be_confirmed()
    {
        $this->userData['password'] = 'asdasdasdsa';
        $this->userData['password_confirmation'] = null;
        $this->post(route('register'), $this->userData)
            ->assertSessionHasErrors('password');
    }

}
