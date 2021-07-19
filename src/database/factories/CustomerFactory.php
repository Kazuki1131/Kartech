<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Customer;
use Faker\Generator as Faker;

$factory->define(Customer::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween($min=1, $max=100),
        'name' => $faker->name,
        'name_kana' => $faker->kanaName,
        'gender' => $faker->numberBetween($min=1, $max=2),
        'birthday' => $faker->date($format='Y-m-d', $max='now'),
        'tel' => $faker->phoneNumber,
        'email' => $faker->safeEmail,
        'memo' => $faker->realText,
    ];
});
