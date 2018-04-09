<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Idea::class, function (Faker $faker) {
    return [
        'title'       => $faker->sentence(),
        'description' => $faker->text(),
        'user_id'     => create(\App\Models\User::class)->id,
        'status'      => $faker->randomElement(array_keys(config('enums.ideas.statuses'))),
    ];
});
