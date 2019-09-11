<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Task extends Model
{
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

    public function newQuery()
    {
        $builder = parent::newQuery();

        $builder->macro('findBySlug', function (Builder $builder, $slug, $columns = ['*']) {
            return $builder->where('slug', $slug)->first($columns);
        });

        return $builder;
    }
}
