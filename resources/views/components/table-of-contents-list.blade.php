<ul class="m-0 list-none space-y-2 p-0">
    @foreach ($landmarks as $landmark)
        @isset($landmark->title)
            <li class="mb-1">
                <a
                    href="{{ $landmark->anchor }}"
                    style="margin-left: {{ $landmark->level - 2 }}rem"
                    @click="close()"
                >
                    {!! $landmark->title !!}
                </a>
            </li>
        @endisset

        @isset($landmark->children)
            <x-table-of-contents-list :landmarks="$landmark->children" />
        @endisset
    @endforeach
</ul>