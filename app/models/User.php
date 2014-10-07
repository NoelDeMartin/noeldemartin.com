<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	const NO_ROLES = 0;

	const ADMIN = 1;
	const MODERATOR = 2;
	const REVIEWER = 4;

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	public function getRolesArray() {
		$roles = [];
		if (($this->roles & static::ADMIN) != 0) {
			$roles[] = 'Admin';
		}
		if (($this->roles & static::MODERATOR) != 0) {
			$roles[] = 'Moderator';
		}
		if (($this->roles & static::REVIEWER) != 0) {
			$roles[] = 'Reviewer';
		}
		return $roles;
	}

}
