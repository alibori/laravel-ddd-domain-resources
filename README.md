# Laravel DDD Domain Resources

[![Latest Version on Packagist](https://img.shields.io/packagist/v/alibori/laravel-ddd-domain-resources.svg?style=flat-square)](https://packagist.org/packages/alibori/laravel-ddd-domain-resources)
[![run-tests](https://github.com/alibori/laravel-ddd-domain-resources/actions/workflows/run-tests.yml/badge.svg)](https://github.com/alibori/laravel-ddd-domain-resources/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/alibori/laravel-ddd-domain-resources.svg?style=flat-square)](https://packagist.org/packages/alibori/laravel-ddd-domain-resources)

Package to generate domain resources for a Laravel DDD application.

Keeping in mind that DDD architecture in a Laravel application has a lot of different approaches, this package is intended to be used as a vertical slice of a DDD implementation. Also, it has some basic stub files that can be customized to fit your needs.

## Installation

You can install the package via composer:

```bash
composer require alibori/laravel-ddd-domain-resources --dev
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="ddd-domain-resources-config"
```

This is the contents of the published config file:

```php
<?php

declare(strict_types=1);

// config for Alibori/LaravelDddDomainResources package
return [
    /**
     * Here goes the path to your DDD Domains folder.
     */
    'domains_path' => 'app\\Domains',
    /**
     * Here goes all your desired DDD Domain Resources configuration.
     */
    'domains' => [
        /**
         * 'user' => [
         *     'name' => 'User',
         *     'namespace' => 'App\\Domains\\User',
         * ],
         */
    ]
];
```

Optionally, you can publish the stubs using

```bash
php artisan vendor:publish --tag="ddd-domain-resources-stubs"
```

## Usage

### Generate a domain directory structure

Once the package's config file is published and filled, you can generate a domain directory structure with the following command:

```php
php artisan domain:generate user --scaffold
```

This will generate the following directory structure:

```
├── app
│   └── Domains
│       └── User
│           ├── Application
│           ├── Domain
│           │   ├── Contracts
│           │   ├── Events
│           │   ├── Exceptions
│           │   ├── ValueObjects
│           ├── Infrastructure
│           │   ├── Repositories
```

### Generate a domain resource

In base of the previous directory structure, you can generate a domain resource file with the following command:

```php
php artisan domain:generate user {file-type}
```

Where `{file-type}` can be one of the following:

- `use_case`
- `contract`
- `event`
- `exception`
- `value_object`
- `repository`
- `controller`

For example, to generate a `UseCase` file, you can run the following command:

```php
php artisan domain:generate user use_case
```

When you run this command, you will be prompted to enter the name of the resource. For example, if you want to generate a `CreateUser` use case, you can enter `CreateUser` as the resource name.

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Axel Libori Roch](https://github.com/alibori)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
