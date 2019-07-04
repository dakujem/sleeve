<?php


use Dakujem\Sleeve;
use Pimple\Exception\UnknownIdentifierException;
use Tester\Assert;

require_once __DIR__ . '/../vendor/autoload.php';

// tester + errors
Tester\Environment::setup();


$c = new Sleeve();

// method
Assert::false($c->has('foo'));
Assert::false($c->has('bar'));
Assert::false($c->has(''));

// array access
Assert::false(isset($c['foo']));
Assert::false(isset($c['bar']));
Assert::false(isset($c['']));

// magic access
Assert::false(isset($c->foo));
Assert::false(isset($c->bar));
Assert::false(isset($c->{''}));

// getter
Assert::exception(function () use ($c) {
    $c->get('foo');
}, UnknownIdentifierException::class);
Assert::exception(function () use ($c) {
    $c->get('bar');
}, UnknownIdentifierException::class);
Assert::exception(function () use ($c) {
    $c->get('');
}, UnknownIdentifierException::class);

// magic access
Assert::exception(function () use ($c) {
    $c->foo;
}, UnknownIdentifierException::class);
Assert::exception(function () use ($c) {
    $c->bar;
}, UnknownIdentifierException::class);
Assert::exception(function () use ($c) {
    $c->{''};
}, UnknownIdentifierException::class);

// array access
Assert::exception(function () use ($c) {
    $c['foo'];
}, UnknownIdentifierException::class);
Assert::exception(function () use ($c) {
    $c['bar'];
}, UnknownIdentifierException::class);
Assert::exception(function () use ($c) {
    $c[''];
}, UnknownIdentifierException::class);


// scalar value
$c->set('foo', 'foo');
Assert::true($c->has('foo'));
Assert::false($c->has('bar'));
Assert::same($c->get('foo'), $c['foo']);
Assert::same('foo', $c->get('foo'));


// singleton service
Assert::false($c->has('singleton'));
$c->set('singleton', function () {
    return (object)['a' => rand()];
});
Assert::true($c->has('singleton'));
Assert::same($c->get('singleton'), $c->singleton);
Assert::same($c['singleton'], $c->singleton);
$c->unset('singleton');
Assert::false($c->has('singleton'));
$c->singleton = function () {
    return (object)['a' => rand()];
};
Assert::true($c->has('singleton'));
Assert::same($c->get('singleton'), $c->singleton);


// factory service
Assert::false($c->has('factory'));
$c->set('factory', $c->factory(function () {
    return (object)['a' => rand()];
}));
Assert::true($c->has('factory'));
Assert::notSame($c->get('factory'), $c->get('factory'));
Assert::notSame($c['factory'], $c['factory']);


// anonymous class
$class = new class(rand())
{
    public $foo;

    public function __construct($foo)
    {
        $this->foo = $foo;
    }
};
$c->set('bar', function () use ($class) {
    return $class;
});
Assert::true($c->has('bar'));
Assert::same($class, $c->get('bar'));
Assert::same($c->get('bar'), $c['bar']);


Assert::true($c->has('foo'));
unset($c->foo);
Assert::false($c->has('foo'));

Assert::true($c->has('bar'));
$c->unset('bar');
Assert::false($c->has('bar'));

// sanity test
$provider = function () {
    return (object)['a' => 42];
};
$c->set('a', $provider);
Assert::notEqual($provider, $c->a);
Assert::notSame($provider(), $c->a);
Assert::equal($provider(), $c->a);

