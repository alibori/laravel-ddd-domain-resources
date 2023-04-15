<?php

declare(strict_types=1);

namespace Alibori\LaravelDddDomainResources;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Alibori\LaravelDddDomainResources\Commands\LaravelDddDomainResourcesCommand;

class LaravelDddDomainResourcesServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name(name: 'laravel-ddd-domain-resources')
            ->hasConfigFile(configFileName: 'ddd-domain-resources')
            ->hasCommand(commandClassName: LaravelDddDomainResourcesCommand::class);
    }
}
