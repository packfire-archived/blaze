<?php

namespace Packfire\Blaze\Meta;

class PrimaryKey implements IndexInterface
{
    protected $attributes;

    public function __construct()
    {
        $this->attributes = new AttributeCollection();
    }

    public function attributes()
    {
        return $this->attributes;
    }
}
