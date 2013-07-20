<?php

namespace Packfire\Blaze\Fixture;

/**
 * @entity files
 * @index unique $name, $hash
 */
class FileDummy
{
    /**
     * @attribute Name
     * @type text
     * @var string
     */
    public $name;

    /**
     * @attribute Hash
     * @type text
     * @var string
     */
    public $hash;
}
