<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class PodcastController extends Controller
{
    public function feed(): Response
    {
        return response()
            ->view('podcast.feed')
            ->header('Content-Type', 'application/xml');
    }

    public function styles(): Response
    {
        $content = file_get_contents(resource_path('assets/xsl/podcast.xsl'));

        if (empty($content)) {
            abort(404);
        }

        return response($content)->header('Content-Type', 'text/xml');
    }
}
