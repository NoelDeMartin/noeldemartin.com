<?php

namespace App\Services;

use App\Models\ActivityEvent;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Statamic\Entries\Entry;
use Statamic\Facades\Entry as Entries;

class ActivityService
{
    /**
     * @return Collection<string, ActivityEvent>
     */
    public function events(): Collection
    {
        $lastModificationDate = $this->lastModificationDate();

        return Cache::remember(
            'events_' . $lastModificationDate->timestamp,
            86400, // 24 hours
            fn (): Collection => $this->getEvents(),
        );
    }

    public function lastModificationDate(): Carbon
    {
        return collect([
            Entries::whereCollection('tasks')->sortByDesc('completion_date')->first()->completion_date,
            Entries::whereCollection('tasks')->sortByDesc('publication_date')->first()->publication_date,
            Entries::whereCollection('comments')->sortByDesc('publication_date')->first()->publication_date,
            Entries::whereCollection('posts')->sortByDesc('publication_date')->first()->publication_date,
        ])
            ->sort()
            ->last();
    }

    /**
     * @return Collection<string,ActivityEvent>
     */
    private function getEvents(): Collection
    {
        $entries = collect(Entries::whereInCollection(['tasks', 'comments', 'posts'])->all());

        $this->fillRelations($entries);

        return $entries
            ->flatMap(fn ($entry): mixed => call_user_func([$this, 'createEventsFrom' . Str::studly($entry->value('blueprint'))], $entry))
            ->sortByDesc->date;
    }

    private function fillRelations(Collection $entries): void
    {
        $comments = $entries->where('blueprint', 'comment');

        foreach ($entries->where('blueprint', 'task') as $task) {
            $taskLink = 'entry::' . $task->id;
            $taskComments = $comments
                ->filter(fn ($comment): bool => $comment->value('task') === $taskLink)
                ->sortBy->publication_date
                ->values();

            foreach ($taskComments as $index => $comment) {
                $comment->position = $index + 2;
            }

            $task->totalComments = $taskComments->count();
        }
    }

    /**
     * @return array<ActivityEvent>
     */
    private function createEventsFromTask(Entry $task): array
    {
        $url = url($task->url);

        $events = [new ActivityEvent(
            date: $task->publication_date,
            title: "Started \"{$task->title}\"",
            description: "Started <a href=\"{$url}\">{$task->title}</a>",
            longDescription: "<p>I just started a new task: <a href=\"{$url}\">{$task->title}</a></p>{$task->content}",
            url: $url,
        )];

        if ($task->completion_date) {
            $url .= '#comment-' . $task->totalComments + 2;

            $events[] = new ActivityEvent(
                date: $task->completion_date,
                title: "Completed \"{$task->title}\"",
                description: "Completed <a href=\"{$url}\">{$task->title}</a>",
                longDescription: "<p>I just completed the task <a href=\"{$url}\">{$task->title}</a>.</p>",
                url: $url,
            );
        }

        return $events;
    }

    /**
     * @return array<ActivityEvent>
     */
    private function createEventsFromComment(Entry $comment): array
    {
        $task = $comment->task->value();
        $url = url($task->url) . '#comment-' . $comment->position;

        return [new ActivityEvent(
            date: $comment->publication_date,
            title: "Commented on \"{$task->title}\"",
            description: "Commented on <a href=\"{$url}\">{$task->title}</a>",
            longDescription: $comment->content,
            url: $url
        )];
    }

    /**
     * @return array<ActivityEvent>
     */
    private function createEventsFromPost(Entry $post): array
    {
        $url = url($post->url);

        return [new ActivityEvent(
            date: $post->publication_date,
            title: "Published \"{$post->title}\"",
            description: "Published <a href=\"{$url}\">{$post->title}</a>",
            longDescription: "<p>I just published a new blog post: <a href=\"{$url}\">{$post->title}</a></p>",
            url: $url
        )];
    }
}
