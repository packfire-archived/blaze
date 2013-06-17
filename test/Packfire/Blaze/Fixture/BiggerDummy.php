<?php

namespace Packfire\Blaze\Fixture;

/**
 * @entity dummies
 */
class BiggerDummy extends Dummy
{
    /**
     * @attribute Age
     * @var integer
     */ 
    public $age;

    /**
     * With missing attribute annotation
     * @attribute
     * @var double
     */ 
    public $height;
}
