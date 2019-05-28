<?php

use Faker\Generator as Faker;

$factory->define(App\Project::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'published' => $faker->numberBetween(0, 1),
        'key' => $faker->regexify('[A-Z0-9._]{9}')
    ];
});
