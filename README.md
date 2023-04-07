# Manage project-wide git hooks in a simple way

[![Latest Version on Packagist](https://img.shields.io/packagist/v/projektgopher/laravel-git-hooks.svg?style=flat-square)](https://packagist.org/packages/projektgopher/laravel-git-hooks)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/projektgopher/laravel-git-hooks/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/projektgopher/laravel-git-hooks/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/projektgopher/laravel-git-hooks/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/projektgopher/laravel-git-hooks/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/projektgopher/laravel-git-hooks.svg?style=flat-square)](https://packagist.org/packages/projektgopher/laravel-git-hooks)

Keeping git hooks in sync across a while team can have some issues. This packages aims to solve that.

## Installation

You can install the package via composer:

```bash
composer require projektgopher/laravel-git-hooks
php artisan git-hooks:install
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-git-hooks-config"
```

This is the contents of the published config file:

```php
return [
];
```

## Usage

TODO

## Testing

```bash
composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits
A **big** "Thank You" to [EXACTsports](https://github.com/EXACTsports) for supporting the development of this package.

- [Len Woodward](https://github.com/ProjektGopher)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
