<?php

namespace App\Models;

use Illuminate\Support\Carbon;

class ActivityEvent
{
    public Carbon $date;
    public string $title;
    public string $description;
    public string $longDescription;
    public string $url;

    public function __construct(Carbon $date, string $title, string $description, string $longDescription, string $url)
    {
        $this->date = $date;
        $this->title = $title;
        $this->description = $description;
        $this->longDescription = $longDescription;
        $this->url = $url;
    }
}
