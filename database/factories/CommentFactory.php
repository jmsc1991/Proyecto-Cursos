<?php

use Faker\Generator as Faker;
use App\Models\Admin\Comment;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'content' => $faker->paragraphs(5, true),
        'video_id' => $faker->numberBetween(1,10),
        'user_id' => $faker->numberBetween(1,2),
        'parent_id' => $faker->randomElement([null,0,1,2,3,4,5,6,7,8,9]),
    ];
});
