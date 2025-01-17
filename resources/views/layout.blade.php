<!DOCTYPE html>
<html lang="{{ $site->short_locale }}">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>{{ $title ?? $site->name }}</title>
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
        @vite(['resources/assets/css/main.css', 'resources/assets/js/main.js'])
    </head>
    <body
        class="font-ubuntu text-black-light flex min-h-screen flex-col bg-white text-base leading-tight font-normal antialiased print:block"
    >
        <a
            href="#main"
            class="border-blue-darkest sr-only z-20 border bg-white focus:not-sr-only focus:fixed focus:m-2 focus:p-2"
        >
            Skip to content
        </a>

        <x-layout-header :socials="$contact->socials" />

        <main
            id="main"
            class="max-w-content relative mx-auto w-full grow p-4 pt-8 md:px-2"
        >
            @yield('main')
        </main>

        <!-- Sites Verification -->
        <div class="hidden">
            <a rel="me" href="https://noeldemartin.social/@noeldemartin">
                Mastodon
            </a>
        </div>
    </body>
</html>
