<div id="comment-{{ $id }}">
    <time
        class="text-sm font-mono bg-blue-lighter text-blue-darker px-2 py-1 rounded-lg"
        datetime="{{ $date->toDateTimeString() }}"
    >
        {{ $date->display('datetime') }}
    </time>

    <div class="pl-0 md:pl-4">
        {!! $slot !!}
    </div>
</div>
