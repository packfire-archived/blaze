<?php

namespace Packfire\Blaze\Meta\Index;

use Packfire\Blaze\Meta\IndexInterface;
use Packfire\Blaze\Meta\AttributeCollection;

class Key implements IndexInterface
{
    protected $attributes;

    protected $name;

    public function __construct($name)
    {
        $this->attributes = new AttributeCollection();
        $this->name = $name;
    }

    public function attributes()
    {
        return $this->attributes;
    }

    public function name()
    {
        return $this->name;
    }
}
