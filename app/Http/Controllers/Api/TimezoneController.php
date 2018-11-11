<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class TimezoneController extends Controller
{
    public function store()
    {
        session()->put('timezone', [
            'offset' => request('offset'),
        ]);
    }
}
