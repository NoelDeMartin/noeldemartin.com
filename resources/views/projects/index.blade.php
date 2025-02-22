@extends('layout')

@section('main')
    <article class="pb-4">
        @antlers
            <h1>{{ title }}</h1>

            {{ content }}
        @endantlers

        <x-project-cards title="Apps" category="app" title-class="mt-0" />
        <x-project-cards title="Developer Tools" category="tool" />
        <x-project-cards title="Discontinued" category="discontinued" />
    </article>
@endsection
