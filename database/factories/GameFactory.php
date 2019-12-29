<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Game;
use Faker\Generator as Faker;

$factory->define(Game::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'release_date' => $faker->date(),
        'min_age' => $faker->numberBetween(3, 18),
        'min_max_player' => 1 . "-" . $faker->numberBetween(50, 100), // password
        'min_max_duration' => 1 . "-" . $faker->numberBetween(50, 100),
        'description' => $faker->realText()
    ];
});

