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
}
