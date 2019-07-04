
# Sleeve

A lightweight dependency injection container to go with micro frameworks.


## Why 

- extends Pimple, the Symfony DI container
- PSR-7 compatible
- adds convenience methods
- works well with Slim v4

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

