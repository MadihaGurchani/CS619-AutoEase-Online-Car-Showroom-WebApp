<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class QuickCacheClear extends Command
{
    protected $signature = 'quick:clear';
    protected $description = 'Quickly clear essential caches';

    public function handle()
    {
        Artisan::call('route:clear');
        Artisan::call('view:clear');
        $this->info('Essential caches cleared successfully!');
    }
}