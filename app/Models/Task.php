<?php

namespace App\Models;

use Carbon\Carbon;
use Statamic\Entries\EntryCollection;
use Statamic\Facades\Entry;

/**
 * @property Carbon $publication_date
 * @property Carbon $completion_date
 */
class Task extends StatamicModel
{
    /**
     * @return EntryCollection<Comment>
     */
    public function comments(): EntryCollection
    {
        if (is_null($this->id())) {
            return new EntryCollection();
        }

        $comments = Entry::query()->where('collection', 'comments')->where('task', 'entry::' . $this->id())->get();

        $comments->push(Entry::make()->collection('comments')->id('entry::' . $this->id() . '-started')->data([
            'publication_date' => $this->publication_date->copy()->subSeconds(1),
            'content' => '<p class="flex items-center md:m-0">' .
                'Task started ' .
                antlers_icon('task-started', 'size-4 ml-2') .
            '</p>',
        ]));

        if (! is_null($this->completion_date)) {
            $comments->push(Entry::make()->collection('comments')->id('entry::' . $this->id() . '-completed')->data([
                'publication_date' => $this->completion_date,
                'content' => '<p class="flex items-center md:m-0">' .
                    'Task completed ' .
                    antlers_icon('task-completed', 'size-4 ml-2') .
                '</p>',
            ]));
        }

        return $comments->sortBy('publication_date')->values();
    }

    /**
     * @return array<Landmark>
     */
    public function landmarks(): array
    {
        if (is_null($this->id())) {
            return [];
        }

        $startDate = $this->publication_date->copy()->subSeconds(1);

        return collect($this->comments())
            ->values()
            ->map(function ($comment, $index) use ($startDate) {
                $title = $comment->publication_date->display('datetime-short');

                if ($comment->publication_date->eq($startDate)) {
                    $icon = antlers_icon('task-started', 'size-4 mr-2');
                } elseif (! is_null($this->completion_date) && $comment->publication_date->eq($this->completion_date)) {
                    $icon = antlers_icon('task-completed', 'size-4 mr-2');
                } elseif (! is_null($this->completion_date) && $comment->publication_date->gt($this->completion_date)) {
                    $icon = antlers_icon('checkmark', 'size-4 mr-2 text-jade-darker fill-current');
                } else {
                    $icon = antlers_icon('timer', 'size-4 mr-2 text-blue-darker fill-current');
                }

                return (object) [
                    'level' => 2,
                    'title' => "<div class=\"flex font-mono\">{$icon} <span>{$title}</span></div>",
                    'anchor' => '#comment-' . ($index + 1),
                ];
            })
            ->toArray();
    }
}
