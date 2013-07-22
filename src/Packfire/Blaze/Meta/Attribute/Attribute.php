<?php

namespace Packfire\Blaze\Meta\Attribute;

use Packfire\Blaze\Meta\Index\IndexCollection;

class Attribute implements AttributeInterface
{
    protected $property;

    protected $name;

    protected $type;

    protected $indexes;

    public function __construct($property, $name, $type)
    {
        $this->property = $property;
        $this->name = $name;
        $this->type = $type;
        $this->indexes = new IndexCollection();
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

    public function indexes()
    {
        return $this->indexes;
    }
}
