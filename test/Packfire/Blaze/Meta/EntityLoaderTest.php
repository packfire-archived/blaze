<?php

namespace Packfire\Blaze\Meta;

class EntityLoaderTest extends \PHPUnit_Framework_TestCase
{
    const DUMMY = 'Packfire\\Blaze\\Fixture\\Dummy';
    const BIGGER_DUMMY = 'Packfire\\Blaze\\Fixture\\BiggerDummy';

    public function testParsedEntity()
    {
        $entity = EntityLoader::load(new \ReflectionClass(self::DUMMY));
        $this->assertEquals(self::DUMMY, $entity->className());
        $this->assertEquals('dummies', $entity->name());
    }

    public function testNoneAttributes()
    {
        $entity = EntityLoader::load(new \ReflectionClass('Packfire\\Blaze\\Meta\\Entity'));
        $this->assertNull($entity);
    }

    public function testAttributes()
    {
        $entity = EntityLoader::load(new \ReflectionClass(self::DUMMY));
        $attributes = $entity->attributes();
        $this->assertCount(1, $attributes);
        $this->assertEquals('Name', $attributes[0]->name());
    }

    public function testExtendedAttributes()
    {
        $entity = EntityLoader::load(new \ReflectionClass(self::BIGGER_DUMMY));
        $attributes = $entity->attributes();
        $this->assertCount(3, $attributes);
        $this->assertEquals('Name', $attributes[0]->name());
        $this->assertEquals('Age', $attributes[1]->name());
        $this->assertEquals('height', $attributes[2]->name());
    }
}
