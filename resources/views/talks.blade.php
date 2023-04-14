@extends('layouts.master')

@php
    $talks = [
        (object) [
            'title' => 'From Zero to Hero with Solid @ FOSDEM',
            'description' => "I share lessons learned making [Solid Focus](https://noeldemartin.github.io/solid-focus), [Media Kraken](https://noeldemartin.github.io/media-kraken), and [Umai](https://umai.noeldemartin.com) (but the talk is framework agnostic!). If you're curious about Solid, this is the best place to start.",
            'date' => carbon('2023-02-04'),
            'links' => [
                'Slides & Video (40min)' => 'https://fosdem.org/2023/schedule/event/sovcloud_from_zero_to_hero_with_solid/',
            ],
        ],
        (object) [
            'title' => 'Media Kraken @ Solid World',
            'description' => 'I introduce [Media Kraken](https://noeldemartin.github.io/media-kraken), explain how it came to be, and go a bit behind the curtain to see how it was built.',
            'date' => carbon('2021-02-04'),
            'links' => [
                'Slides' => 'https://speakerdeck.com/noeldemartin/media-kraken-at-solid-world',
                'Video (15min)' => 'https://vimeo.com/508623332#t=666',
            ],
        ],
        (object) [
            'title' => 'Showcasing an app that uses the Solid protocol for decentralized storage @ Blockchain Spirit',
            'description' => 'This was a lightning talk about [Solid Focus](https://noeldemartin.github.io/solid-focus) and [Soukai Solid](https://github.com/noeldemartin/soukai-solid).',
            'date' => carbon('2020-02-25'),
            'links' => [
                'Slides & Summary' => 'https://speakerdeck.com/noeldemartin/showcasing-an-app-that-uses-the-solid-protocol-for-decentralized-storage',
            ],
        ],
        (object) [
            'title' => 'An introduction to Solid @ MyData Meetup',
            'description' => 'I explain what [Solid](https://solidproject.org) is, where it came from, and its vision.',
            'date' => carbon('2020-02-18'),
            'links' => [
                'Slides & Summary' => 'https://speakerdeck.com/noeldemartin/an-introduction-to-solid',
            ],
        ],
        (object) [
            'title' => 'TCM Ionic Workshop @ TecnoCampus Mataró',
            'description' => 'Workshop to build a real-time chat using [Ionic](https://ionicframework.com/) and [Firebase DB](https://firebase.google.com/docs/database/). Given to [TCM](https://www.tecnocampus.cat/en/sobre-el-parc-tecnocampus/sobre-el-tecnocampus) Computer Engineering students.',
            'date' => carbon('2017-11-30'),
            'links' => [
                'Slides' => 'https://speakerdeck.com/noeldemartin/tcm-ionic-workshop',
                'Source' => 'https://github.com/NoelDeMartin/tcm-ionic-workshop',
            ],
        ],
        (object) [
            'title' => 'Awesome Tools 2017 @ TecnoCampus Mataró',
            'description' => 'Showcase of modern technologies we were using at [Geemba](/projects/geemba). Given to [TCM](https://www.tecnocampus.cat/en/sobre-el-parc-tecnocampus/sobre-el-tecnocampus) Computer Engineering students.',
            'date' => carbon('2017-06-09'),
            'links' => [
                'Slides' => 'https://speakerdeck.com/noeldemartin/awesome-tools-2017',
            ],
        ],
    ];
@endphp

@section('content')
    <article>
        <h1>Talks</h1>

        @foreach ($talks as $talk)
            @contentcard([
                'title' => $talk->title,
                'date' => $talk->date,
                'links' => $talk->links,
            ])
                {!! markdown($talk->description) !!}
            @endcontentcard
        @endforeach
    </article>
@endsection
