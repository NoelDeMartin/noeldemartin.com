<article class="content-card mb-4 md:mb-8">

    <h2 class="my-0">
        <a
            href="{{ $url }}"
            class="
                font-bold text-blue-darkest
                hover:underline hover:text-blue-darkest
            "
        >
            {{ $title }}
        </a>
    </h2>

    <div class="max-w-readable">
        {!! $slot !!}

        <a href="{{ $url }}">Read more</a>
    </div>

</article>
