<?php

namespace Packfire\Blaze\Drivers

use Packfire\Blaze\Meta\Attribute;

interface AttributeBuilderInterface
{
    public function build(Attribute $attribute);
}
