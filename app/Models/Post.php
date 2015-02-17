<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Post extends Model {

	const DATE_FORMAT = 'd/m/Y';
	const DATE_FORMAT_JS = 'dd/mm/yyyy';

	public static $rules = [
		'title'			=> 'required',
		'text_markdown'	=> 'required',
		'text_html'		=> 'required',
		'published_at'	=> 'required|date_format:d/m/Y'
	];

	protected $fillable = ['title', 'text_markdown', 'text_html'];

	public function getSummary() {
		return substr($this->text_html, 0, strpos($this->text_html, '<h2'));
	}

	public static function createTitleTag($title) {
		$special_chars = [' ', '/', '!', '?', '.', ',', ';', '#', '$', '&', '(', ')'];
		return urlencode(strtolower(preg_replace('/-+/', '-', str_replace($special_chars, '-', $title))));
	}

	public function comments() {
		return $this->hasMany('App\Model\PostComment');
	}

	public function isPublished() {
		$date = new \Carbon\Carbon($this->published_at);
		return $date->isPast();
	}

	public function getPublishedAtAttribute($date) {
		return new \Carbon\Carbon($date);
	}

}