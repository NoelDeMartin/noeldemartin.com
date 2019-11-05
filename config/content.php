<?php

return [

    'socials' => [
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
        'github' => [
            'url'  => 'https://github.com/NoelDeMartin',
            'icon' => 'github',
            'name' => 'My Github',
            'short_name' => 'Github',
            'extras' => ['rel' => 'me'],
        ],
        'linkedin' => [
            'url'  => 'https://www.linkedin.com/in/noeldemartin',
            'icon' => 'linkedin',
            'name' => 'My Linkedin',
            'short_name' => 'LinkedIn',
            'extras' => [
                'rel' => 'me',
                'data-platform' => 'linkedin',
            ],
        ],
        'email' => [
            'url'  => 'mailto:noeldemartin@gmail.com?subject=Hi there!',
            'icon' => 'gmail',
            'name' => 'My Email',
            'short_name' => 'Email',
        ],
    ],

];
