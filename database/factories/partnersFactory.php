<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Partner;
use Faker\Generator as Faker;

$factory->define(Partner::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'logo' => 'https://i.picsum.photos/id/27/200/300.jpg?hmac=cxfyms4Ce9ExYqZqSCKEppGQpmi8rRNNaf46Lwr5iqA',
        'url' => 'https://www.google.com/'
    ];
});
