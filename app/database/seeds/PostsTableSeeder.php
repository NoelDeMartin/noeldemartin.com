<?php

use Faker\Factory as Faker;

class PostsTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 10) as $index) {
			$title = $faker->sentence(3);
			Post::create([
				'title' => $title,
				'tag' => Post::createTitleTag($title),
				'text_markdown' => $faker->paragraph(5),
				'text_html' => '<p>' . implode($faker->paragraphs(5), '</p><p>') . '</p>',
				'author_id' => 1,
				'published_at' => $faker->date
			]);
		}
	}

}