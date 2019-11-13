<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'category_id'   => random_int(1, 5),
        'name'          => $faker->unique()->word,
        'description'   => $faker->sentence(),
    ];
});
