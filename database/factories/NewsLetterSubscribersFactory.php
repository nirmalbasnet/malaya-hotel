<?php

use Faker\Generator as Faker;

$factory->define(App\BackendModel\NewsLetterSubscribers::class, function (Faker $faker) {
    return [
        'email' => $faker->unique()->safeEmail,
    ];
});
