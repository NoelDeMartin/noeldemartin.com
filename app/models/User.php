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

	protected $fillable = array('username', 'email');

	protected $guarded = array('id', 'password', 'roles');

	public static $rules = [
		'username'			=> 'required|min:3|max:16|unique:users',
		'email' 			=> 'required|email|unique:users',
		'password'			=> 'required|min:6|max:50',
		'confirm_password'	=> 'same:password'
	];

	public function isAdmin() {
		return ($this->roles & static::ADMIN) != 0;
	}

	public function isModerator() {
		return ($this->roles & static::MODERATOR) != 0;
	}

	public function isReviewer() {
		return ($this->roles & static::REVIEWER) != 0;
	}

	public function getRolesArray() {
		$roles = [];
		if ($this->isAdmin()) {
			$roles[] = 'Admin';
		}
		if ($this->isModerator()) {
			$roles[] = 'Moderator';
		}
		if ($this->isReviewer()) {
			$roles[] = 'Reviewer';
		}
		return $roles;
	}

}
