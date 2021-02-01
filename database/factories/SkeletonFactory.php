<?php

use \Faker\Generator;
use MacsiDigital\Skeleton\Skeleton;

/* @var Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Skeleton::class, function (Generator $faker) {
    return [
        'name' => $faker->firstName
    ];
});
