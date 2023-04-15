# Laravel DDD Domain Resources

[![Latest Version on Packagist](https://img.shields.io/packagist/v/alibori/laravel-ddd-domain-resources.svg?style=flat-square)](https://packagist.org/packages/alibori/laravel-ddd-domain-resources)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/alibori/laravel-ddd-domain-resources/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/alibori/laravel-ddd-domain-resources/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/alibori/laravel-ddd-domain-resources/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/alibori/laravel-ddd-domain-resources/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/alibori/laravel-ddd-domain-resources.svg?style=flat-square)](https://packagist.org/packages/alibori/laravel-ddd-domain-resources)

Package to generate domain resources for a Laravel DDD application.

## Installation

You can install the package via composer:

```bash
composer require alibori/laravel-ddd-domain-resources
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="ddd-domain-resources-config"
```

This is the contents of the published config file:

```php
return [
];
```

## Usage

```php
$laravelDddDomainResources = new Alibori\LaravelDddDomainResources();
echo $laravelDddDomainResources->echoPhrase('Hello, Alibori!');
```

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
