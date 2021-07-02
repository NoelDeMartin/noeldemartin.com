@extends('layouts.master', ['minimal' => true])

@section('content')
    <article class="mb-8 mx-auto">
        <h1 class="sr-only">{{ $name }}</h1>

        <img
            src="/img/projects/{{ $slug }}/logo.png"
            alt="{{ $name }} — Logo"
            title="{{ $name }} — Logo"
            class="max-w-full w-112 mb-4 md:mb-8"
        >

        {!! $description !!}

        <h2>Images</h2>

        @carousel(compact('images'))
        @endcarousel

        <h2>Team</h2>

        <ul class="grid grid-cols-1 gap-4 list-none ml-0 pl-0 md:grid-cols-2">

            @foreach($team as $teamMember)

                @card([
                    'title' => $teamMember->name,
                    'image' => $teamMember->avatar ?? null,
                    'imageClasses' => 'rounded-full',
                    'imageWrapperClasses' => 'mr-4',
                    'url' => $teamMember->url,
                ])
                    {{ $teamMember->role }}
                @endcard

            @endforeach

        </ul>
    </article>
@endsection
