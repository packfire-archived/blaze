<?php

namespace Packfire\Blaze\Meta;

class Attribute implements AttributeInterface
{
    protected $property;

    protected $name;

    protected $type;

    public function __construct($property, $name, $type)
    {
        $this->property = $property;
        $this->name = $name;
        $this->type = $type;
    }

    public function property()
    {
        return $this->property;
    }

    public function name()
    {
        return $this->name;
    }

    public function type()
    {
        return $this->type;
    }
}
