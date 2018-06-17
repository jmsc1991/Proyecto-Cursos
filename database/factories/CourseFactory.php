<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Admin\Course::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(6, true),
        'excerpt' => $faker->sentence(4,true),
        'description' => $faker->sentence(5,true),
        'price' => $faker->randomNumber(2),
        'category_id' => $faker->numberBetween(1,5),
        'user_id' => $faker->numberBetween(1,5),
        'learn' => $faker->paragraphs(1,true),
        'requirements' => $faker->sentence(100,true),
        'photo' => $faker->randomElement(['https://upload.wikimedia.org/wikipedia/commons/thumb/2/27/PHP-logo.svg/1280px-PHP-logo.svg.png',
            'https://upload.wikimedia.org/wikipedia/commons/thumb/9/99/Unofficial_JavaScript_logo_2.svg/2000px-Unofficial_JavaScript_logo_2.svg.png',
            'https://upload.wikimedia.org/wikipedia/commons/thumb/3/3d/CSS.3.svg/2000px-CSS.3.svg.png',
            'https://c1.staticflickr.com/8/7336/14098888813_1047e39f08.jpg',
            'https://upload.wikimedia.org/wikipedia/commons/8/87/Vagrant.png',
            'https://upload.wikimedia.org/wikipedia/commons/thumb/0/00/HTML5_logo_black.svg/768px-HTML5_logo_black.svg.png'])
    ];
});
