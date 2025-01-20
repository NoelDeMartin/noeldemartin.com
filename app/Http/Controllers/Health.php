<?php

namespace App\Http\Controllers;

use Statamic\Facades\Entry;
use Throwable;

class Health extends Controller
{
    public function __invoke(): string
    {
        $status = 'Everything is OK';

        try {
            if (is_null(Entry::find('home'))) {
                $status = 'Statamic is not working correctly';
            }
        } catch (Throwable) {
            $status = 'Statamic is not working correctly';
        }

        return $status;
    }
}
