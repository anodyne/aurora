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
$factory->define(App\Data\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'username' => $faker->userName,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Data\Discussion::class, function (Faker\Generator $faker) {
    return [
        'user_id' => 1,
        'topic_id' => function () {
            return factory('App\Data\Topic')->create()->id;
        },
        'title' => $faker->sentence,
        'body' => $faker->paragraph
    ];
});

$factory->define(App\Data\Reply::class, function (Faker\Generator $faker) {
    return [
        'discussion_id' => function () {
            return factory('App\Data\Discussion')->create()->id;
        },
        'user_id' => 1,
        'body' => $faker->paragraph
    ];
});

$factory->define(App\Data\Topic::class, function (Faker\Generator $faker) {
    $name = $faker->word;

    return [
        'name' => $name,
        'slug' => $name
    ];
});
