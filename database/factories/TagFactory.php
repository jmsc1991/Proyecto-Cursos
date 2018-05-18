<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Admin\Tag::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->paragraphs(2, true),

    ];
});
