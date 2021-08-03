<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\View;
use Faker\Generator as Faker;

$factory->define(View::class, function (Faker $faker) {
    return [

        'user_ip' => $faker->localIpv4(),
        'accomodation_id' => $faker->numberBetween(1, 40)

    ];
});