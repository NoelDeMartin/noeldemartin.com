<?php

use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 10) as $index)
		{
			User::create([
				'username'	=> $faker->name,
				'email'		=> $faker->email,
				'password'	=> Hash::make('secret'),
				'roles'		=> User::NO_ROLES
			]);
		}
	}

}