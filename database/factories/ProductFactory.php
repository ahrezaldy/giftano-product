<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    $category = App\Category::all()->first();
    return [
        'name' => $faker->name,
        'category_id' => $category->id,
    ];
});
