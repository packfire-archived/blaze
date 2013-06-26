<?php

namespace Packfire\Blaze\Meta\Index;

class IndexCollectionTest extends \PHPUnit_Framework_TestCase
{
    public function testAdd()
    {
        $collection = new IndexCollection();
        $this->assertEquals(0, $collection->count());
        $collection->add(new PrimaryKey());
        $this->assertEquals(1, $collection->count());
        $this->assertInstanceOf('Packfire\\Blaze\\Meta\\Index\\PrimaryKey', $collection[0]);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testAddFail()
    {
        $collection = new IndexCollection();
        $collection->add(5);
    }

    public function testGet()
    {
        $collection = new IndexCollection();
        $attribute = new PrimaryKey();
        $collection->add($attribute);
        $this->assertEquals($attribute, $collection->get(0));
        $this->assertNull($collection->get(500));
    }

    public function testArrayAccess()
    {
        $collection = new IndexCollection();
        $this->assertFalse(isset($collection['nonExist']));
        $collection[] = new PrimaryKey();
        $this->assertTrue(isset($collection[0]));
        unset($collection[0]);
        $this->assertFalse(isset($collection[0]));
    }

    public function testIteratorAggregate()
    {
        $collection = new IndexCollection();
        $this->assertInstanceOf('Traversable', $collection->getIterator());
    }
}
