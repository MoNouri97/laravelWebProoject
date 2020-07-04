<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence($nbWords = 3, $variableNbWords = true),
        'body' => $faker->text($maxNbChars = 200) ,
        'user_id' => '1',
        'tags' => $faker->words($nb = 3, $asText = false), // array('porro', 'sed', 'magni')
        'cover_image' => ''.$faker->numberBetween(1, 18).'.jpg'
    ];



});
