<?php

namespace Alibori\LaravelDddDomainResources\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Alibori\LaravelDddDomainResources\LaravelDddDomainResources
 */
class LaravelDddDomainResources extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Alibori\LaravelDddDomainResources\LaravelDddDomainResources::class;
    }
}
