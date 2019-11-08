<?php


namespace Dakujem;

use Pimple\Container;
use Psr\Container\ContainerInterface;


/**
 * A trivial extension of Pimple Container.
 *
 * Provides PSR-11 compatibility and magic access methods for convenience. That's it.
 */
class Sleeve extends Container implements ContainerInterface
{


    public function get($id)
    {
        return $this->offsetGet($id);
    }


    public function set($id, $value)
    {
        $this->offsetSet($id, $value);
        return $this;
    }


    public function has($id)
    {
        return $this->offsetExists($id);
    }


    public function __get($id)
    {
        return $this->get($id);
    }


    public function __set($id, $value)
    {
        return $this->set($id, $value);
    }


    public function __isset($id)
    {
        return $this->has($id);
    }


    public function __unset($id)
    {
        $this->offsetUnset($id);
    }
}
