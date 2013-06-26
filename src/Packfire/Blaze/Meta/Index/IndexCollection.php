<?php

namespace Packfire\Blaze\Meta;

class IndexCollection implements CollectionInterface
{
    protected $keys = array();

    public function add($value)
    {
        if (!($value instanceof IndexInterface)) {
            throw new \InvalidArgumentException("$value expected to be of type Packfire\\Blaze\\Meta\\IndexInterface in IndexCollection.");
        }
        $this->keys[] = $value;
    }

    public function get($index)
    {
        if (isset($this->keys[$index])) {
            return $this->keys[$index];
        }
    }

    public function offsetExists($offset)
    {
        return isset($this->keys[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->keys[$offset];
    }

    public function offsetSet($offset, $value)
    {
        $this->add($value);
    }

    public function offsetUnset($offset)
    {
        unset($this->keys[$offset]);
    }

    public function count()
    {
        return count($this->keys);
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->keys);
    }
}
