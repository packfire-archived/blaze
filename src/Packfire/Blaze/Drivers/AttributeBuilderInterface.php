<?php

namespace Packfire\Blaze\Drivers;

use Packfire\Blaze\Meta\Attribute\AttributeInterface;

interface AttributeBuilderInterface
{
    public function build(AttributeInterface $attribute);
}
