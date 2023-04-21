<?php

declare(strict_types=1);

namespace Alibori\LaravelDddDomainResources;

use Alibori\LaravelDddDomainResources\Commands\Generators\LaravelDddDomainResourcesGeneratorCommand;
use Alibori\LaravelDddDomainResources\Commands\LaravelDddDomainResourcesCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelDddDomainResourcesServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name(name: 'laravel-ddd-domain-resources')
            ->hasConfigFile(configFileName: 'ddd-domain-resources')
            ->hasCommand(commandClassName: LaravelDddDomainResourcesCommand::class)
            ->hasCommands(commandClassNames: LaravelDddDomainResourcesGeneratorCommand::class);
    }

    public function packageRegistered(): void
    {
        $this->publishes(
            paths:[
                __DIR__.'/../resources/stubs/' => base_path(path: 'stubs/ddd-domain-resources'),
            ],
            groups: 'ddd-domain-resources-stubs'
        );
    }
}
