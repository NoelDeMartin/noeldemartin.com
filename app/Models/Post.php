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

    private $_landmarks = null;

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

    public function getLandmarksAttribute()
    {
        if (is_null($this->_landmarks)) {
            $headers = $this->parseHtmlHeaders($this->text_html);
            $currentLandmark = (object) [
                'level' => 1,
                'children' => [],
            ];

            foreach ($headers as $header) {
                $currentLandmark = $currentLandmark->level >= $header->level
                    ? $this->createAncestorLandmark($currentLandmark, $header)
                    : $this->createDescendantLandmark($currentLandmark, $header);
            }

            $this->_landmarks = $this->cleanLandmarkTree($currentLandmark)->children ?? [];
        }

        return $this->_landmarks;
    }

    /** @return object[] */
    private function parseHtmlHeaders($html) {
        preg_match_all('/<h(\d) id="([^"]+)"[^>]*>(.+?)<\/h\d>/', $html, $matches);

        return array_map(
            function ($_, $level, $anchor, $title) {
                return (object) [
                    'title' => $title,
                    'anchor' => "#$anchor",
                    'level' => intval($level),
                ];
            },
            ...$matches
        );
    }

    private function createAncestorLandmark($previousLandmark, $header) {
        while ($previousLandmark->level !== $header->level) {
            $previousLandmark = $previousLandmark->parent;
        }

        $landmark = (object) [
            'level' => $header->level,
            'title' => $header->title,
            'anchor' => $header->anchor,
            'parent' => $previousLandmark->parent,
            'children' => [],
        ];

        return tap($landmark, function ($landmark) use ($previousLandmark) {
            $previousLandmark->parent->children[] = $landmark;
        });
    }

    private function createDescendantLandmark($previousLandmark, $header) {
        while ($previousLandmark->level !== $header->level - 1) {
            $childLandmark = (object) [
                'level' => $previousLandmark->level + 1,
                'parent' => $previousLandmark,
                'children' => [],
            ];

            $previousLandmark->children[] = $childLandmark;
            $previousLandmark = $childLandmark;
        }

        $landmark = (object) [
            'level' => $header->level,
            'title' => $header->title,
            'anchor' => $header->anchor,
            'parent' => $previousLandmark,
            'children' => [],
        ];

        return tap($landmark, function ($landmark) use ($previousLandmark) {
            $previousLandmark->children[] = $landmark;
        });
    }

    private function cleanLandmarkTree($landmark) {
        while ($landmark->level !== 1) {
            $landmark = $landmark->parent;
        }

        $this->cleanLandmark($landmark);

        return $landmark;
    }

    private function cleanLandmark(&$landmark) {
        unset($landmark->parent);

        if (empty($landmark->children))
            unset($landmark->children);
        else
            array_map([$this, 'cleanLandmark'], $landmark->children);
    }
}
