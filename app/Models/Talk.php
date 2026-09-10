<?php

namespace App\Models;

use DateTimeInterface;

class Talk extends StatamicModel
{
    public function talkSlug(): ?string
    {
        if (is_null($this->id())) {
            return null;
        }

        return preg_replace('/\\-talk$/', '', $this->id());
    }

    public function imageUrl(): ?string
    {
        $slug = $this->talkSlug();

        if (is_null($slug)) {
            return null;
        }

        return "/img/talks/{$slug}.png";
    }

    public function slidesUrl(): ?string
    {
        $slug = $this->talkSlug();

        if (is_null($slug)) {
            return null;
        }

        return "/slides/{$slug}";
    }

    public function markdownUrl(): ?string
    {
        $slug = $this->talkSlug();

        if (is_null($slug)) {
            return null;
        }

        return "/talks/{$slug}.md";
    }

    public function details(): string
    {
        $year = $this->presentation_date instanceof DateTimeInterface
            ? $this->presentation_date->format('Y')
            : null;

        return collect([$this->value('conference'), $this->value('location'), $year])
            ->filter()
            ->implode(', ');
    }
}
