@extends('layout')

@section('main')
    <article>
        @antlers
            <h1>{{ title }}</h1>

            {{ content }}
        @endantlers

        <h2 class="mt-0 font-bold">Apps</h2>
        <ul class="ml-0 grid list-none grid-cols-1 gap-4 pl-0 md:grid-cols-2">
            <statamic:collection from="projects" category:is="app">
                <x-project-card
                    :$title
                    :$logo
                    :logo-classes="$logo_classes"
                    :$link
                    :$state
                    :$stateClasses
                    :$platform
                >
                    @antlers
                        {{ content }}
                    @endantlers
                </x-project-card>
            </statamic:collection>
        </ul>

        <h2 class="mt-8 font-bold">Developer Tools</h2>
        <ul class="ml-0 grid list-none grid-cols-1 gap-4 pl-0 md:grid-cols-2">
            <statamic:collection from="projects" category:is="tool">
                <x-project-card
                    :$title
                    :$logo
                    :logo-classes="$logo_classes"
                    :$link
                    :$state
                    :$stateClasses
                    :$platform
                >
                    @antlers
                        {{ content }}
                    @endantlers
                </x-project-card>
            </statamic:collection>
        </ul>
    </article>
@endsection
