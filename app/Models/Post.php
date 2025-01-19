<?php

namespace App\Models;

/**
 * @property string $content
 */
class Post extends StatamicModel
{
    public function summary(): string
    {
        $summary = substr($this->content, 0, strpos($this->content, '<h2') ?: 0);
        $summary = preg_replace('/<a(\s|>)[^>]*>(.*?)<\/a>/', '$2', $summary) ?: '';
        $summary = preg_replace('/<img[^>]*>/', '', $summary) ?: '';

        return $summary;
    }

    public function duration(): int
    {
        $words = str_word_count(strip_tags($this->content));

        return intval(round($words / 200));
    }

    /**
     * @return array<Landmark>
     */
    public function landmarks(): array
    {
        return parse_landmarks($this->content);
    }
}
