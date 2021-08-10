<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\VisitedRecord;
use Faker\Generator as Faker;

$factory->define(VisitedRecord::class, function (Faker $faker) {
    return [
        'customer_id' => $faker->numberBetween($min = 1, $max = 1000),
        'menu_id' => $faker->numberBetween($min = 1, $max = 1000),
        'note' => $faker->realText,
        'image' => $faker->imageUrl,
        'visited_at' => $faker->date($format = 'Y-m-d', $max = 'now'),
    ];
});
