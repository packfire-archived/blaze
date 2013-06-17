<?php

namespace Packfire\Blaze\Meta;

class EntityTest extends \PHPUnit_Framework_TestCase
{
    const DUMMY = 'Packfire\\Blaze\\Fixture\\Dummy';
    const BIGGER_DUMMY = 'Packfire\\Blaze\\Fixture\\BiggerDummy';

    public function testName()
    {
        $entity = new Entity(self::DUMMY);
        $this->assertEquals(self::DUMMY, $entity->className());
        $this->assertNull($entity->name());
        $this->assertNull($entity->attributes());
    }

    public function testParsedEntity()
    {
        $entity = new Entity(self::DUMMY);
        $entity->parse();
        $this->assertEquals(self::DUMMY, $entity->className());
        $this->assertEquals('dummies', $entity->name());
    }

    public function testNoneAttributes()
    {
        $entity = new Entity('Packfire\\Blaze\\Meta\\Entity');
        $entity->parse();
        $attributes = $entity->attributes();
        $this->assertCount(0, $attributes);
    }

    public function testAttributes()
    {
        $entity = new Entity(self::DUMMY);
        $entity->parse();
        $attributes = $entity->attributes();
        $this->assertCount(1, $attributes);
        $this->assertEquals('Name', $attributes[0]->name());
    }

    public function testExtendedAttributes()
    {
        $entity = new Entity(self::BIGGER_DUMMY);
        $entity->parse();
        $attributes = $entity->attributes();
        $this->assertCount(3, $attributes);
        $this->assertEquals('Name', $attributes[0]->name());
        $this->assertEquals('Age', $attributes[1]->name());
        $this->assertEquals('height', $attributes[2]->name());
    }
}
