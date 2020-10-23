@extends('layouts.master')

@section('content')
    <article class="mb-8">
        <h1 class="hidden">My Projects</h1>

        <h2 class="mt-0 font-bold">Apps</h2>
        <ul class="grid grid-cols-1 gap-4 list-none ml-0 pl-0 md:grid-cols-2">
            @project([
                'title' => 'Media Kraken',
                'icon' => 'media-kraken',
                'status' => 'LIVE',
                'platform' => 'pwa',
                'url' => 'https://noeldemartin.github.io/media-kraken',
            ])
                Keep track of your movies and create your own collection.
            @endproject

            @project([
                'title' => 'Solid Focus',
                'icon' => 'solid-focus',
                'iconClasses' => 'px-1',
                'status' => 'LIVE',
                'platform' => 'pwa',
                'url' => 'https://noeldemartin.github.io/solid-focus',
            ])
                Forget distractions and focus on what's important.
            @endproject

            @project([
                'title' => 'Planning Poker',
                'icon' => 'planning-poker',
                'iconClasses' => 'px-2',
                'status' => 'LIVE',
                'platform' => 'pwa',
                'url' => 'https://noeldemartin.github.io/planning-poker',
            ])
                A simple planning poker deck to help you organise your sprints.
            @endproject

            @project([
                'title' => 'Quick Pick',
                'image' => 'https://lincolnschilli.com/img/apps/quickpick.png',
                'status' => 'LIVE',
                'platform' => 'android',
                'url' => 'https://play.google.com/store/apps/details?id=com.lincolnschilli.quickpick',
            ])
                Test your memory and speed in a relaxed atmosphere.
            @endproject

            @project([
                'title' => 'Freedom Calculator',
                'status' => 'WIP',
                'statusColor' => 'blue',
                'platform' => 'web',
                'url' => 'https://noeldemartin.com/experiments/freedom-calculator',
            ])
                Check your economic runway.
            @endproject

            @project([
                'title' => 'Zazen Meditation Timer',
                'status' => 'WIP',
                'statusColor' => 'blue',
                'platform' => 'pwa',
                'url' => 'https://github.com/NoelDeMartin/zazen-meditation-timer',
            ])
                If you don't have time to meditate for 5 minutes, then meditate for an hour.
            @endproject
        </ul>

        <h2 class="mt-8 font-bold">Developer Tools</h2>
        <ul class="grid grid-cols-1 gap-4 list-none ml-0 pl-0 md:grid-cols-2">
            @project([
                'title' => 'Soukai',
                'icon' => 'soukai',
                'status' => 'v0.3',
                'url' => 'https://soukai.js.org',
            ])
                Active Record library for non-relational databases, written in JavaScript.
            @endproject

            @project([
                'title' => 'Soukai Solid',
                'icon' => 'soukai-solid',
                'status' => 'v0.3',
                'url' => 'https://github.com/NoelDeMartin/soukai-solid',
            ])
                Soukai engine to store data in a Solid POD.
            @endproject

            @project([
                'title' => 'Cypress Laravel',
                'image' => '/img/logos/cypressio.png',
                'status' => 'v0.2',
                'url' => 'https://github.com/NoelDeMartin/cypress-laravel',
            ])
                Cypress plugin to test Laravel applications.
            @endproject

            @project([
                'title' => 'TailwindCSS Colors Generator',
                'icon' => 'tailwindcss',
                'status' => 'v0.1',
                'url' => 'https://noeldemartin.github.io/tailwindcss-colors-generator/',
            ])
                GUI to generate color palettes for TailwindCSS.
            @endproject

            @project([
                'title' => 'Laravel Dusk Mocking',
                'icon' => 'laravel',
                'status' => 'v6.5',
                'url' => 'https://github.com/NoelDeMartin/laravel-dusk-mocking',
            ])
                Laravel package adding mocking capabilities to Laravel Dusk tests.
            @endproject

            @project([
                'title' => 'Laravel Semantic SEO',
                'icon' => 'laravel',
                'status' => 'v0.1',
                'url' => 'https://github.com/NoelDeMartin/laravel-semantic-seo',
            ])
                Laravel package to define semantic meta tags.
            @endproject

            @project([
                'title' => 'Metal',
                'icon' => 'docker',
                'iconClasses' => 'px-1',
                'status' => 'WIP',
                'statusColor' => 'blue',
                'url' => 'https://github.com/NoelDeMartin/metal',
            ])
                Docker wrapper that makes it a breeze to set up your development environment.
            @endproject

            @project([
                'title' => 'Rireki',
                'status' => 'WIP',
                'statusColor' => 'blue',
                'url' => 'https://github.com/NoelDeMartin/rireki',
            ])
                CLI application to schedule backups, supports uploads to AWS and DigitalOcean.
            @endproject

            @project([
                'title' => 'Autonomous Data',
                'icon' => 'autonomous-data',
                'iconClasses' => 'px-2',
                'status' => 'EXPERIMENTAL',
                'statusColor' => 'yellow',
                'url' => 'https://noeldemartin.github.io/autonomous-data',
            ])
                Application architecture that respects users privacy and data ownership.
            @endproject

            @project([
                'title' => 'Nginx Agora',
                'image' => '/img/logos/nginx.png',
                'imageClasses' => 'px-2',
                'status' => 'EXPERIMENTAL',
                'statusColor' => 'yellow',
                'url' => 'https://github.com/NoelDeMartin/nginx-agora',
            ])
                Collection of bash scripts to manage a reverse proxy for Docker containers.
            @endproject
        </ul>

        <h2 class="mt-8 font-bold">Discontinued</h2>
        <ul class="grid grid-cols-1 gap-4 list-none ml-0 pl-0 md:grid-cols-2">
            @project([
                'title' => 'Travel Postcards',
                'image' => 'https://lincolnschilli.com/img/apps/postcards.png',
                'status' => 'ARCHIVED',
                'statusColor' => 'yellow',
                'platform' => 'Web',
                'url' => 'https://postcards.lincolnschilli.com',
            ])
                Send postcards from your trip to Europe.
            @endproject

            @project([
                'title' => 'Brain Duels',
                'image' => 'https://lincolnschilli.com/img/apps/brainduels.png',
                'status' => 'ARCHIVED',
                'statusColor' => 'yellow',
                'platform' => 'Android',
                'url' => 'https://web.archive.org/web/20201018142318/https://play.google.com/store/apps/details?id=com.lincolnschilli.brainduels',
            ])
                Compete with Brain games in an online arena.
            @endproject

            @project([
                'title' => 'Beast Masters',
                'image' => '/img/logos/beastmasters.png',
                'platform' => 'Android',
                'status' => 'ARCHIVED',
                'statusColor' => 'yellow',
                'url' => '/downloads/beastmasters.apk',
            ])
                Recruit powerful beasts and build your deck in this strategy card game.
            @endproject

            @project([
                'title' => 'Geemba',
                'image' => '/img/logos/geemba.png',
                'platform' => 'Android | iOS',
                'status' => 'ARCHIVED',
                'statusColor' => 'yellow',
                'url' => 'https://web.archive.org/web/20161003075400/http://geemba.com/#why',
            ])
                Access sport facilities near you and pay only by the minute.
            @endproject
        </ul>
    </article>
@endsection
