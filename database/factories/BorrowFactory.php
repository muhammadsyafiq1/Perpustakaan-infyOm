<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Borrow;
use Faker\Generator as Faker;

$factory->define(Borrow::class, function (Faker $faker) {

    return [
        'user_id' => $faker->word,
        'book_id' => $faker->word,
        'date' => $faker->word,
        'deleted_at' => $faker->date('Y-m-d H:i:s'),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
