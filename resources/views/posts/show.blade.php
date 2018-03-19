@inject('links', 'App\Social\LinksGenerator')

@extends('layouts.master')

@section('content')
    <article class="max-w-readable mx-auto">

        <h1>{{ $post->title }}</h1>

        <div class="flex mb-4">

            <time datetime="{{ $post->published_at->toDateTimeString() }}">
                @icon('calendar', 'h-4 fill-current')
                <span class="ml-1">{{ $post->published_at->toFormattedDateString() }}</span>
            </time>

            <time datetime="{{ $post->duration }}M">
                @icon('timer', 'h-4 fill-current')
                <span class="ml-1">{{ $post->duration }} min.</span>
            </time>

        </div>

        {!! $post->text_html !!}

    </article>

    <div id="share" class="text-right">
        <a
            data-controller="popup"
            href="{!! $links->twitter($post) !!}"
            class="text-blue-darkest hover:text-blue"
            data-action="popup#show"
        >
            @icon('twitter-round', 'h-8 fill-current')
        </a>
        <a
            data-controller="popup"
            href="{!! $links->linkedin($post) !!}"
            class="text-blue-darkest hover:text-blue"
            data-action="popup#show"
        >
            @icon('linkedin-round', 'h-8 fill-current')
        </a>
        <a
            href="{!! $links->email($post) !!}"
            class="text-blue-darkest hover:text-blue"
        >
            @icon('email-round', 'h-8 fill-current')
        </a>
        <a
            data-controller="clipboard"
            href="{!! $links->raw($post) !!}"
            class="text-blue-darkest hover:text-blue"
            data-action="clipboard#copy"
        >
            @icon('link-round', 'h-8 fill-current')
        </a>
    </div>
@stop