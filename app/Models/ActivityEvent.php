<?php

namespace App\Models;

use Illuminate\Support\Carbon;

class ActivityEvent
{
    public static function fromTasks($tasks)
    {
        return collect($tasks)
            ->map(function ($task) {
                $events = [
                    new static(
                        $task->created_at,
                        trans('app.events.task_started', [
                            'url' => $task->url,
                            'task' => $task->name,
                        ])
                    ),
                ];

                if ($task->isCompleted()) {
                    $events[] = new static($task->completed_at, trans('app.events.task_completed', [
                        'url' => $task->url,
                        'task' => $task->name,
                    ]));
                }

                return $events;
            })
            ->reduce(function ($accumulator, $events) {
                return array_merge($accumulator, $events);
            }, []);
    }

    public static function fromTaskComments($comments)
    {
        return collect($comments)
            ->map(function ($comment) {
                return new static(
                    $comment->created_at,
                    trans('app.events.comment_posted', [
                        'url' => $comment->task->url,
                        'task' => $comment->task->name,
                    ])
                );
            });
    }

    public static function fromPosts($posts)
    {
        return collect($posts)
            ->filter->isPublished()
            ->map(function ($post) {
                return new static($post->published_at, trans('app.events.post_published', [
                    'url' => route('posts.show', $post->tag),
                    'post' => $post->title,
                ]));
            });
    }

    public $date;
    public $description;

    private function __construct(Carbon $date, $description)
    {
        $this->date = $date;
        $this->description = $description;
    }
}
