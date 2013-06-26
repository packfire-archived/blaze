<?php

namespace Packfire\Blaze\Drivers;

use Packfire\Blaze\Meta\Entity\EntityInterface;

interface EntityBuilderInterface
{
    public function build(EntityInterface $attribute);
}
