<?php

namespace Packfire\Blaze\Drivers

use Packfire\Blaze\Meta\IndexInterface;

interface IndexBuilderInterface
{
    public function build(IndexInterface $attribute);
}
