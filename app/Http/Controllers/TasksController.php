<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Http\Requests\TaskRequest;
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

    public function store(TaskRequest $request)
    {
        $name = request('name');
        $count = 0;

        do {
            $slug = Str::slug($name).($count > 0 ? '-'.$count : '');
            $count++;
        } while (Task::where('slug', $slug)->count() > 0);

        Task::create([
            'slug'                 => $slug,
            'name'                 => $name,
            'description_html'     => request('description_html'),
            'description_markdown' => request('description_markdown'),
        ]);

        return redirect()->route('tasks.index');
    }

    public function complete(Task $task)
    {
        if ($task->isOngoing()) {
            $task->update(['completed_at' => now()]);
        }

        return redirect()->route('tasks.show', $task->slug);
    }
}
