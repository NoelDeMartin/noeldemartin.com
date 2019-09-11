<?php

use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(App\Models\Task::class, function (Faker $faker, $defaults = []) {
    $name = isset($defaults['name']) ? $defaults['name'] : $faker->unique->sentence;

    return [
        'name' => $name,
        'slug' => Str::slug($name),
        'description_markdown' => $faker->paragraph(6),
        'description_html' => '<p>'.$faker->paragraph().'</p>',
        'completed_at' => $faker->boolean ? $faker->dateTime : null,
    ];
});
