<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder {

	public function run()
	{

		User::create([
			'username'		=> 'Admin',
			'email'			=> 'admin@fake.com',
			'password'		=> Hash::make('secret'),
			'is_admin'		=> true,
			'is_reviewer'	=> true
		]);

		User::create([
			'username'		=> 'Reviewer',
			'email'			=> 'reviewer@fake.com',
			'password'		=> Hash::make('secret'),
			'is_admin'		=> false,
			'is_reviewer'	=> true
		]);

		$faker = Faker::create();

		foreach(range(1, 10) as $index)
		{
			User::create([
				'username'		=> $faker->name,
				'email'			=> $faker->email,
				'password'		=> Hash::make('secret'),
				'is_admin'		=> false,
				'is_reviewer'	=> false
			]);
		}
	}

}