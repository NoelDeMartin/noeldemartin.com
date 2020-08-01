<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

use Laravel\Nova\Actions\Actionable;

class Task extends Model
{
    use Actionable;

    public static function newSlug($name)
    {
        $count = 0;

        do {
            $slug = Str::slug($name).($count > 0 ? '-'.$count : '');
            $count++;
        } while (Task::where('slug', $slug)->count() > 0);

        return $slug;
    }

    protected $dates = ['created_at', 'updated_at', 'completed_at'];

    protected $fillable = [
        'name', 'slug', 'description_markdown', 'description_html', 'completed_at',
    ];

    public function comments()
    {
        return $this->hasMany(TaskComment::class);
    }

    public function isCompleted()
    {
        return ! is_null($this->completed_at);
    }

    public function isOngoing()
    {
        return ! $this->isCompleted();
    }

    public function getUrlAttribute()
    {
        return route('tasks.show', $this->slug);
    }

    public function getSummaryAttribute()
    {
        return Str::limit(strip_tags($this->description_html));
    }

    public function getModifiedAtAttribute()
    {
        $dates = [$this->created_at];

        if ($this->isCompleted()) {
            $dates[] = $this->completed_at;
        }

        // TODO optimize this! you don't need all the comments just to get the last
        // (used for generating sitemap.xml)
        if ($this->comments->count() > 0) {
            $dates[] = $this->comments->last()->created_at;
        }

        return max($dates);
    }

    public function getDisplayCommentsAttribute()
    {
        $comments = $this->comments->slice(0);

        TaskComment::unguarded(function () use ($comments) {
            $comments->push(new TaskComment([
                'created_at' => $this->created_at->copy()->subMillis(1),
                'text_html' =>
                    '<p class="flex items-center md:m-0">' .
                        'Task started ' .
                        blade_icon('task-started', 'w-4 h-4 ml-2') .
                    '</p>',
            ]));

            if ($this->isCompleted()) {
                $comments->push(new TaskComment([
                    'created_at' => $this->completed_at,
                    'text_html' =>
                        '<p class="flex items-center md:m-0">' .
                            'Task completed ' .
                            blade_icon('task-completed', 'w-4 h-4 ml-2') .
                        '</p>',
                ]));
            }
        });

        return $comments->sortBy->created_at;
    }

    public function getCommentsBeforeClosingAttribute()
    {
        if (!$this->isCompleted())
            return $this->comments->slice(0);

        return $this->comments->filter(function ($comment) {
            return $comment->created_at < $this->completed_at;
        });
    }

    public function newQuery()
    {
        $builder = parent::newQuery();

        $builder->macro('findBySlug', function (Builder $builder, $slug, $columns = ['*']) {
            return $builder->where('slug', $slug)->first($columns);
        });

        return $builder;
    }
}
