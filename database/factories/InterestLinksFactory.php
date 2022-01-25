<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\InterestLink;
use Faker\Generator as Faker;

$factory->define(InterestLink::class, function (Faker $faker) {
    return [
        'title' => $faker->text(20),
        'url_redirect' => $faker->url,
        'url_icon' => 'https://cdn-icons.flaticon.com/png/512/1354/premium/1354217.png?token=exp=1642876729~hmac=39f58ef26633fe921deb26228c58eac9',
    ];
});
