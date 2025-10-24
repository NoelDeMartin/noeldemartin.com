<?php

namespace App\Http\Controllers;

use App\Support\Facades\Activity;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;

class NowController extends Controller
{
    public function feed(): Response
    {
        /**
         * @var string
         */
        $xml = Cache::remember('now-rss', 3600, function () {
            $events = Activity::events();

            return view('now.rss', ['events' => $events])->render();
        });

        return response($xml)->header('Content-Type', 'application/xml');
    }

    public function styles(): Response
    {
        return response()
            ->view('now.styles')
            ->header('Content-Type', 'text/xml');
    }
}
