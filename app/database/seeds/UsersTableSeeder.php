<?php

class UsersTableSeeder extends Seeder {

	public function run()
	{
		foreach(range(1, 10) as $index)
		{
			User::create([
				'username'	=> 'User' . $index,
				'email'		=> 'user' . $index . '@fakemail.com',
				'password'	=> Hash::make('secret'),
				'roles'		=> User::ADMIN
			]);
		}
	}

}