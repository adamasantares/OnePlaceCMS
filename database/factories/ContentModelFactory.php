<?php

use Faker\Generator as Faker;

$factory->define(App\ContentModel::class, function (Faker $faker) {
    return [
        'title' => $faker->word
    ];
});
