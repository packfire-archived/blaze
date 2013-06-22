<?php

namespace Packfire\Blaze\Meta;

class AttributeCollection implements CollectionInterface
{
    protected $attributes = array();

    public function add(\Attribute $value)
    {

    }

    public function get($index)
    {

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
