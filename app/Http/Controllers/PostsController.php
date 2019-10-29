<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\SemanticSEO\BlogPost;
use Illuminate\Support\Carbon;
use NoelDeMartin\SemanticSEO\Support\Facades\SemanticSEO;

class PostsController extends Controller
{
    public function index()
    {
        if (auth()->check() && (auth()->user()->is_reviewer || auth()->user()->is_admin)) {
            $posts = Post::orderBy('published_at', 'desc')
                ->get();
        } else {
            $posts = Post::where('published_at', '<', Carbon::now())
                ->orderBy('published_at', 'desc')
                ->get();
        }

        return view('posts.index', compact('posts'));
    }

    public function show($tag)
    {
        if (is_numeric($tag)) {
            $post = Post::findOrFail($tag);

            return redirect(route('posts.show', [$post->tag]), 301);
        }

        $post = Post::where('tag', $tag)->first();

        if (
            $post === null ||
            (! $post->isPublished() && (! auth()->check() || ! (auth()->user()->is_reviewer || auth()->user()->is_admin)))
        ) {
            abort(404);
        }

        SemanticSEO::canonical(route('posts.show', $post->tag));

        SemanticSEO::is(new BlogPost($post));

        return view('posts.show', compact('post'));
    }
}
