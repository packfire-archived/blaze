<?php

namespace Packfire\Blaze\Meta;

class EntityTest extends \PHPUnit_Framework_TestCase
{
    const DUMMY = 'Packfire\\Blaze\\Fixture\\Dummy';
    const BIGGER_DUMMY = 'Packfire\\Blaze\\Fixture\\BiggerDummy';

    public function testName()
    {
        $entity = new Entity(self::DUMMY);
        $this->assertEquals(self::DUMMY, $entity->name());
        $this->assertNull($entity->entity());
        $this->assertNull($entity->attributes());
    }

    public function testParsedEntity()
    {
        $entity = new Entity(self::DUMMY);
        $entity->parse();
        $this->assertEquals(self::DUMMY, $entity->name());
        $this->assertEquals('dummies', $entity->entity());
    }

    public function testAttributes()
    {
        $entity = new Entity(self::DUMMY);
        $entity->parse();
        $attributes = $entity->attributes();
        $this->assertCount(1, $attributes);
        $this->assertEquals('Name', $attributes[0]->attribute());
    }

    public function testExtendedAttributes()
    {
        $entity = new Entity(self::BIGGER_DUMMY);
        $entity->parse();
        $attributes = $entity->attributes();
        $this->assertCount(2, $attributes);
        $this->assertEquals('Name', $attributes[0]->attribute());
        $this->assertEquals('Age', $attributes[1]->attribute());
    }
}
