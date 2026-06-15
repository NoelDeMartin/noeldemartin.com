@extends('layout')

@section('main')
    <article>
        @antlers
            {{ if show_title }}
            <h1>{{ title }}</h1>
            {{ /if }}

            {{ content | wrap_emoji }}
        @endantlers
    </article>
@endsection
