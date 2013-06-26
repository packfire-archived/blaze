<?php

namespace Packfire\Blaze\Meta\Attribute;

class AttributeLoaderTest extends \PHPUnit_Framework_TestCase
{
    public function testLoad()
    {
        $property = new \ReflectionProperty('Packfire\\Blaze\\Fixture\\Dummy', 'name');
        $attribute = Attribute::load($property);
        $this->assertInstanceOf('Packfire\\Blaze\\Meta\\Attribute', $attribute);
        $this->assertEquals('name', $attribute->property());
        $this->assertEquals('Name', $attribute->name());
        $this->assertEquals('string', $attribute->type());
    }

    public function testLoadTypeAnnotation()
    {
        $property = new \ReflectionProperty('Packfire\\Blaze\\Fixture\\BiggerDummy', 'age');
        $attribute = Attribute::load($property);
        $this->assertInstanceOf('Packfire\\Blaze\\Meta\\Attribute', $attribute);
        $this->assertEquals('age', $attribute->property());
        $this->assertEquals('Age', $attribute->name());
        $this->assertEquals('TINYINT', $attribute->type());
    }

    public function testLoadEmpty()
    {
        $property = new \ReflectionProperty('Packfire\\Blaze\\Fixture\\BiggerDummy', 'height');
        $attribute = Attribute::load($property);
        $this->assertInstanceOf('Packfire\\Blaze\\Meta\\Attribute', $attribute);
        $this->assertEquals('height', $attribute->property());
        $this->assertEquals('height', $attribute->name());
        $this->assertEquals('double', $attribute->type());
    }

    public function testFail()
    {
        // non-existing attribute tag
        $property = new \ReflectionProperty('Packfire\\Blaze\\Meta\\Entity\\Entity', 'name');
        $attribute = Attribute::load($property);
        $this->assertNull($attribute);
    }
}
