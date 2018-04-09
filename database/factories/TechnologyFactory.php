<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Technology::class, function (Faker $faker) {
    return [
        'name' => $name = $faker->word,
        'slug' => $name
    ];
});
