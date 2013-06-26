<?php

namespace Packfire\Blaze\Drivers

use Packfire\Blaze\Meta\Entity;

interface EntityBuilderInterface
{
    public function build(Entity $attribute);
}
