<?php

class Post extends Eloquent {

	const DATE_FORMAT = 'd/m/Y';
	const DATE_FORMAT_JS = 'dd/mm/yyyy';

	public static $rules = [
		'title'			=> 'required',
		'text_markdown'	=> 'required',
		'text_html'		=> 'required',
		'published_at'	=> 'required|date_format:d/m/Y'
	];

	protected $fillable = ['title', 'text_markdown', 'text_html'];

	public static function createTitleTag($title) {
		return strtolower(str_replace(' ', '-', $title));
	}

	public function comments() {
		return $this->hasMany('PostComment');
	}

	public function isPublished() {
		$date = new \Carbon\Carbon($this->published_at);
		return $date->isPast();
	}

	public function getPublishedAtAttribute($date) {
		return new \Carbon\Carbon($date);
	}

}