<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model {

	protected $fillable = ['email'];

	public static $rules = [
		'email' => 'required|email|unique:invitations'
	];

}