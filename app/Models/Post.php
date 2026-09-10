<?php

namespace App\Models;

/**
 * @property string $content
 *
 * @method string|null id()
 */
class Post extends StatamicModel
{
    public function summary(): string
    {
        $summary = substr($this->content, 0, strpos($this->content, '<h2') ?: 0);
        $summary = preg_replace('/\{\{.*?\}\}/s', '', $summary) ?: '';
        $summary = preg_replace('/<a(\s|>)[^>]*>(.*?)<\/a>/', '$2', $summary) ?: '';
        $summary = preg_replace('/<img[^>]*>/', '', $summary) ?: '';

        return $summary;
    }

    public function summaryText(): string
    {
        $decoded = html_entity_decode($this->summary(), ENT_QUOTES | ENT_HTML5, 'UTF-8');

        return preg_replace('/\s+/', ' ', trim(strip_tags($decoded))) ?? '';
    }

    public function words(): int
    {
        return str_word_count(strip_tags($this->content));
    }

    public function duration(): int
    {
        return intval(round($this->words() / 200));
    }

    public function imageUrl(): ?string
    {
        preg_match('/<img[^>]*src="([^"]*)"/', $this->content, $matches);

        return count($matches) > 1 ? url($matches[1]) : null;
    }

    /**
     * @return array<Landmark>
     */
    public function landmarks(): array
    {
        if (is_null($this->id())) {
            return [];
        }

        return parse_landmarks($this->content);
    }
}
