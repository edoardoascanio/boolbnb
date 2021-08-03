<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Message;
use Faker\Generator as Faker;

$factory->define(Message::class, function (Faker $faker) {
    return [
        'content'=> $faker->text(),
        'object_email'=>$faker->sentence(),
        'email_sender'=>$faker->email(),
        'accomodation_id' => $faker->numberBetween(1, 40)
    ];
});
