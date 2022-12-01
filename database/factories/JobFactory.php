<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Job;
use Faker\Generator as Faker;

$factory->define(Job::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'title' => $faker->sentence(),
        'company' => $faker->paragraph(),
        'role' => $faker->paragraph(),
        'other' => $faker->paragraph(),
        'apply_url' => "https://google.com",
        'location' => $faker->numberBetween(1, 5),
        'entry' => 0,
        'type' => 1,
        'company_name' => $faker->name(),
        'visible' => 1
    ];
});
