<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class NovaLink extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'nova:link';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create symbolic links for nova public vendor files';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->laravel->make('files')->link(
            '../../vendor/laravel/nova/public',
            public_path('vendor/nova')
        );
        $this->info('The [public/vendor/nova] directory has been linked.');
    }
}
