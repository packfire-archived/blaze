<?php

namespace Packfire\Blaze\Meta;

class AttributeCollection implements CollectionInterface
{
    protected $attributes = array();

    public function add($value)
    {
        if (!($value instanceof Attribute)) {
            throw new \InvalidArgumentException("$value expected to be of type Packfire\\Blaze\\Meta\\Attribute in AttributeCollection.");
        }
        $this->attributes[] = $value;
    }

    public function get($index)
    {
        if (isset($this->attributes[$index])) {
            return $this->attributes[$index];
        }
    }

    public function offsetExists($offset)
    {
        return isset($this->attributes[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->attributes[$offset];
    }

    public function offsetSet($offset, $value)
    {
        $this->add($value);
    }

    public function offsetUnset($offset)
    {
        unset($this->attributes[$offset]);
    }

    public function count()
    {
        return count($this->attributes);
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->attributes);
    }
}
