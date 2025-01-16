<?php

namespace App\Support\Facades;

use App\Models\ActivityEvent;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Facade;

/**
 * @method static Collection<string, ActivityEvent> events();
 * @method static Carbon lastModificationDate();
 *
 * @see \App\Services\ActivityService
 */
class Activity extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'activity';
    }
}
