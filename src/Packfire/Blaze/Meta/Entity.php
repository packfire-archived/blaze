<?php

namespace Packfire\Blaze\Meta;

class Entity
{
    protected $className;

    protected $name;

    protected $attributes;

    public function __construct($className, $name, $attributes)
    {
        $this->className = $className;
        $this->name = $name;
        $this->attributes = $attributes;
    }

    public function className()
    {
        return $this->className;
    }

    public function name()
    {
        return $this->name;
    }

    public function attributes()
    {
        return $this->attributes;
    }
}
