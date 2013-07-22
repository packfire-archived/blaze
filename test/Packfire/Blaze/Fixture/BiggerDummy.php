<?php

namespace Packfire\Blaze\Fixture;

/**
 * @entity dummies
 */
class BiggerDummy extends Dummy
{
    /**
     * @id
     * @attribute
     * @var integer
     */
    public $dummyId;

    /**
     * @id Fixture\Test $testId
     * @attribute
     * @var integer
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
