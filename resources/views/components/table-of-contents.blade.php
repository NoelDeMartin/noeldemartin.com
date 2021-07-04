<ul class="list-none m-0 p-0 space-y-2">
    @foreach ($landmarks as $landmark)
        @isset($landmark->title)
            <li class="mb-1">
                <a
                    href="{{ $landmark->anchor }}" style="margin-left: {{ ($landmark->level - 2) }}rem"
                    data-action="click->blog-post#toggleTableOfContents"
                >
                    {!! $landmark->title !!}
                </a>
            </li>
        @endisset

        @isset($landmark->children)
            @tableofcontents(['landmarks' => $landmark->children])
            @endtableofcontents
        @endisset
    @endforeach
</ul>
