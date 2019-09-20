<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Laravel\Nova\Actions\Actionable;

class TaskComment extends Model
{
    use Actionable;

    protected $fillable = ['text_html', 'text_markdown'];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function getUrlAttribute()
    {
        if (is_null($this->task))
            return null;

        $index = $this->task->comments->search(function ($comment) {
            return $comment->id === $this->id;
        });

        // Comments are indexed starting at 1 and there is an auto-generated first comment
        $index += 2;

        return route('tasks.show', $this->task->slug) . '#comment-' . $index;
    }
}
