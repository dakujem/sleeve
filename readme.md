
# Sleeve

[![Build Status](https://travis-ci.org/dakujem/sleeve.svg?branch=master)](https://travis-ci.org/dakujem/sleeve)
![PHP from Packagist](https://img.shields.io/packagist/php-v/dakujem/sleeve)
![Nature Friendly](https://img.shields.io/badge/nature%20%F0%9F%8C%B3-friendly%20%F0%9F%92%9A-green)

A lightweight PSR-11 service container.\
A trivial extension of [Symfony Pimple container](https://pimple.symfony.com).

> 💿 `composer require dakujem/sleeve`

Sleeve...
- is dead simple
- is PSR-11 compatible
- extends Pimple ([pimple/pimple](https://packagist.org/packages/pimple/pimple)), a simple Dependency Injection Container by Symfony
- only adds a couple of convenience methods (accessors) on top of the original
- works well with [Slim v4](https://github.com/slimphp/Slim)
  and other micro frameworks and stacks


## Usage

Added on top of Pimple:
- methods `get`, `set`, `has`, `unset`
- magic accessors `__get`, `__set`, `__isset`, `__unset`

Examples:
```php
$dic = new Dakujem\Sleeve;

// the following are equivalent
$service = $dic->get('service');    // getter
$service = $dic['service'];         // array accessor
$service = $dic->service;           // magic accessor

// it works for setting services as well
$factory = function(Container $dic) {
               return new Acme\MyService($dic->get('dependency'));
           };
$dic->set('service', $factory);     // setter
$dic['service'] = $factory;         // array accessor
$dic->service = $factory;           // magic accessor
```

Sleeve supports (through Pimple):
- singleton services (global)
- factory services (factories)
- parameters (with protection too)
- extensions (service providers)

📖 For full documentation, read the [Pimple container usage documentation](https://pimple.symfony.com/#usage). It's quite short, in fact.


## Testing

```
composer test
```

Tested for PHP versions 7.1 onwards.
