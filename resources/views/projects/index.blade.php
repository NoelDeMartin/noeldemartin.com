@extends('layouts.master')

@section('content')
    <article class="mb-8">
        <h1>Projects</h1>

        <p>
            In this page, you can find what I've been working on throughout my career. This only includes personal projects though,
            if you're curious about my professional experience you can look at <a href="/cv.pdf" target="_blank">my CV</a>.
        </p>

        <p>I've also given <a href="{{ route('talks') }}">some talks</a> you may want to check out.</p>

        <h2 class="mt-0 font-bold">Apps</h2>
        <ul class="grid grid-cols-1 gap-4 list-none ml-0 pl-0 md:grid-cols-2">
            @card([
                'title' => 'Umai',
                'icon' => 'umai',
                'iconClasses' => 'px-1',
                'status' => 'LIVE',
                'platform' => 'pwa',
                'url' => 'https://umai.noeldemartin.com',
            ])
                Manage and share all your precious recipes
            @endcard

            @card([
                'title' => 'Media Kraken',
                'icon' => 'media-kraken',
                'status' => 'LIVE',
                'platform' => 'pwa',
                'url' => 'https://noeldemartin.github.io/media-kraken',
            ])
                Keep track of your movies and create your own collection.
            @endcard

            @card([
                'title' => 'Solid Focus',
                'icon' => 'solid-focus',
                'iconClasses' => 'px-1',
                'status' => 'LIVE',
                'platform' => 'pwa',
                'url' => 'https://noeldemartin.github.io/solid-focus',
            ])
                Forget distractions and focus on what's important.
            @endcard

            @card([
                'title' => 'Planning Poker',
                'icon' => 'planning-poker',
                'iconClasses' => 'px-2',
                'status' => 'LIVE',
                'platform' => 'pwa',
                'url' => 'https://noeldemartin.github.io/planning-poker',
            ])
                A simple planning poker deck to help you organise your sprints.
            @endcard

            @card([
                'title' => 'Freedom Calculator',
                'status' => 'WIP',
                'statusColor' => 'blue',
                'platform' => 'web',
                'url' => route('experiments.freedom-calculator'),
            ])
                Check your economic runway.
            @endcard

            @card([
                'title' => 'Zazen Meditation Timer',
                'status' => 'WIP',
                'statusColor' => 'blue',
                'platform' => 'pwa',
                'url' => 'https://github.com/NoelDeMartin/zazen-meditation-timer',
            ])
                If you don't have time to meditate for 5 minutes, then meditate for an hour.
            @endcard
        </ul>

        <h2 class="mt-8 font-bold">Developer Tools</h2>
        <ul class="grid grid-cols-1 gap-4 list-none ml-0 pl-0 md:grid-cols-2">
            @card([
                'title' => 'Soukai',
                'icon' => 'soukai',
                'status' => 'v0.5',
                'url' => 'https://soukai.js.org',
            ])
                Active Record library for non-relational databases, written in JavaScript.
            @endcard

            @card([
                'title' => 'Soukai Solid',
                'icon' => 'soukai-solid',
                'status' => 'v0.5',
                'url' => 'https://github.com/NoelDeMartin/soukai-solid',
            ])
                Soukai engine to store data in a Solid POD.
            @endcard

            @card([
                'title' => 'Cypress Laravel',
                'image' => '/img/logos/cypressio.png',
                'status' => 'v0.2',
                'url' => 'https://github.com/NoelDeMartin/cypress-laravel',
            ])
                Cypress plugin to test Laravel applications.
            @endcard

            @card([
                'title' => 'Cypress Solid',
                'image' => '/img/logos/cypressio.png',
                'status' => 'v0.1',
                'url' => 'https://github.com/NoelDeMartin/cypress-solid',
            ])
                Cypress plugin to test Solid apps.
            @endcard

            @card([
                'title' => 'TailwindCSS Colors Generator',
                'icon' => 'tailwindcss',
                'status' => 'v0.1',
                'url' => 'https://noeldemartin.github.io/tailwindcss-colors-generator/',
            ])
                GUI to generate color palettes for TailwindCSS.
            @endcard

            @card([
                'title' => 'Laravel Dusk Mocking',
                'icon' => 'laravel',
                'status' => 'v6.5',
                'url' => 'https://github.com/NoelDeMartin/laravel-dusk-mocking',
            ])
                Laravel package adding mocking capabilities to Laravel Dusk tests.
            @endcard

            @card([
                'title' => 'Laravel Semantic SEO',
                'icon' => 'laravel',
                'status' => 'v0.1',
                'url' => 'https://github.com/NoelDeMartin/laravel-semantic-seo',
            ])
                Laravel package to define semantic meta tags.
            @endcard

            @card([
                'title' => 'AerogelJS',
                'status' => 'WIP',
                'statusColor' => 'blue',
                'url' => 'https://aerogel.js.org',
            ])
                Web Application Framework
            @endcard

            @card([
                'title' => 'Metal',
                'icon' => 'docker',
                'iconClasses' => 'px-1',
                'status' => 'EXPERIMENTAL',
                'statusColor' => 'yellow',
                'url' => 'https://github.com/NoelDeMartin/metal',
            ])
                Docker wrapper that makes it a breeze to set up your development environment.
            @endcard

            @card([
                'title' => 'Rireki',
                'status' => 'EXPERIMENTAL',
                'statusColor' => 'yellow',
                'url' => 'https://github.com/NoelDeMartin/rireki',
            ])
                CLI application to schedule backups, supports uploads to AWS and DigitalOcean.
            @endcard

            @card([
                'title' => 'Autonomous Data',
                'icon' => 'autonomous-data',
                'iconClasses' => 'px-2',
                'status' => 'EXPERIMENTAL',
                'statusColor' => 'yellow',
                'url' => 'https://autonomous-data.noeldemartin.com',
            ])
                Application architecture that respects users privacy and data ownership.
            @endcard

            @card([
                'title' => 'Nginx Agora',
                'image' => '/img/logos/nginx.png',
                'imageClasses' => 'px-2',
                'status' => 'EXPERIMENTAL',
                'statusColor' => 'yellow',
                'url' => 'https://github.com/NoelDeMartin/nginx-agora',
            ])
                Collection of bash scripts to manage a reverse proxy for Docker containers.
            @endcard
        </ul>

        <h2 class="mt-8 font-bold">Discontinued</h2>
        <ul class="grid grid-cols-1 gap-4 list-none ml-0 pl-0 md:grid-cols-2">
            @card([
                'title' => 'Geemba',
                'image' => '/img/logos/geemba.png',
                'platform' => 'Android & iOS',
                'status' => 'ARCHIVED',
                'statusColor' => 'yellow',
                'url' => route('projects.show', 'geemba'),
                'target' => '_self',
            ])
                Access sport facilities near you and pay only by the minute.
            @endcard

            @card([
                'title' => 'Beast Masters',
                'image' => '/img/logos/beastmasters.png',
                'platform' => 'Android',
                'status' => 'ARCHIVED',
                'statusColor' => 'yellow',
                'url' => route('projects.show', 'beastmasters'),
                'target' => '_self',
            ])
                Recruit powerful beasts and build your deck in this strategy card game.
            @endcard

            @card([
                'title' => 'Travel Postcards',
                'image' => 'https://lincolnschilli.com/img/apps/postcards.png',
                'status' => 'ARCHIVED',
                'statusColor' => 'yellow',
                'platform' => 'Web',
                'url' => 'https://postcards.lincolnschilli.com',
            ])
                Send postcards from your trip to Europe.
            @endcard

            @card([
                'title' => 'Brain Duels',
                'image' => 'https://lincolnschilli.com/img/apps/brainduels.png',
                'status' => 'ARCHIVED',
                'statusColor' => 'yellow',
                'platform' => 'Android',
                'url' => 'https://web.archive.org/web/20160630211718/https://play.google.com/store/apps/details?id=com.lincolnschilli.brainduels',
            ])
                Compete with Brain games in an online arena.
            @endcard

            @card([
                'title' => 'Quick Pick',
                'image' => 'https://lincolnschilli.com/img/apps/quickpick.png',
                'platform' => 'android',
                'status' => 'ARCHIVED',
                'statusColor' => 'yellow',
                'url' => 'https://web.archive.org/web/20160630204222/https://play.google.com/store/apps/details?id=com.lincolnschilli.quickpick',
            ])
                Test your memory and speed in a relaxed atmosphere.
            @endcard
        </ul>
    </article>
@endsection
