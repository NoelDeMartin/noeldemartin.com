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
        return response()
            ->view('podcast.styles')
            ->header('Content-Type', 'text/xml');
    }
}
