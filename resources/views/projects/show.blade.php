@extends('layout', ['minimal' => true])

@section('main')
    <article class="mx-auto mb-8">
        <h1 class="sr-only">{{ $title }}</h1>

        <img
            src="/img/projects/{{ $slug }}/logo.png"
            alt="{{ $title }} — Logo"
            title="{{ $title }} — Logo"
            class="mb-4 w-112 max-w-full md:mb-8"
        />

        @antlers
            {{ content }}
        @endantlers

        <s:get_content :from="$slug . '-project'">
            <h2>Images</h2>
            <x-carousel :images="$images->value()" />

            <h2>Team</h2>
            <ul
                class="ml-0 grid list-none grid-cols-1 gap-4 pl-0 md:grid-cols-2"
            >
                @foreach ($team as $member)
                    <x-card
                        image-classes="rounded-full"
                        image-wrapper-classes="mr-4"
                        :title="$member->name"
                        :image="$member->avatar"
                        :link="$member->link"
                    >
                        {{ $member->role }}
                    </x-card>
                @endforeach
            </ul>
        </s:get_content>
    </article>
@endsection
