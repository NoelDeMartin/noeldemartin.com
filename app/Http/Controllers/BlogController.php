<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Statamic\Facades\Entry;

class BlogController extends Controller
{
    public function feed(): Response
    {
        $posts = Entry::whereCollection('posts')->sortByDesc('publication_date')->all();

        return response()
            ->view('blog.rss', ['posts' => $posts])
            ->header('Content-Type', 'application/xml');
    }

    public function styles(): Response
    {
        return response()
            ->view('blog.styles')
            ->header('Content-Type', 'text/xml');
    }
}
