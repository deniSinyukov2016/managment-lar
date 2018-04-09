<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Meeting::class, function (Faker $faker) {
    return [
        'name'        => $faker->sentence(),
        'description' => $faker->text(500),
        'date_time'   => $faker->dateTimeBetween('-1 week', '+1 week'),
        'results'     => $faker->text(1000),
        'is_close'    => $faker->boolean(80),
        'project_id'  => create(\App\Models\Project::class)->id,
        'creator_id'  => create(\App\Models\User::class)->id,
    ];
});
