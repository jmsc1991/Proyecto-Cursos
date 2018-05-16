<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Admin\Video::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(),
        'description' => $faker->paragraphs(5,true),
        'url' => 'https://www.youtube.com/watch?v=VYOjWnS4cMY',
        'course_id' => $faker->numberBetween(1,10),

    ];
});
