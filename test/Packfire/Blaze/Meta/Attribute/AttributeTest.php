<?php

namespace Packfire\Blaze\Meta\Attribute;

class AttributeTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $attribute = new Attribute('name', 'Name', 'string');
        $this->assertEquals('name', $attribute->property());
        $this->assertEquals('Name', $attribute->name());
        $this->assertEquals('string', $attribute->type());
    }
}
