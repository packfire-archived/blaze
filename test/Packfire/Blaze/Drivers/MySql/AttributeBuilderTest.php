<?php

namespace Packfire\Blaze\Drivers\MySql;

use Packfire\Blaze\Meta\Attribute\Attribute;

class AttributeBuilderTest extends \PHPUnit_Framework_TestCase
{
    public function testBuild()
    {
        $attribute = new Attribute('test', 'Test', 'string');
        $builder = new AttributeBuilder();
        $this->assertEquals('  `Test` TEXT', $builder->build($attribute));
    }
}
