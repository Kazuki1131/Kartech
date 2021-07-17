<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\AnnotationContent;
use Faker\Generator as Faker;

$factory->define(AnnotationContent::class, function (Faker $faker) {
    return [
        'customer_id' => $faker->numberBetween($min=1, $max=1000),
        'annotation_id' => $faker->numberBetween($min=1, $max=500),
        'content' => $faker->word,
    ];
});
