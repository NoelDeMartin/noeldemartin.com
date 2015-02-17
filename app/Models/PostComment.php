<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PostComment extends Model {

	public static $rules = [
		'author'		=> 'max:64',
		'author_link'	=> 'email_or_url',
		'text'			=> 'required|max:2048'
	];

	protected $fillable = ['author', 'author_link', 'text'];
}