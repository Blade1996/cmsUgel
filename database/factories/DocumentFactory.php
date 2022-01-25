<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Documents;
use Faker\Generator as Faker;

$factory->define(Documents::class, function (Faker $faker) {
    return [
        'title' => $faker->text(20),
        'category_id' => mt_rand(1, 5),
        'slug' => $faker->slug(),
        'description' => $faker->text($maxNbChars = 200),
        'url_file' => 'https://www.cultura.gob.cl/wp-content/uploads/2014/01/un-cuento-al-dia-antologia.pdf',
    ];
});
