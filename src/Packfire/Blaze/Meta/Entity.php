<?php

namespace Packfire\Blaze\Meta;

class Entity
{
    protected $className;

    protected $name;

    protected $attributes;

    protected $indexes;

    public function __construct($className, $name, $attributes = null, $indexes = null)
    {
        $this->className = $className;
        $this->name = $name;
        if (null === $attributes) {
            $attributes = new AttributeCollection();
        }
        $this->attributes = $attributes;
        if (null === $indexes) {
            $indexes = new IndexCollection();
        }
        $this->indexes = $indexes;
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

    public function indexes()
    {
        return $this->indexes;
    }
}
