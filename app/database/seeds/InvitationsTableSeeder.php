<?php

use Faker\Factory as Faker;

class InvitationsTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 10) as $index)
		{
			Invitation::create([
				'token'	=> md5($faker->email),
				'email'	=> $faker->email,
				'used'	=> rand(0,1) == 1
			]);
		}
	}

}