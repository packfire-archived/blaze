<?php

namespace Packfire\Blaze\Meta;

class EntityTest extends \PHPUnit_Framework_TestCase
{
    const DUMMY = 'Packfire\\Blaze\\Fixture\\Dummy';
    const BIGGER_DUMMY = 'Packfire\\Blaze\\Fixture\\BiggerDummy';

    public function testConstruct()
    {
        $entity = new Entity(self::DUMMY, 'test', array());
        $this->assertEquals(self::DUMMY, $entity->className());
        $this->assertEquals('test', $entity->name());
        $this->assertEquals(array(), $entity->attributes());
    }

    public function testParsedEntity()
    {
        $entity = Entity::load(new \ReflectionClass(self::DUMMY));
        $this->assertEquals(self::DUMMY, $entity->className());
        $this->assertEquals('dummies', $entity->name());
    }

    public function testNoneAttributes()
    {
        $entity = Entity::load(new \ReflectionClass('Packfire\\Blaze\\Meta\\Entity'));
        $this->assertNull($entity);
    }

    public function testAttributes()
    {
        $entity = Entity::load(new \ReflectionClass(self::DUMMY));
        $attributes = $entity->attributes();
        $this->assertCount(1, $attributes);
        $this->assertEquals('Name', $attributes[0]->name());
    }

    public function testExtendedAttributes()
    {
        $entity = Entity::load(new \ReflectionClass(self::BIGGER_DUMMY));
        $attributes = $entity->attributes();
        $this->assertCount(3, $attributes);
        $this->assertEquals('Name', $attributes[0]->name());
        $this->assertEquals('Age', $attributes[1]->name());
        $this->assertEquals('height', $attributes[2]->name());
    }
}
