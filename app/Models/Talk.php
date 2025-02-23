<?php

namespace App\Models;

class Talk extends StatamicModel
{
    public function imageUrl(): ?string
    {
        if (is_null($this->id())) {
            return null;
        }

        $slug = preg_replace('/\\-talk$/', '', $this->id());

        return "/img/talks/{$slug}.png";
    }

    public function slidesUrl(): ?string
    {
        if (is_null($this->id())) {
            return null;
        }

        $slug = preg_replace('/\\-talk$/', '', $this->id());

        return "/slides/{$slug}";
    }
}
