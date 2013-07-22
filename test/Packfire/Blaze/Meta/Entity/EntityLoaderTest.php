<?php

namespace Packfire\Blaze\Meta\Entity;

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
        $entity = EntityLoader::load(new \ReflectionClass('Packfire\\Blaze\\Meta\\Entity\\Entity'));
        $this->assertNull($entity);
    }

    public function testAttributes()
    {
        $entity = EntityLoader::load(new \ReflectionClass(self::DUMMY));
        $attributes = $entity->attributes();
        $this->assertCount(1, $attributes);
        $this->assertEquals('Name', $attributes['name']->name());
    }

    public function testExtendedAttributes()
    {
        $entity = EntityLoader::load(new \ReflectionClass(self::BIGGER_DUMMY));
        $attributes = $entity->attributes();
        $this->assertCount(5, $attributes);
        $this->assertEquals('Name', $attributes['name']->name());
        $this->assertEquals('Age', $attributes['age']->name());
        $this->assertEquals('height', $attributes['height']->name());
    }

    public function testIndexes()
    {
        $entity = EntityLoader::load(new \ReflectionClass(self::BIGGER_DUMMY));
        $indexes = $entity->indexes();
        $this->assertInstanceOf('Packfire\\Blaze\\Meta\\Index\\IndexCollection', $indexes);
        $this->assertCount(1, $indexes);
        $this->assertInstanceOf('Packfire\\Blaze\\Meta\\Index\\Unique', $indexes[0]);
    }
}
