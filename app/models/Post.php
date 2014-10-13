<?php

class Post extends Eloquent {

	const DATE_FORMAT = 'd/m/Y';

	public static $rules = [
		'title'			=> 'required',
		'text_markdown'	=> 'required',
		'text_html'		=> 'required',
		'published_at'	=> 'required|date_format:' . Post::DATE_FORMAT
	];

	protected $fillable = ['title', 'text_markdown', 'text_html'];

	public static function createTitleTag($title) {
		return strtolower(str_replace(' ', '-', $title));
	}

	public function isPublic() {
		$date = new \Carbon\Carbon($this->published_at);
		return $date->isPast();
	}

	public function getPublishedAtAttribute($date) {
		return new \Carbon\Carbon($date);
	}

}