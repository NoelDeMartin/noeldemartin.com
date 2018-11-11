<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskComment;
use App\Http\Requests\TaskCommentRequest;

class TaskCommentsController extends Controller
{
    public function store(Task $task, TaskCommentRequest $request)
    {
        $task->comments()->create([
            'text_html'     => request('text_html'),
            'text_markdown' => request('text_markdown'),
        ]);

        return redirect()->route('tasks.show', $task->slug);
    }
}
