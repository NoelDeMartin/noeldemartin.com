<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

use Laravel\Nova\Actions\Actionable;

class Post extends Model
{
    use Actionable;

    const DATE_FORMAT = 'd/m/Y';

    const DATE_FORMAT_JS = 'dd/mm/yyyy';

    protected $dates = ['created_at', 'updated_at', 'published_at'];

    protected $fillable = ['title', 'tag', 'text_markdown', 'text_html', 'author_id', 'published_at'];

    public static function createTitleTag($title)
    {
        $count = 0;

        do {
            $tag = Str::slug($title).($count > 0 ? '-'.$count : '');
            $count++;
        } while (Post::where('tag', $tag)->count() > 0);

        return $tag;
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
        return strip_tags($this->summary_html);
    }

    public function getSummaryHtmlAttribute()
    {
        $summary = substr($this->text_html, 0, strpos($this->text_html, '<h2'));

        $summary = preg_replace('/<a(\s|>)[^>]*>(.*?)<\/a>/', '$2', $summary);
        $summary = preg_replace('/<img[^>]*>/', '', $summary);

        return $summary;
    }

    public function getUrlAttribute()
    {
        return route('posts.show', $this->tag);
    }

    public function getImageUrlAttribute()
    {
        preg_match('/<img[^>]*src="([^"]*)"/', $this->text_html, $matches);

        return count($matches) > 1 ? url($matches[1]) : null;
    }

    public function getWordCountAttribute()
    {
        return str_word_count(strip_tags($this->text_html));
    }

    public function getDurationAttribute()
    {
        return round($this->word_count / 200);
    }

    public function getModifiedAtAttribute()
    {
        return $this->updated_at > $this->published_at ? $this->updated_at : $this->published_at;
    }
}
