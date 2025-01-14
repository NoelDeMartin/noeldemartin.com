<!DOCTYPE html>
<html lang="{{ $site->short_locale }}" class="h-full w-full">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>{{ $title ?? $site->name }}</title>
        @vite(["resources/css/main.css"])
    </head>
    <body
        class="h-full w-full bg-white font-sans text-base leading-normal font-normal text-gray-800 antialiased"
    >
        <a
            href="#main"
            class="border-blue-darkest sr-only z-20 border bg-white focus:not-sr-only focus:fixed focus:m-2 focus:p-2"
        >
            Skip to content
        </a>

        <header
            style="background-color: hsl(120, 40%, 80%)"
            class="z-10 flex h-16 flex-col items-center md:h-32 lg:h-40"
        >
            <div class="max-w-content flex w-full overflow-hidden">
                <a
                    href="/"
                    aria-label="Home"
                    title="Home"
                    class="flex"
                    tabindex="-1"
                >
                    <img
                        src="/img/myface.png"
                        alt=""
                        class="mr-2 h-16/10 translate-y-[-15%] transform md:mr-4 lg:mr-8 print:h-full print:translate-y-0"
                    />
                    <div class="my-auto grow" style="height: 80%">
                        <s:partial
                            src="icons/site-title"
                            class="h-full fill-current text-black"
                        />
                    </div>
                </a>
            </div>
            <nav aria-label="Site navigation" class="bg-overlay w-full">
                <div class="max-w-content mx-auto flex h-full justify-between">
                    <div class="flex space-x-2">
                        <s:nav include_home="true">
                            <a
                                href="{{ $url }}"
                                class="group hover:bg-overlay relative flex items-center p-2 font-bold text-black uppercase opacity-50 hover:opacity-100 focus:opacity-100 [&:is([aria-current])]:opacity-100"
                                @if ($is_current)
                                    aria-current="page"
                                @endif
                            >
                                <s:partial
                                    :src="'icons/'.$icon"
                                    class="mr-2 size-5"
                                />
                                <span
                                    class="border-b-2 border-transparent group-hover:border-black [[aria-current]>&]:border-black"
                                >
                                    {{ $title }}
                                </span>
                            </a>
                        </s:nav>
                    </div>
                </div>
            </nav>
        </header>

        <main id="main" class="max-w-content relative mx-auto p-4 pt-8 md:px-2">
            @yield("main")
        </main>

        <!-- Sites Verification -->
        <div class="hidden">
            <a rel="me" href="https://noeldemartin.social/@noeldemartin">
                Mastodon
            </a>
        </div>
    </body>
</html>
