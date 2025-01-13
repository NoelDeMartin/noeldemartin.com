<!doctype html>
<html lang="{{ $site->short_locale }}" class="h-full w-full">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $title ?? $site->name }}</title>
        @vite(['resources/css/site.css'])
    </head>
    <body class="h-full w-full bg-white font-sans leading-normal text-base font-normal text-gray-800 antialiased">
        <a href="#main" class="bg-white z-20 border border-blue-darkest sr-only focus:not-sr-only focus:fixed focus:m-2 focus:p-2">
            Skip to content
        </a>

        <header
            style="background-color: hsl(120, 40%, 80%)"
            class="flex flex-col items-center z-10 h-16 md:h-32 lg:h-40"
        >
            <div class="w-full max-w-content flex overflow-hidden">
                <a href="/" aria-label="Home" title="Home" class="flex" tabindex="-1">
                    <img
                        src="/img/myface.png"
                        alt=""
                        class="mr-2 transform md:mr-4 lg:mr-8 h-16/10 translate-y-[-15%] print:h-full print:translate-y-0"
                    />
                    <div class="grow my-auto" style="height:80%">
                        <x-icons.site-title class="h-full text-black fill-current" />
                    </div>
                </a>
            </div>
            <nav aria-label="Site navigation" class="w-full">
                <div class="max-w-content h-full mx-auto flex justify-between">
                    <div class="flex space-x-2">
                        <s:nav include_home="true">
                            <a
                                href="{{ $url }}"
                                class="group relative p-2 text-black font-bold uppercase flex items-center opacity-50 hover:opacity-100 focus:opacity-100 hover:bg-overlay [&:is([aria-current])]:opacity-100"
                                @if ($is_current)
                                    aria-current="page"
                                @endif
                            >
                                <x-dynamic-component :component="'icons.' . $icon" class="size-5 mr-2" />
                                <span class="border-b-2 border-transparent group-hover:border-black [[aria-current]>&]:border-black">
                                    {{ $title }}
                                </span>
                            </a>
                        </s:nav>
                    </div>
                </div>
            </nav>
        </header>

        <main id="main" class="relative max-w-content mx-auto p-4 pt-8 md:px-2">
            {!! $template_content !!}
        </main>

        <!-- Sites Verification -->
        <div class="hidden">
            <a rel="me" href="https://noeldemartin.social/@noeldemartin">Mastodon</a>
        </div>
    </body>
</html>
