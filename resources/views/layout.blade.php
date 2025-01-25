<!DOCTYPE html>
<html lang="{{ $site->short_locale }}" prefix="og: http://ogp.me/ns#">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <style>
            html {
                --default-display: none;
            }

            svg {
                display: var(--default-display);
            }

            header img {
                display: var(--default-display);
            }
        </style>
        <link
            rel="alternate"
            type="application/rss+xml"
            title="Noel De Martin [Journal]"
            href="{{ url('now/rss.xml') }}"
        />
        <link
            rel="alternate"
            type="application/rss+xml"
            title="Noel De Martin"
            href="{{ url('blog/rss.xml') }}"
        />
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
        <link rel="icon" href="/favicon.ico" type="image/x-icon" />
        @semanticSEO()
        @vite(['resources/assets/css/main.css', 'resources/assets/js/main.js'])
        @stack('head')
    </head>
    <body
        x-data="{ navigationOpen: false }"
        class="font-ubuntu text-black-light flex min-h-screen flex-col bg-white text-base leading-tight font-normal antialiased print:block"
        :class="navigationOpen ? 'overflow-hidden' : ''"
    >
        <a
            href="#main"
            class="border-blue-darkest sr-only z-20 border bg-white focus:not-sr-only focus:fixed focus:m-2 focus:p-2"
        >
            Skip to content
        </a>

        <x-layout-header
            :socials="$contact->socials"
            :collapsed="$minimal ?? false"
        />

        <turbo-frame
            id="mainframe"
            data-turbo-action="advance"
            class="w-full grow"
        >
            <main
                id="main"
                class="max-w-content relative mx-auto w-full grow p-4 pt-8 md:px-2"
                :class="navigationOpen ? 'mt-16' : ''"
                data-collapsed-header="{{ json_encode($minimal ?? false) }}"
                data-current-path="{{ '/' . ltrim(request()->path(), '/') }}"
            >
                @yield('main')
            </main>
        </turbo-frame>

        <x-layout-footer />

        <!-- Sites Verification -->
        <div class="hidden">
            <a rel="me" href="https://noeldemartin.social/@noeldemartin">
                Mastodon
            </a>
        </div>
    </body>
</html>
