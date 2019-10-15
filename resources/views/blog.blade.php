@extends('layouts.master')

@section('content')
    <h1 class="hidden">Blog</h1>

    @foreach ($posts as $post)
        @contentcard([
            'url' => $post->url,
            'title' => $post->title,
        ])
            {!! $post->summary_html !!}
        @endcontentcard
    @endforeach

    <div class="alert mt-4">
        <p>
            @icon('rss', 'inline h-4 fill-current') You can add <a href="{!! route('blog.rss') !!}">this</a> to your rss feed to keep up to date.
        </p>
    </div>

@stop
