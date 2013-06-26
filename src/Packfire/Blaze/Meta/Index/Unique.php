<?php

namespace Packfire\Blaze\Meta\Index;

use Packfire\Blaze\Meta\Attribute\AttributeCollection;
use Packfire\Blaze\Utility\IndexUtility;

class Unique implements IndexInterface
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
        return IndexUtility::name($this, 'uniq_');
    }
}
