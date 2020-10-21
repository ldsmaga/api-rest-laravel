<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Product::class, function (Faker $faker) {
    $name = $faker->sentence();
    return [
        'name'=> $name,
        'slug'=> Str::slug($name),
        'price'=>$faker->numberBetween($min = 200, $max = 6500),
        'description'=>$faker->sentence(10),
        'user'=>'1'
    ];
});
