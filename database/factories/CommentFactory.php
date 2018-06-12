<?php

use Faker\Generator as Faker;
use App\Models\Admin\Comment;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'content' => $faker->paragraphs(2, true),
        'video_id' => $faker->numberBetween(1,50),
        'user_id' => $faker->numberBetween(1,5),
        'parent_id' => $faker->randomElement([null]),
    ];
});
