<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskComment extends Model
{
    protected $fillable = ['text_html', 'text_markdown'];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
