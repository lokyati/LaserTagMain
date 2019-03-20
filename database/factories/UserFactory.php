<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
        'lvl' => $faker->unique()->randomNumber(),
        'battle_point_balance' => $faker->unique()->randomNumber(),
    ];
});

/*$factory->define(App\User::class, function (Faker $faker) {
    return [
        'token' => $faker->word
    ];
});

$factory->define(App\UsersStat::class, function (Faker $faker) {
    return [
        'warname' => $faker->name,
        'score' => $faker->randomDigit,
        'guest_token_id' => $faker->numberBetween($min = 1, $max = 10)
    ];
});*/