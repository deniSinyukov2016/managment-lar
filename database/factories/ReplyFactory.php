<?php

use App\Models\Reply;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Reply::class, function (Faker $faker) {
    return [
        'body'              => $faker->words(random_int(2, 10), true),
        'repliable_id'      =>1,
        'user_id'           => create(User::class)->id,
        'repliable_type'    => "hy"
    ];
});
