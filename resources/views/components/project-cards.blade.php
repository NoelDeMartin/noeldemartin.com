<h2 class="{{ $titleClass ?? 'mt-8' }} font-bold">{{ $title }}</h2>

<ul class="ml-0 grid list-none grid-cols-1 gap-4 pl-0 md:grid-cols-2">
    <statamic:collection from="projects" :category:is="$category">
        <x-card
            :$title
            :$state
            :$stateClasses
            :image="$logo->value()"
            :image-classes="$logo_classes"
            :link="$link->value()"
            :platform="$platform->value()"
        >
            @antlers
                {{ content }}
            @endantlers
        </x-card>
    </statamic:collection>
</ul>
