
# Sleeve

A lightweight dependency injection container to go with micro frameworks.

Sleeve...
- is dead simple
- is PSR-11 compatible
- extends Pimple ([pimple/pimple](https://packagist.org/packages/pimple/pimple)), a Symfony DI container
- only adds a couple of convenience methods (accessors) on top of the original
- works well with [Slim v4](https://github.com/slimphp/Slim)

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

