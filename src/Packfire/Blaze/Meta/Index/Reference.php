<?php

namespace Packfire\Blaze\Meta\Index;

use Packfire\Blaze\Meta\Attribute\AttributeCollection;
use Packfire\Blaze\Utility\IndexUtility;

class Reference implements IndexInterface
{
    protected $name;

    protected $attributes;

    public function __construct($name, AttributeCollection $attributes)
    {
        $this->name = $name;
        $this->attributes = $attributes;
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
