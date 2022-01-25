<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\SubCategory;
use Faker\Generator as Faker;

$factory->define(SubCategory::class, function (Faker $faker) {
    return [
        'name' => $faker->text(10),
        'section_id' => mt_rand(1, 4),
        'content' => $faker->text($maxNbChars = 200),
    ];
});
