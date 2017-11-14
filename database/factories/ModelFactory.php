<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'firstname'      => $faker->name,
        'lastname'       => $faker->name,
        'email'          => $faker->unique()->safeEmail,
        'password'       => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'area'           => $faker->randomElement(['administracion', 'comercial', 'farmacia']),
        'role'           => $faker->randomElement(['edit', 'normal']),
        'position_id'    => 2,
        'center_id'      => 2
    ];
});

$factory->define(App\Center::class, function (Faker\Generator $faker) {
    return [
        'code' => $faker->areaCode,
        'description' => $faker->sentence,
    ];
});

$factory->define(App\Position::class, function (Faker\Generator $faker) {
    return [
        'description' => $faker->sentence,
    ];
});

$factory->define(App\Document::class, function (Faker\Generator $faker) {
    return [
        'description' => $faker->areacode,
    ];
});

$factory->define(App\Solicitud::class, function (Faker\Generator $faker) {
    return [
        'description' => $faker->sentence,
    ];
});