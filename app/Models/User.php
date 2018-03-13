<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

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

	protected $guarded = array('id', 'password', 'is_admin', 'is_reviewer');

	public static $rules = [
		'username'			=> 'required|min:3|max:16|unique:users',
		'email' 			=> 'required|email|unique:users',
		'password'			=> 'required|min:6|max:50',
		'confirm_password'	=> 'same:password'
	];

	public function getRolesArray() {
		$roles = [];
		if ($this->is_admin) {
			$roles[] = 'Admin';
		}
		if ($this->is_reviewer) {
			$roles[] = 'Reviewer';
		}
		return $roles;
	}

}
