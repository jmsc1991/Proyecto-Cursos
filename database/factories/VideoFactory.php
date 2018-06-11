<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Admin\Video::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(4, true),
        'description' => $faker->sentence(6,true),
        'url' => 'https://www.youtube-nocookie.com/embed/VYOjWnS4cMY',
        'course_id' => $faker->numberBetween(1,20),
        'free' => $faker->boolean(),
    ];
});
