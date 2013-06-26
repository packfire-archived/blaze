<?php

namespace Packfire\Blaze\Drivers;

use Packfire\Blaze\Meta\AttributeInterface;

interface AttributeBuilderInterface
{
    public function build(AttributeInterface $attribute);
}
