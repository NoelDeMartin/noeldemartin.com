<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Markdown Parser Configurations
    |--------------------------------------------------------------------------
    |
    | Here you may define the configuration arrays for each markdown parser.
    | You may use the base CommonMark options as well as any extensions'
    | options here. The available options are in the CommonMark docs.
    |
    | https://statamic.dev/extending/markdown#configuration
    |
    */

    'configs' => [

        'default' => [
            'heading_permalink' => [
                'apply_id_to_heading' => true,
                'fragment_prefix' => '',
                'id_prefix' => '',
                'symbol' => '',
            ],

            'external_link' => [
                'internal_hosts' => ['noeldemartin.com', 'www.noeldemartin.com'],
                'open_in_new_window' => true,
                'noreferrer' => '',
                'noopener' => 'external',
            ],
        ],

    ],

];
