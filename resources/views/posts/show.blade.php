@inject('links', 'App\Social\LinksGenerator')

@extends('layouts.master')

@section('title', $post->title . ' | Noel De Martin')

@push('meta')
    <meta property="og:title" content="{{ $post->title }}" />
    <meta property="og:type" content="article" />
    <meta property="og:article:published_time" content="{{ $post->published_at->format(DateTime::ISO8601) }}" />
    <meta property="og:article:author:first_name" content="Noel" />
    <meta property="og:article:author:last_name" content="De Martin	" />
@endpush

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
            data-action="popup#show"
            data-popup-url="{{ $links->twitter($post) }}"
            data-popup-twitter="true"
            href="{{ $links->twitter($post) }}"
            class="text-blue-darkest hover:text-blue"
        >
            @icon('twitter-round', 'h-8 fill-current')
        </a>
        <a
            data-controller="popup"
            data-action="popup#show"
            data-popup-url="{{ $links->linkedin($post) }}"
            href="{{ $links->linkedin($post) }}"
            class="text-blue-darkest hover:text-blue"
        >
            @icon('linkedin-round', 'h-8 fill-current')
        </a>
        <a
            href="{{ $links->email($post) }}"
            class="text-blue-darkest hover:text-blue"
        >
            @icon('email-round', 'h-8 fill-current')
        </a>
        <a
            data-controller="clipboard"
            data-clipboard-data="{{ $links->raw($post) }}"
            data-clipboard-success="Link copied to clipboard!"
            data-action="clipboard#copy"
            href="{{ $links->raw($post) }}"
            class="text-blue-darkest hover:text-blue"
        >
            @icon('link-round', 'h-8 fill-current')
        </a>
    </div>
@endsection
