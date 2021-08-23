# Disallowlister for Laravel. 

Effortlessly test strings against any array of disallowed strings. Supports `fnmatch` wildcards, like * and ?. 

`accentinteractive/disallowlister` contains both a facade `Disallowlister` and custom validation rule `disallowlister`. You can set a default array of disallowed strings in config, or add and remove disallowed strings using `Disallowlister:add()` and `Disallowlister:remove()`

[![Latest Version on Packagist](https://img.shields.io/packagist/v/accentinteractive/laravel-disallowlister.svg?style=flat-square)](https://packagist.org/packages/accentinteractive/laravel-disallowlister)
[![Build Status](https://img.shields.io/travis/accentinteractive/laravel-disallowlister/master.svg?style=flat-square)](https://travis-ci.org/accentinteractive/laravel-disallowlister)
[![Quality Score](https://img.shields.io/scrutinizer/g/accentinteractive/laravel-disallowlister.svg?style=flat-square)](https://scrutinizer-ci.com/g/accentinteractive/laravel-disallowlister)
[![Total Downloads](https://img.shields.io/packagist/dt/accentinteractive/laravel-disallowlister.svg?style=flat-square)](https://packagist.org/packages/accentinteractive/laravel-disallowlister)

This Laravel-specific package tests a string against a disallowlist. It is a Laravel implementation of the platform agnostic `accentinteractive/disallowlister`.

If you are looking for a framework agnostic implementation, see https://github.com/accentinteractive/disallowlister

For a list of all options, see [https://github.com/accentinteractive/disallowlister#readme](https://github.com/accentinteractive/disallowlister#readme). 

The `isDisallowed()` method can use wildcards, like * and ?. 

Under the hood, `accentinteractive/disallowtester` uses `fnmatch()`, so you can use the same wildcards as in that php function (the globbing wildcard patterns):
- `*sex*` disallows **sex**, **sex**uality and bi**sex**ual.
- `cycle*` disallows cycle and cycles, but not bicycle.
- `m[o,u]m` disallows mom and mum, but allows mam.
- `m?n` disallows man and men, but allows moon.

- [Installation](#installation) 
- [Examples](#usage) 
- [Config settings](#config-settings)

## Installation

You can install the package via composer:

```bash
composer require accentinteractive/laravel-disallowlister
```

Optionally you can publish the config file with:
```
php artisan vendor:publish --provider="Accentinteractive\LaravelDisallowlister\LaravelDisallowlisterServiceProvider" --tag="config"
```

## Usage

### Set the default disallowlist
1. Publish the config file, running `php artisan vendor:publish --provider="Accentinteractive\LaravelDisallowlister\LaravelDisallowlisterServiceProvider" --tag="config"`
2. Set an array of disalllowed strings in `disallowlister.disallowed_strings`

Alternatively, you can set the default disallowlist on the fly using `config(['disallowlister.disallowed_strings' => ['foo', 'bar*']);` 

### Add items to the disallowlist an remove them
```php
use Accentinteractive\LaravelDisallowlister\Facades\Disallowlister;

Disallowlister::add('*foo*');
Disallowlister::add(['bar', 'b?t']);
```

### Use the disallowlister validation rule
```php
// Use the custom disallowlist validator
$rules = [
    'user_input' => 'disallowlister'
];
```

### Use the class directly
```php
use Accentinteractive\LaravelDisallowlister\Facades\Disallowlister;

DisallowLister::addItem('foo')
                ->addItem(['*bar*', 'b?t'])
                ->isDisallowed('My favorite bars');

```

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email joost@accentinteractive.nl instead of using the issue tracker.

## Credits

- [Joost van Veen](https://github.com/accentinteractive)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
