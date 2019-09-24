<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;

class CompleteTask extends Action
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $tasks
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $tasks)
    {
        foreach ($tasks as $task) {
            if ($task->isCompleted()) {
                $this->markAsFailed($task);

                continue;
            }

            $task->update(['completed_at' => now()]);

            $this->markAsFinished($task);
        }
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [];
    }
}
