<?php

use jeremykenedy\LaravelRoles\Models\Role;

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

/* @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    static $password;
    $userRole = Role::whereName('User')->first();

    return [
        'name'                           => $faker->unique()->userName,
        'first_name'                     => $faker->firstName,
        'last_name'                      => $faker->lastName,
        'email'                          => $faker->unique()->safeEmail,
        'password'                       => $password ?: $password = bcrypt('secret'),
        'token'                          => str_random(64),
        'activated'                      => true,
        'remember_token'                 => str_random(10)
    ];
});

$factory->define(App\Models\Organisation::class, function (Faker\Generator $faker) {

    return [
        'name'                           => $faker->company,
        'logo'                           => $faker->imageUrl(200, 200),
    ];
});

$factory->define(App\Models\Profile::class, function (Faker\Generator $faker) {
    return [
        'user_id'                       => factory(App\Models\User::class)->create()->id,
        'organisation_id'               => factory(App\Models\Organisation::class)->create()->id
    ];
});
