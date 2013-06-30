<?php

namespace Packfire\Blaze\Meta\Index;

use Packfire\Blaze\Meta\Attribute\AttributeCollection;
use Packfire\Blaze\Utility\IndexUtility;

class ForeignKey implements IndexInterface
{
    protected $attributes;

    protected $reference;

    public function __construct(Reference $reference, AttributeCollection $attributes = null)
    {
        if ($attributes) {
            $this->attributes = $attributes;
        } else {
            $this->attributes = new AttributeCollection();
        }
        $this->reference = $reference;
    }

    public function attributes()
    {
        return $this->attributes;
    }

    public function name()
    {
        return IndexUtility::name($this, 'fk_');
    }

    public function reference()
    {
        return $this->reference;
    }
}
