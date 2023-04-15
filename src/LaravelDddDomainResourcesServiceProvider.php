<?php

namespace Alibori\LaravelDddDomainResources;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Alibori\LaravelDddDomainResources\Commands\LaravelDddDomainResourcesCommand;

class LaravelDddDomainResourcesServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-ddd-domain-resources')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel-ddd-domain-resources_table')
            ->hasCommand(LaravelDddDomainResourcesCommand::class);
    }
}
