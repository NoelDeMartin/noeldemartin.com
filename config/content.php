<?php

return [

    'socials' => [
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
        'github' => [
            'url'  => 'https://github.com/NoelDeMartin',
            'icon' => 'github',
            'name' => 'My Github',
            'short_name' => 'Github',
            'extras' => ['rel' => 'me'],
        ],
        'email' => [
            'url'  => 'mailto:noeldemartin@hey.com?subject=Hi there!',
            'icon' => 'email',
            'name' => 'My Email',
            'short_name' => 'Email',
        ],
    ],

];
