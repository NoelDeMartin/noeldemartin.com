<?php

use Faker\Generator as Faker;

$factory->define(App\Models\TaskComment::class, function (Faker $faker) {
    return [
        'text_markdown' => $faker->paragraph(),
        'text_html' => '<p>'.$faker->paragraph().'</p>',
    ];
});
