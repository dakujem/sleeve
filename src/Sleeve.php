<?php

declare(strict_types=1);

namespace Dakujem;

use Pimple\Container as Pimple;
use Psr\Container\ContainerInterface;

/**
 * A trivial extension of Pimple Container.
 *
 * Provides PSR-11 compatibility and magic access methods for convenience. That's it.
 */
class Sleeve extends Pimple implements ContainerInterface
{
    public function has(string $id): bool
    {
        return $this->offsetExists($id);
    }

    #[\ReturnTypeWillChange]
    public function get(string $id)//: mixed
    {
        return $this->offsetGet($id);
    }

    #[\ReturnTypeWillChange]
    public function set($id, $value)//: mixed
    {
        $this->offsetSet($id, $value);
        return $this;
    }

    public function unset($id): self
    {
        $this->offsetUnset($id);
        return $this;
    }

    #[\ReturnTypeWillChange]
    public function __get($id)//: mixed
    {
        return $this->get((string)$id);
    }

    #[\ReturnTypeWillChange]
    public function __set($id, $value)//: mixed
    {
        return $this->set($id, $value);
    }

    #[\ReturnTypeWillChange]
    public function __isset($id): bool
    {
        return $this->has((string)$id);
    }

    #[\ReturnTypeWillChange]
    public function __unset($id): void
    {
        $this->offsetUnset($id);
    }
}
