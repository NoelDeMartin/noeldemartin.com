<?php

namespace App\SemanticSEO;

use App\Models\Task as TaskModel;

class Task extends Action
{
    public function __construct(TaskModel $task)
    {
        parent::__construct();

        $this->name($task->name);
        $this->description($task->summary);
        $this->image(Logo::class);
        $this->url($task->url);
        $this->agent(NoelDeMartin::class);
        $this->startTime($task->created_at);

        if ($task->isCompleted()) {
            $this->actionStatus(ActionStatusType::COMPLETED);
            $this->endTime($task->completed_at);
        } else {
            $this->actionStatus(ActionStatusType::ACTIVE);
        }
    }

    protected function getType()
    {
        return 'Action';
    }
}
