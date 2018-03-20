<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    const DATE_FORMAT = 'd/m/Y';
    const DATE_FORMAT_JS = 'dd/mm/yyyy';

    public static $rules = [
        'title'         => 'required',
        'text_markdown' => 'required',
        'text_html'     => 'required',
        'published_at'  => 'required|date_format:d/m/Y',
    ];

    protected $dates = ['created_at', 'updated_at', 'published_at'];

    protected $fillable = ['title', 'tag', 'text_markdown', 'text_html', 'author_id', 'published_at'];

    public static function createTitleTag($title)
    {
        $special_chars = [' ', '/', '!', '?', '.', ',', ';', '#', '$', '&', '(', ')', ':'];

        return urlencode(strtolower(preg_replace('/-+/', '-', str_replace($special_chars, '-', $title))));
    }

    public function comments()
    {
        return $this->hasMany(PostComment::class);
    }

    public function isPublished()
    {
        return $this->published_at->isPast();
    }

    public function getSummaryAttribute()
    {
        $summary = substr($this->text_html, 0, strpos($this->text_html, '<h2'));

        return preg_replace('/<a(\s|>)[^>]*>(.*?)<\/a>/', '$2', $summary);
    }

    public function getDurationAttribute()
    {
        return round(str_word_count(strip_tags($this->text_html)) / 200);
    }
}
