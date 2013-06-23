<?php

namespace Packfire\Blaze\Meta\Index;

use Packfire\Blaze\Meta\IndexInterface;
use Packfire\Blaze\Meta\AttributeCollection;

class ForeignKey implements IndexInterface
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

    public function name()
    {
        return IndexUtility::name($this, 'fk_');
    }
}
