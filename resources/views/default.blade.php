@extends('layout')

@section('main')
    <article>
        @antlers
            {{ if show_title }}
            <h1>{{ title }}</h1>
            {{ /if }}

            {{ content }}
        @endantlers
    </article>
@endsection
