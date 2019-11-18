@extends('layouts.master')

@section('content')
    <article>
        <h1>About this site</h1>

        <p>
            The backend is build with <a href="https://laravel.com/" target="_blank">Laravel</a>
            and the frontend uses <a href="https://stimulusjs.org/" target="_blank">StimulusJS</a>
            and <a href="https://tailwindcss.com/" target="_blank">TailwindCSS</a> with
            <a href="https://github.com/turbolinks/turbolinks" target="_blank">TurboLinks</a>
            navigation. The database is deployed with
            <a href="https://mariadb.org/" target="_blank">MariaDB</a> SQL. The site is hosted on
            <a href="https://www.digitalocean.com/" target="_blank">DigitalOcean</a>
            and served using <a href="https://www.docker.com/" target="_blank">Docker</a> and
            <a href="https://github.com/noeldemartin/nginx-agora" target="_blank">Nginx-agora</a>.
        </p>

        <p>
            I don't do analytics and I don't store access logs, so there is
            <strong class="font-semibold">no tracking</strong>. If you inspect the network, you will
            notice there is a single cookie being used that is named
            <code class="font-mono">timezone_offset</code>. This cookie is used to display dates
            and times in your timezone, but it can't be used for identification.
        </p>

        <p class="mb-2">The following resources are also being used:</p>

        <ul>
            <li class="mb-1"><a href="https://design.ubuntu.com/font/" target="_blank">Ubuntu font</a></li>
            <li class="mb-1"><a href="https://www.hvdfonts.com/fonts/hvd-comic-serif" target="_blank">HVD Comic Serif font</a></li>
            <li class="mb-1"><a href="https://prismjs.com/">PrismJS</a></li>
            <li class="mb-1"><a href="https://www.zondicons.com/">Zondicons</a></li>
            <li class="mb-1"><a href="https://twemoji.twitter.com/" target="_blank">Twemoji</a></li>
            <li class="mb-1">
                <a href="https://www.flaticon.com" target="_blank">Flaticon</a> icons by
                <a href="https://www.flaticon.com/authors/monkik" target="_blank">monkik</a>,
                <a href="https://www.flaticon.com/authors/flat-icons" target="_blank">Flat icons</a> and
                <a href="https://www.flaticon.com/authors/freepik" target="_blank">Freepik</a>
            </li>
        </ul>
    </article>
@endsection
