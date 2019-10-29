<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\SemanticSEO\ItemList;
use App\SemanticSEO\Task as TaskSEO;
use NoelDeMartin\SemanticSEO\Support\Facades\SemanticSEO;

class TasksController extends Controller
{
    public function index()
    {
        $tasks = Task::orderBy('created_at', 'desc')->get();

        SemanticSEO::meta(trans('seo.tasks'));

        SemanticSEO::is(ItemList::class)
            ->setAttributes(trans('seo.schema:tasks'))
            ->url(route('tasks.index'))
            ->items($tasks->map(function ($task) {
                return new TaskSEO($task);
            })->all())
            ->numberOfItems($tasks->count())
            ->image(Logo::class);

        return view('tasks.index', compact('tasks'));
    }

    public function show($slug)
    {
        $task = Task::with('comments')->findBySlug($slug);

        if (is_null($task)) {
            abort(404);
        }

        SemanticSEO::is(new TaskSEO($task));

        return view('tasks.show', compact('task'));
    }
}
