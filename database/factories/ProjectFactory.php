<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Project::class, function (Faker $faker) {
    return [
        'title'       => $faker->words(random_int(2, 10), true),
        'description' => $faker->text(random_int(30, 500)),
        'user_id'     => 1,
        'status'      => $faker->randomElement(array_keys(config('enums.projects.statuses'))),
        'type'        => $faker->randomElement(array_keys(config('enums.projects.types'))),
        'hours'       => random_int(400, 2000),
        'priority'    => $faker->randomElement(array_keys(config('enums.projects.priorities'))),
        'date_end'    => $faker->date('Y-m-d', '+1 year')
    ];
});