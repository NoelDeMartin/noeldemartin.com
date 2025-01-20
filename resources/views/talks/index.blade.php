@extends('layout')

@section('main')
    @antlers
        <h1>{{ title }}</h1>

        {{ content }}
    @endantlers

    <x-content-card
        title="Solid CRDTs in Practice @ Solid Symposium"
        :date="carbon('2024-05-03')"
        :links="[
            'Slides' => 'https://slidr.io/NoelDeMartin/solid-crdts-in-practice',
            'Video (12min)' => 'https://www.youtube.com/watch?v=vYQmGeaQt8E',
        ]"
    >
        <s:markdown>
            CRDTs is the technology that enables local-first applications, and
            in this presentation I share how I learned about them and crafted my
            own solution for Solid Apps.
        </s:markdown>
    </x-content-card>

    <x-content-card
        title="Thoughts on Solid Developer Experience @ Solid Symposium"
        :date="carbon('2024-05-02')"
        :links="[
            'Slides' => 'https://slidr.io/NoelDeMartin/solid-developer-experience',
            'Video (16min)' => 'https://www.youtube.com/watch?v=ghGmveKKe5Y',
        ]"
    >
        <s:markdown>
            Solid has a bad rap about being difficult to work with. But is it
            really that hard? In this presentation, I share my take on Developer
            Experience when making Solid Apps.
        </s:markdown>
    </x-content-card>

    <x-content-card
        title="From Zero to Hero with Solid @ FOSDEM"
        :date="carbon('2023-02-04')"
        :links="[
            'Slides' => 'https://fosdem.org/2023/schedule/event/sovcloud_from_zero_to_hero_with_solid/',
            'Video (40min)' => 'https://www.youtube.com/watch?v=kPzhykRVDuI',
        ]"
    >
        <s:markdown>
            I share lessons learned making [Solid
            Focus](https://noeldemartin.github.io/solid-focus), [Media
            Kraken](https://noeldemartin.github.io/media-kraken), and
            [Umai](https://umai.noeldemartin.com) (but the talk is framework
            agnostic!). If you're curious about Solid, this is the best place to
            start.
        </s:markdown>
    </x-content-card>

    <x-content-card
        title="Media Kraken @ Solid World"
        :date="carbon('2021-02-04')"
        :links="[
            'Slides' => 'https://speakerdeck.com/noeldemartin/media-kraken-at-solid-world',
            'Video (23min)' => 'https://www.youtube.com/watch?v=cajBTJXmKhA',
        ]"
    >
        <s:markdown>
            I introduce [Media
            Kraken](https://noeldemartin.github.io/media-kraken), explain how it
            came to be, and go a bit behind the curtain to see how it was built.
        </s:markdown>
    </x-content-card>

    <x-content-card
        title="Showcasing an app that uses the Solid protocol for decentralized storage @ Blockchain Spirit"
        :date="carbon('2020-02-25')"
        :links="[
            'Slides & Summary' => 'https://speakerdeck.com/noeldemartin/showcasing-an-app-that-uses-the-solid-protocol-for-decentralized-storage',
        ]"
    >
        <s:markdown>
            This was a lightning talk about [Solid
            Focus](https://noeldemartin.github.io/solid-focus) and [Soukai
            Solid](https://github.com/noeldemartin/soukai-solid).
        </s:markdown>
    </x-content-card>

    <x-content-card
        title="An introduction to Solid @ MyData Meetup"
        :date="carbon('2020-02-18')"
        :links="[
            'Slides & Summary' => 'https://speakerdeck.com/noeldemartin/an-introduction-to-solid',
        ]"
    >
        <s:markdown>
            I explain what [Solid](https://solidproject.org) is, where it came
            from, and its vision.
        </s:markdown>
    </x-content-card>

    <x-content-card
        title="TCM Ionic Workshop @ TecnoCampus Mataró"
        :date="carbon('2017-11-30')"
        :links="[
            'Slides' => 'https://speakerdeck.com/noeldemartin/tcm-ionic-workshop',
            'Source' => 'https://github.com/NoelDeMartin/tcm-ionic-workshop',
        ]"
    >
        <s:markdown>
            Workshop to build a real-time chat using
            [Ionic](https://ionicframework.com/) and [Firebase
            DB](https://firebase.google.com/docs/database/). Given to
            [TCM](https://www.tecnocampus.cat/en/sobre-el-parc-tecnocampus/sobre-el-tecnocampus)
            Computer Engineering students.
        </s:markdown>
    </x-content-card>

    <x-content-card
        title="Awesome Tools 2017 @ TecnoCampus Mataró"
        :date="carbon('2017-06-09')"
        :links="[
            'Slides' => 'https://speakerdeck.com/noeldemartin/awesome-tools-2017',
        ]"
    >
        <s:markdown>
            Showcase of modern technologies we were using at
            [Geemba](/projects/geemba). Given to
            [TCM](https://www.tecnocampus.cat/en/sobre-el-parc-tecnocampus/sobre-el-tecnocampus)
            Computer Engineering students.
        </s:markdown>
    </x-content-card>
@endsection
