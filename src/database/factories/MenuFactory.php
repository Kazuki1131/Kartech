<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Menu;
use Faker\Generator as Faker;

$factory->define(Menu::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween($min=1, $max=10),
        'menu_name' => $faker->word,
        'description' => $faker->realText,
        'price' => $faker->randomNumber(4),
    ];
});
