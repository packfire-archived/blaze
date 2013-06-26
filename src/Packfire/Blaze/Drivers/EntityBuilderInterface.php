<?php

namespace Packfire\Blaze\Drivers;

use Packfire\Blaze\Meta\EntityInterface;

interface EntityBuilderInterface
{
    public function build(EntityInterface $attribute);
}
