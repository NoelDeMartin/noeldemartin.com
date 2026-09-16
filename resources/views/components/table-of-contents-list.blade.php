@props([
    'landmarks',
    'nested' => false,
])

@php
    $titledLandmarks = collect($landmarks)->filter(fn ($landmark) => isset($landmark->title));
    $allAreSections = ! $nested && $titledLandmarks->isNotEmpty() && $titledLandmarks->every(fn ($landmark) => isset($landmark->children));
    $allAreTopLevel = ! $nested && $titledLandmarks->isNotEmpty() && ! $titledLandmarks->some(fn ($landmark) => isset($landmark->children));
@endphp

<ul
    @class([
        'm-0 list-none p-0',
        'space-y-5' => $allAreSections,
        'space-y-1' => ! $allAreSections,
        'border-grey-light mt-2 border-l pl-3' => $nested,
    ])
>
    @foreach ($landmarks as $landmark)
        @if (isset($landmark->title) || isset($landmark->children))
            <li>
                @isset($landmark->title)
                    <a
                        href="{{ $landmark->anchor }}"
                        @class([
                            'text-blue-darkest block max-w-full text-sm tracking-wide no-underline transition-colors hover:underline focus:underline md:whitespace-nowrap',
                            'font-medium' => $landmark->level === 2 && ! $allAreTopLevel,
                        ])
                        data-turbo="false"
                        @click="close()"
                    >
                        {!! $landmark->title !!}
                    </a>
                @endisset

                @isset($landmark->children)
                    <x-table-of-contents-list
                        :landmarks="$landmark->children"
                        :nested="true"
                    />
                @endisset
            </li>
        @endif
    @endforeach
</ul>
