<?php

use Faker\Generator as Faker;

$factory->define(App\Article::class, function (Faker $faker) {
	$users = App\User::all()->pluck('id');
    return [
        'image' => 'noimage.jpg',
        'title' => str_limit($faker->paragraph, 50),
        'body' => $faker->paragraph,
        'section' => 'sport',
        'user_id' => $faker->randomElement($users)

    ];
});
