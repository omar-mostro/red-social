<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'user_id' => factory(\App\User::class)->create(),
        'status_id' => factory(\App\Models\Status::class)->create(),
        'body' => $faker->text,
    ];
});
