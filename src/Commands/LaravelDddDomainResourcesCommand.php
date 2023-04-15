<?php

namespace Alibori\LaravelDddDomainResources\Commands;

use Illuminate\Console\Command;

class LaravelDddDomainResourcesCommand extends Command
{
    public $signature = 'laravel-ddd-domain-resources';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
