<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Admin\Course::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(),
        'excerpt' => $faker->sentence(100,true),
        'description' => $faker->paragraphs(5,true),
        'price' => $faker->randomNumber(2),
        'category_id' => $faker->numberBetween(1,10),
        'user_id' => $faker->numberBetween(1,5),
        'learn' => $faker->paragraphs(1,true),
        'requirements' => $faker->sentence(100,true),
    ];
});
