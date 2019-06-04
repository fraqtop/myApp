<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Task;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {
    return [
        'title' => $faker->text(50),
        'priority' => $faker->numberBetween(1, 6),
        'deadline' => $faker->dateTimeBetween('now', '+1 year')
    ];
});
