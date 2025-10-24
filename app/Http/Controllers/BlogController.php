<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Statamic\Facades\Entry;

class BlogController extends Controller
{
    public function feed(): Response
    {
        $xml = Cache::remember('blog-rss', 3600, function () {
            $posts = Entry::whereCollection('posts')->sortByDesc('publication_date')->all();

            return view('blog.rss', ['posts' => $posts])->render();
        });

        return response($xml)
            ->header('Content-Type', 'application/xml');
    }

    public function styles(): Response
    {
        return response()
            ->view('blog.styles')
            ->header('Content-Type', 'text/xml');
    }
}
