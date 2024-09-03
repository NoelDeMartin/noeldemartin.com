<?php

return [

    'socials' => [
        'youtube' => [
            'url'  => 'https://youtube.com/@noeldemartin',
            'icon' => 'youtube',
            'name' => 'My Youtube channel',
            'short_name' => 'Youtube',
            'icon_class' => 'h-8',
            'extras' => [
                'rel' => 'me',
                'data-platform' => 'youtube',
            ],
        ],
        'twitter' => [
            'url'  => 'https://twitter.com/NoelDeMartin',
            'icon' => 'twitter',
            'name' => 'My Twitter',
            'short_name' => 'Twitter',
            'extras' => [
                'rel' => 'me',
                'data-platform' => 'twitter',
            ],
        ],
        'mastodon' => [
            'url'  => 'https://noeldemartin.social',
            'icon' => 'mastodon',
            'name' => 'My Mastodon',
            'short_name' => 'Mastodon',
            'extras' => [
                'rel' => 'me',
                'data-platform' => 'mastodon',
            ],
        ],
        'bluesky' => [
            'url'  => 'https://bsky.app/profile/noeldemartin.bsky.social',
            'icon' => 'bluesky',
            'name' => 'My Bluesky',
            'short_name' => 'Bluesky',
            'extras' => ['rel' => 'me'],
        ],
        'github' => [
            'url'  => 'https://github.com/NoelDeMartin',
            'icon' => 'github',
            'name' => 'My Github',
            'short_name' => 'Github',
            'extras' => ['rel' => 'me'],
        ],
        'email' => [
            'url'  => 'mailto:hey@noeldemartin.com?subject=Hi there!',
            'icon' => 'email',
            'name' => 'My Email',
            'short_name' => 'Email',
        ],
    ],

];
