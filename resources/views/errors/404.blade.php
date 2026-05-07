@extends('layout', ['title' => 'Not found'])

@section('main')
    <div
        class="pointer-events-none fixed inset-0 mt-12 flex items-center justify-center"
    >
        <a
            href="https://xkcd.com/1969/"
            alt="Not Found"
            target="_blank"
            class="pointer-events-auto"
        >
            <img
                class="max-h-full max-w-full"
                src="https://imgs.xkcd.com/comics/not_available.png"
                alt="Not Found XKCD webcomic"
                title="Not Found"
            />
        </a>
    </div>
@endsection
