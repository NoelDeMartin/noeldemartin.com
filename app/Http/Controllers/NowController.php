<?php

namespace App\Http\Controllers;

use App\Support\Facades\Activity;
use Illuminate\Http\Response;

class NowController extends Controller
{
    public function feed(): Response
    {
        $events = Activity::events();

        return response()
            ->view('now.rss', ['events' => $events])
            ->header('Content-Type', 'application/xml');
    }

    public function styles(): Response
    {
        return response()
            ->view('now.styles')
            ->header('Content-Type', 'text/xml');
    }
}
