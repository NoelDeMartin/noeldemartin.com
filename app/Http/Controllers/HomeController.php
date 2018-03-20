<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Post;

class HomeController extends Controller
{
    public function blog()
    {
        // TODO pagination
        $posts =
            Post::where('published_at', '<', now())
                ->orderBy('published_at', 'desc')
                ->get();

        return view('blog', compact('posts'));
    }

    public function rss()
    {
        $posts =
            Post::where('published_at', '<', now())
                ->orderBy('published_at', 'desc')
                ->get();

        return response()
            ->view('blog.rss', compact('posts'))
            ->header('Content-Type', 'application/atom+xml');
    }

    public function health()
    {
        $status = 'Everything is OK';
        try {
            if (!app('db')->connection()) {
                $status = 'MySQL is not working correctly';
            }
        } catch (Exception $e) {
            $status = 'MySQL is not working correctly';
        }

        return $status;
    }
}
