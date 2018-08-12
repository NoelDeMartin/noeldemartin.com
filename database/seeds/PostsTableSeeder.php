<?php

use App\Models\Post;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            $title = $faker->sentence(3);
            Post::create([
                'title' => $title,
                'tag' => Post::createTitleTag($title),
                'text_markdown' => $faker->paragraph(6),
                'text_html' =>
                    '<p>' . $faker->paragraph() . '</p>' .
                    '<h2>' . $faker->sentence(4) . '</h2>' .
                    '<p>' . implode($faker->paragraphs(5), '</p><p>') . '</p>',
                'author_id' => 1,
                'published_at' => $faker->date,
            ]);
        }
    }
}
