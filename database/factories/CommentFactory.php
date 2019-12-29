<?php

/** @var Factory $factory */

use App\Models\Comment;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'title' => $faker->jobTitle,
        'body' => $faker->realText(),
        'author' => $faker->userName,
        'game_id' => $faker->numberBetween(1, 10)
    ];
});

