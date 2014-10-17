<?php

class Invitation extends Eloquent {

	protected $fillable = ['email'];

	public static $rules = [
		'email' => 'required|email|unique:invitations'
	];

}