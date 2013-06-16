<?php

namespace Packfire\Blaze\Meta;

class Attribute
{
    protected $property;

    protected $attribute;

    protected $type;

    public function __construct($property, $attribute, $type)
    {
        $this->property = $property;
        $this->attribute = $attribute;
        $this->type = $type;
    }

    public function property()
    {
        return $this->property;
    }

    public function attribute()
    {
        return $this->attribute;
    }

    public function type()
    {
        return $this->type;
    }
}
