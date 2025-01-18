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
        $content = file_get_contents(resource_path('assets/xsl/feed.xsl'));

        if (empty($content)) {
            abort(404);
        }

        return response($content)->header('Content-Type', 'text/xml');
    }
}
