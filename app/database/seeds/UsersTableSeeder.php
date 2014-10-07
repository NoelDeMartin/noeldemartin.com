<?php

use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder {

	public function run()
	{

		User::create([
			'username'	=> 'Admin',
			'email'		=> 'admin@fake.com',
			'password'	=> Hash::make('admin'),
			'roles'		=> User::ADMIN | User::MODERATOR | User::REVIEWER
		]);

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