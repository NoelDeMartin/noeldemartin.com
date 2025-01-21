<?php

namespace App\SemanticSEO;

use Illuminate\Support\Str;
use Statamic\Entries\Entry;

class Task extends Action
{
    public function __construct(Entry $task)
    {
        parent::__construct();

        $this->name($task->value('title'));
        $this->description(Str::limit(trim(strip_tags($task->content))));
        $this->image(Logo::class);
        $this->url($task->url());
        $this->agent(NoelDeMartin::class);
        $this->startTime($task->publication_date);

        if (! is_null($task->value('completion_date'))) {
            $this->actionStatus(ActionStatusType::COMPLETED);
            $this->endTime($task->completion_date);
        } else {
            $this->actionStatus(ActionStatusType::ACTIVE);
        }
    }

    protected function getType(): string
    {
        return 'Action';
    }
}
