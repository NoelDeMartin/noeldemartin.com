<?php

use Faker\Factory as Faker;

class PostsTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 10) as $index)
		{
			Post::create([
				'title' => $faker->sentence(3),
				'tag' => $faker->sentence(3),
				'text_markdown' => $faker->paragraph(5),
				'text_html' => $faker->paragraph(5),
				'author_id' => 1,
				'published_at' => $faker->date
			]);
		}
	}

}