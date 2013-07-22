<?php

namespace Packfire\Blaze\Fixture;

/**
 * @entity dummies
 */
class BiggerDummy extends Dummy
{
    /**
     * @id
     */
    public $dummyId;

    /**
     * @id Fixture\Test $testId
     */
    public $foreignId;

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
