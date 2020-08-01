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
                            'task' => "\"{$task->name}\"",
                        ]),
                        trans('app.events.task_started', [
                            'task' => "<a href=\"{$task->url}\">{$task->name}</a>",
                        ]),
                        trans('app.events.task_started_long', [
                            'task' => "<a href=\"{$task->url}\">{$task->name}</a>",
                            'description' => $task->description_html,
                        ]),
                        $task->url
                    ),
                ];

                if ($task->isCompleted()) {
                    $url = $task->url . '#comment-' . ($task->comments_before_closing->count() + 2);

                    $events[] = new static(
                        $task->completed_at,
                        trans('app.events.task_completed', [
                            'task' => "\"{$task->name}\"",
                        ]),
                        trans('app.events.task_completed', [
                            'task' => "<a href=\"{$url}\">{$task->name}</a>",
                        ]),
                        trans('app.events.task_completed_long', [
                            'task' => "<a href=\"{$url}\">{$task->name}</a>",
                        ]),
                        $url
                    );
                }

                return $events;
            })
            ->reduce(function ($accumulator, $events) {
                return array_merge($accumulator, $events);
            }, []);
    }

    public static function fromTaskComments($comments)
    {
        $indexes = static::calculateCommentsTaskIndexes($comments);

        return collect($comments)
            ->map(function ($comment) use (&$indexes) {
                $task = $comment->task;
                $url = $task->url . '#comment-' . ($indexes[$comment->id] + 2);

                return new static(
                    $comment->created_at,
                    trans('app.events.comment_posted', [
                        'task' => "\"{$task->name}\"",
                    ]),
                    trans('app.events.comment_posted', [
                        'task' => "<a href=\"{$url}\">{$task->name}</a>",
                    ]),
                    trans('app.events.comment_posted_long', [
                        'task' => "<a href=\"{$url}\">{$task->name}</a>",
                        'comment' => $comment->text_html,
                    ]),
                    $url
                );
            });
    }

    public static function fromPosts($posts)
    {
        return collect($posts)
            ->filter->isPublished()
            ->map(function ($post) {
                $url =  route('posts.show', $post->tag);

                return new static(
                    $post->published_at,
                    trans('app.events.post_published', [
                        'post' => "\"{$post->title}\"",
                    ]),
                    trans('app.events.post_published', [
                        'post' => "<a href=\"{$url}\">{$post->title}</a>",
                    ]),
                    trans('app.events.post_published_long', [
                        'post' => "<a href=\"{$url}\">{$post->title}</a>",
                    ]),
                    $url
                );
            });
    }

    private static function calculateCommentsTaskIndexes($comments) {
        $taskCommentIndexes = [];

        collect($comments)
            ->sortBy('created_at')
            ->each(function ($comment) use (&$taskCommentIndexes) {
                $taskId = $comment->task->id;

                if (!array_key_exists($taskId, $taskCommentIndexes)) {
                    $taskCommentIndexes[$taskId] = [];
                }

                $taskCommentIndexes[$taskId][$comment->id] = count($taskCommentIndexes[$taskId]);

                if ($comment->task->isCompleted() && $comment->task->completed_at < $comment->created_at) {
                    $taskCommentIndexes[$taskId][$comment->id]++;
                }
            });

        return array_reduce($taskCommentIndexes, function ($indexes, $comments) {
            foreach ($comments as $commentId => $index) {
                $indexes[$commentId] = $index;
            }

            return $indexes;
        }, []);
    }

    public $date;

    public $title;

    public $description;

    public $longDescription;

    public $url;

    private function __construct(Carbon $date, $title, $description, $longDescription, $url)
    {
        $this->date = $date;
        $this->title = $title;
        $this->description = $description;
        $this->longDescription = $longDescription;
        $this->url = $url;
    }
}
