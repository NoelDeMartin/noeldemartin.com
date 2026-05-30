<?php

namespace App\Models;

/**
 * @property string $content
 *
 * @method string|null id()
 */
class Page extends StatamicModel
{
    /**
     * @return array<Landmark>
     */
    public function landmarks(): array
    {
        if (is_null($this->id()) || is_null($this->content)) {
            return [];
        }

        return parse_landmarks($this->content);
    }
}
