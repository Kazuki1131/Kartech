<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\AnnotationContent;
use Faker\Generator as Faker;

$factory->define(AnnotationContent::class, function (Faker $faker) {
    return [
        'customer_id' => $faker->numberBetween($min=1, $max=100),
        'annotation_id' => $faker->numberBetween($min=1, $max=50),
        'content' => $faker->word,
    ];
});
