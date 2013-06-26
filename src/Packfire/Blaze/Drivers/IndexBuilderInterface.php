<?php

namespace Packfire\Blaze\Drivers;

use Packfire\Blaze\Meta\Index\IndexInterface;

interface IndexBuilderInterface
{
    public function build(IndexInterface $attribute);
}
