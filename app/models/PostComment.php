<?php

class PostComment extends Eloquent {

	public static $rules = [
		'author'		=> 'max:64',
		'text'			=> 'required|max:2048'
	];

	protected $fillable = ['author', 'author_link', 'text'];
}