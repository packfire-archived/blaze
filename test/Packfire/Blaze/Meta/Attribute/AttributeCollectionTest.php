<?php

namespace Packfire\Blaze\Meta\Attribute;

class AttributeCollectionTest extends \PHPUnit_Framework_TestCase
{
    public function testAdd()
    {
        $collection = new AttributeCollection();
        $this->assertEquals(0, $collection->count());
        $collection->add(new Attribute('test', 'test', 'text'));
        $this->assertEquals(1, $collection->count());
        $this->assertInstanceOf('Packfire\\Blaze\\Meta\\Attribute\\Attribute', $collection['test']);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testAddFail()
    {
        $collection = new AttributeCollection();
        $collection->add(5);
    }

    public function testGet()
    {
        $collection = new AttributeCollection();
        $attribute = new Attribute('test', 'test', 'text');
        $collection->add($attribute);
        $this->assertEquals($attribute, $collection->get('test'));
        $this->assertNull($collection->get(500));
    }

    public function testArrayAccess()
    {
        $collection = new AttributeCollection();
        $this->assertFalse(isset($collection['nonExist']));
        $collection[] = new Attribute('test', 'test', 'text');
        $this->assertTrue(isset($collection['test']));
        unset($collection['test']);
        $this->assertFalse(isset($collection['test']));
    }

    public function testIteratorAggregate()
    {
        $collection = new AttributeCollection();
        $this->assertInstanceOf('Traversable', $collection->getIterator());
    }
}
