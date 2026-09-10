<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\SupportsMarkdown;
use App\Models\Task;
use Illuminate\Support\Carbon;
use Statamic\Entries\Entry;
use Statamic\Facades\Entry as Entries;
use Symfony\Component\HttpFoundation\Response;

class TasksController extends Controller
{
    use SupportsMarkdown;

    public function show(string $slug): Response
    {
        [$slug, $isMarkdown] = $this->parseSlug($slug);

        /** @var Entry|null $task */
        $task = Entries::whereCollection('tasks')->firstWhere('slug', $slug);

        if (is_null($task)) {
            abort(404);
        }

        $markdownUrl = url("/tasks/{$slug}.md");

        if ($isMarkdown || $this->prefersMarkdown()) {
            return $this->markdownResponse(
                $this->buildTaskFrontmatter($task),
                $this->buildTaskMarkdownBody($task),
                url("/tasks/{$slug}"),
            );
        }

        $this->advertiseMarkdown($markdownUrl);

        /** @var Response $response */
        $response = $task->toResponse(request());

        return $this->withMarkdownHeaders($response, $markdownUrl);
    }

    /**
     * @return array<string, mixed>
     */
    protected function buildTaskFrontmatter(Entry $task): array
    {
        $frontmatter = [
            'title' => $task->value('title'),
        ];

        if ($task->publication_date instanceof Carbon) {
            $frontmatter['date'] = $task->publication_date->toIso8601String();
        }

        if ($task->completion_date instanceof Carbon) {
            $frontmatter['completed'] = $task->completion_date->toIso8601String();
        }

        return $frontmatter;
    }

    protected function buildTaskMarkdownBody(Entry $task): string
    {
        $body = $this->markdownBodyFromEntry($task);
        $comments = new Task($task)->comments();

        if ($comments->isEmpty()) {
            return $body;
        }

        $activity = [];

        foreach ($comments as $comment) {
            $publicationDate = $comment->publication_date;
            $date = $publicationDate instanceof Carbon
                ? $publicationDate->toDateTimeString()
                : (is_string($publicationDate) ? $publicationDate : '');

            $activity[] = "### {$date}\n\n{$this->buildTaskCommentBody($comment)}";
        }

        return $body . "\n\n## Activity\n\n" . implode("\n\n", $activity);
    }

    protected function buildTaskCommentBody(Entry $comment): string
    {
        $id = is_string($comment->id()) ? $comment->id() : '';

        if (str_ends_with($id, '-started')) {
            return 'Task started';
        }

        if (str_ends_with($id, '-completed')) {
            return 'Task completed';
        }

        return $this->markdownBodyFromEntry($comment);
    }
}
