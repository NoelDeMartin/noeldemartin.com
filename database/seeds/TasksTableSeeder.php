<?php

use App\Models\Task;
use App\Models\TaskComment;
use Illuminate\Database\Seeder;

class TasksTableSeeder extends Seeder
{
    public function run()
    {
        factory(Task::class, random_int(5, 10))
            ->create()
            ->each(function ($task) {
                factory(TaskComment::class, random_int(5, 10))
                    ->create([
                        'task_id' => $task->id,
                    ]);
            });
    }
}
