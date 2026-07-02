<?php

namespace App\Console\Commands;

use App\Models\SiteSetting;
use App\Support\FaviconProcessor;
use Illuminate\Console\Command;

class ReprocessFaviconCommand extends Command
{
    protected $signature = 'site:reprocess-favicon';

    protected $description = 'Re-apply round mask to the saved site favicon';

    public function handle(): int
    {
        $path = SiteSetting::get('site_favicon');

        if (! $path) {
            $this->error('No favicon saved in site settings.');

            return self::FAILURE;
        }

        $this->info("Current: {$path}");

        $newPath = FaviconProcessor::applyCircleMask($path);
        SiteSetting::set('site_favicon', $newPath);

        $this->info("Updated: {$newPath}");

        return self::SUCCESS;
    }
}
