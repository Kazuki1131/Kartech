<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\AnnotationTitle;
use Faker\Generator as Faker;

$factory->define(AnnotationTitle::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween($min=1, $max=100),
        'title' => $faker->word,
    ];
});
