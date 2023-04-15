<?php

declare(strict_types=1);

namespace Alibori\LaravelDddDomainResources\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Alibori\LaravelDddDomainResources\LaravelDddDomainResourcesServiceProvider;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [
            LaravelDddDomainResourcesServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app): void
    {
        config()->set('ddd-domain-resources.domains_path', '.');

        config()->set('ddd-domain-resources.domains', [
            'user' => [
                'name' => 'User',
                'namespace' => 'App\\Domains\\User',
            ],
        ]);
    }
}
