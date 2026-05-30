@extends('layout', ['minimal' => true])

@section('main')
    <article>
        <!-- prettier-ignore -->
        <h1 class="mb-0">Let me <i>brag</i> a little</h1>
        <h2 class="mt-0 text-xs italic">and maybe hire me!</h2>

        <div
            class="max-w-readable [&>p,&>ul,&>ol,&>blockquote]:prose [&>p,&>ul,&>ol,&>blockquote]:max-w-none"
        >
            @antlers
                {{ content | wrap_emoji }}
            @endantlers
        </div>

        <x-table-of-contents
            :title="$title"
            :landmarks="$landmarks->value()"
        />
    </article>
@endsection
