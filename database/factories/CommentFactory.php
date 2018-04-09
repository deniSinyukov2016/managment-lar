<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Comment::class, function (Faker $faker) {
    return [
        'user_id'    => create(\App\Models\User::class)->id,
        'project_id' => create(\App\Models\Project::class)->id,
        'workTime'   => $faker->randomDigit,
        'body'       => $faker->paragraph,
    ];
});
