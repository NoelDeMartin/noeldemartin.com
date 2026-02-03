@extends('layout')

@section('main')
    <article class="pb-4">
        @antlers
            <h1>{{ title }}</h1>

            {{ content }}
        @endantlers

        <x-callout
            title="Check out my talks!"
            content="Get more insight into my work, projects, and how I build stuff."
            url="/talks"
            image="/img/talks/interoperable-serendipity.png"
            icon="icons/slides"
            xl
        />

        <x-project-cards title="Apps" category="app" title-class="mt-0" />
        <x-project-cards title="Developer Tools" category="tool" />
        <x-project-cards title="Discontinued" category="discontinued" />
    </article>
@endsection
