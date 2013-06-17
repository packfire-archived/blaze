<?php

namespace Packfire\Blaze\Meta;

class AttributeTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $attribute = new Attribute('name', 'Name', 'string');
        $this->assertEquals('name', $attribute->property());
        $this->assertEquals('Name', $attribute->attribute());
        $this->assertEquals('string', $attribute->type());
    }

    public function testLoad()
    {
        $attribute = Attribute::load(new \ReflectionProperty('Packfire\\Blaze\\Fixture\\Dummy', 'name'));
        $this->assertInstanceOf('Packfire\\Blaze\\Meta\\Attribute', $attribute);
        $this->assertEquals('name', $attribute->property());
        $this->assertEquals('Name', $attribute->attribute());
        $this->assertEquals('string', $attribute->type());
    }

    public function testLoadEmpty()
    {
        $attribute = Attribute::load(new \ReflectionProperty('Packfire\\Blaze\\Fixture\\BiggerDummy', 'height'));
        $this->assertInstanceOf('Packfire\\Blaze\\Meta\\Attribute', $attribute);
        $this->assertEquals('height', $attribute->property());
        $this->assertEquals('height', $attribute->attribute());
        $this->assertEquals('double', $attribute->type());
    }

    public function testFail()
    {
        $attribute = Attribute::load(new \ReflectionProperty('Packfire\\Blaze\\Meta\\Entity', 'entity'));
        $this->assertNull($attribute);
    }
}
