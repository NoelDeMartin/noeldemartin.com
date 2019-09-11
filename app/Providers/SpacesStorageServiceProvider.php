<?php

namespace App\Providers;

use Aws\S3\S3Client;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use League\Flysystem\AwsS3v3\AwsS3Adapter;
use League\Flysystem\Filesystem;

class SpacesStorageServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Storage::extend('spaces', function ($app, $config) {
            $client = new S3Client([
                'credentials' => [
                    'key' => $config['key'],
                    'secret' => $config['secret'],
                ],
                'region' => $config['region'],
                'version' => 'latest',
                'bucket_endpoint' => false,
                'use_path_style_endpoint' => false,
                'endpoint' => $config['endpoint'],
            ]);

            return new Filesystem(
                new AwsS3Adapter($client, $config['bucket'], $config['folder'])
            );
        });
    }
}
