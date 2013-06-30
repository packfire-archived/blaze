<?php

namespace Packfire\Blaze\Meta\Index;

use Packfire\Blaze\Meta\Attribute\AttributeCollection;
use Packfire\Blaze\Meta\Attribute\Attribute;

class ForeignKeyTest extends \PHPUnit_Framework_TestCase
{
    public function testConstruct()
    {
        $foreignAttributes = new AttributeCollection();
        $foreignAttributes->add(new Attribute('test', 'test', 'text'));
        $reference = new Reference('test', $foreignAttributes);

        $index = new ForeignKey($reference);
        $this->assertInstanceOf('Packfire\\Blaze\\Meta\\Attribute\\AttributeCollection', $index->attributes());
        $this->assertEquals('fk_', $index->name());
        $this->assertEquals($reference, $index->reference());
    }

    public function testConstructWithCollection()
    {
        $foreignAttributes = new AttributeCollection();
        $foreignAttributes->add(new Attribute('test', 'test', 'text'));
        $reference = new Reference('test', $foreignAttributes);

        $attributes = new AttributeCollection();
        $attributes->add(new Attribute('test', 'test', 'text'));
        $index = new ForeignKey($reference, $attributes);
        $this->assertEquals($attributes, $index->attributes());
        $this->assertEquals('fk_test', $index->name());
        $this->assertEquals($reference, $index->reference());
    }
}
