<?php

namespace Packfire\Blaze\Meta;

class EntityTest extends \PHPUnit_Framework_TestCase
{
    const DUMMY = 'Packfire\\Blaze\\Fixture\\Dummy';
    const BIGGER_DUMMY = 'Packfire\\Blaze\\Fixture\\BiggerDummy';

    public function testConstruct()
    {
        $entity = new Entity(self::DUMMY, 'test');
        $this->assertEquals(self::DUMMY, $entity->className());
        $this->assertEquals('test', $entity->name());
        $this->assertInstanceOf('Packfire\\Blaze\\Meta\\AttributeCollection', $entity->attributes());
        $this->assertInstanceOf('Packfire\\Blaze\\Meta\\IndexCollection', $entity->indexes());
    }

    public function testConstructCustom()
    {
        $attributes = new AttributeCollection();
        $indexes = new IndexCollection();
        $entity = new Entity(self::DUMMY, 'test', $attributes, $indexes);
        $this->assertEquals(self::DUMMY, $entity->className());
        $this->assertEquals('test', $entity->name());
        $this->assertEquals($attributes, $entity->attributes());
        $this->assertEquals($indexes, $entity->indexes());
    }
}
