<?php

use Faker\Generator as Faker;
use App\Models\Admin\Category;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $faker->words(2,true),
        'description' => $faker->paragraphs(2,true),
    ];
});
