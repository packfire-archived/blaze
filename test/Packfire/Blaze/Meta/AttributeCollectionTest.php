<?php

namespace Packfire\Blaze\Meta;

class AttributeCollectionTest extends \PHPUnit_Framework_TestCase
{
    public function testAdd()
    {
        $collection = new AttributeCollection();
        $this->assertEquals(0, $collection->count());
        $collection->add(new Attribute('test', 'test', 'text'));
        $this->assertEquals(1, $collection->count());
        $this->assertInstanceOf('Packfire\\Blaze\\Meta\\Attribute', $collection[0]);
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
        $this->assertEquals($attribute, $collection->get(0));
    }
}
