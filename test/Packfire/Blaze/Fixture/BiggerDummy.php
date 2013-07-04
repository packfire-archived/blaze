<?php

namespace Packfire\Blaze\Fixture;

/**
 * @entity dummies
 */
class BiggerDummy extends Dummy
{
    /**
     * @id Fixture\Test::$testId
     */
    public $dummyId;

    /**
     * @attribute Age
     * @type TINYINT
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
